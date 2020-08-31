<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\BankSlip;
use App\Models\BankSlipHasBillEntry;
use App\Models\Bill;
use App\Models\BillEntry;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Services\PJBank;

class BillsController extends Controller
{


    protected $pjbank;
    protected $status = [
        'payed'   => 'Pago',
        'pendent' => 'Em aberto',
        'parcial' => 'Pago parcialmente',
        'overdue' => 'Atrasado'
    ];

    /*
    |--------------------------------------------------------------------------
    | Construtor
    |--------------------------------------------------------------------------
    */
    public function __construct(){

        //inicializa a api de emissão de boletos
        $this->pjbank = new PJBank();

    }

    /*
    |--------------------------------------------------------------------------
    | Informações
    |--------------------------------------------------------------------------
    */
    public function details(Request $request){

        //localiza a conta principal
        $bill = $this->entry->bill;

        //dados do registo
        $info = [

            //conta
            'bill'     => [
                'category' => $bill->category,
            ],

            //entrada
            'entry'    => [
                'id'          => $this->entry->idBillEntry,
                'due'         => Date::toDMY($this->entry->due),
                'frequency'   => Str::ucfirst($bill->frequency),
                'description' => Str::print($this->entry->description),
                'status'      => $this->status[$this->entry->status],
            ],

            //valores
            'amount'   => [
                'payed'   => $this->entry->sumOfPayments(),
                'pendent' => $this->entry->amount(),
                'total'   => $this->entry->amount
            ],

            //anexos
            'receipts'  => $this->entry->receipts,

            //lançamento
            'taxes'     => $this->entry->taxe

        ];

        //informações do pagador
        $info = array_merge($info, ($bill->category == 'receive') ?  [
            'client'   => [
                'id'           => $bill->idClient,
                'name'         => Str::words($bill->client->name),
                'registration' => Str::words($bill->client->registration)
            ]
        ] : [
            'provider' => [
                'id'           => $bill->idProvider,
                'name'         => Str::words($bill->provider->name),
                'registration' => Str::words($bill->provider->registration)
            ]
        ]);

        return $this->success($this->entry->idBillEntry, $info);

    }

    /*
    |--------------------------------------------------------------------------
    | Pagamento manual
    |--------------------------------------------------------------------------
    */
    public function payment(Request $request){

        //verifica se é um pagamento parcial
        $status = (
            ($this->entry->sumOfPayments() + $request->field('amount')) >= $this->entry->amount
        ) ? 'payed' : 'parcial';

        //adiciona o pagamento da á entrada
        $payment = BillEntryPayment::create($request->all([
            'idBillEntry' => $this->entry->idBillEntry
        ]));

        //se o pagamento foi completo cancela os boletos emitidos
        if($status == 'payed' and !empty($this->entry->bankSlips)){
            foreach ($this->entry->bankSlips as $item){
                $this->pjbank->cancel($item->bankSlip);
            }
        }

        //se foi um pagamento atualiza as informações contabeis
        if($this->entry->bill->category == 'pay'){
            $this->entry->taxe->update(
                $request->field('taxes')
            );
        }


        //atualiza o status da entrada
        $this->entry->update(['status' => $status]);

        //retorna os dados para listagem
        return $this->success($payment->idBillEntryPayment, null, "Efetuou o pagamento da conta a pagar de cód: {$this->entry->idBillEntry}");

    }

    /*
    |--------------------------------------------------------------------------
    | Recibo
    |--------------------------------------------------------------------------
    */
    public function receipt(Request $request){

        return Template::load('documents/receipt', [
            'entry' => $this->entry
        ]);

    }

    /*
    |--------------------------------------------------------------------------
    | Exclusão
    |--------------------------------------------------------------------------
    */
    public function delete(Request $request){

        //remove a conta
        $this->entry->delete();

        if (!empty($request->field('all_pending'))) {
            $this->entry->bill->entries()->where(['status' => 'pendent'])->delete();
        }

        //cancela boletos emitidos
        if(!empty($this->entry->bankSlips)){
            foreach ($this->entry->bankSlips as $item){
                $this->pjbank->cancel($item->bankSlip);
            }
        }

        //retorna para a listagem
        return $this->success($this->entry->idBillEntry, null, "Excluiu a conta {$this->entry->idBillEntry}");

    }

    //taferas cron

    /*
    |--------------------------------------------------------------------------
    | Gera as entradas das contas a pagar
    |--------------------------------------------------------------------------
    */
    public function setEntries(){

        //obtem as cobranças
        $bills = Bill::where(['active' => true])->get();

        //percorre as cobranças gerando as novas entradas
        if($bills and count($bills)){
            foreach($bills as $bill){
                $bill->setEntries([]);
            }
        }


        print "success";

    }

    /*
    |--------------------------------------------------------------------------
    | Gera as entradas das contas a pagar
    |--------------------------------------------------------------------------
    */
    public function setOverdues(){

        //data atual
        $now = now();

        //obtem as entradas não pagas
        $entries = BillEntry::whereIn('status', [
            'pendent'
        ])->get();

        //obtem os boletos emitidos
        $bankSlips = BankSlip::whereIn('status', [
            'pendent'
        ])->get();

        //atualiza as entradas
        if($entries and count($entries)){
            foreach ($entries as $entry){

                //pega o vencimento
                $due = $entry->due->format('Y-m-d');

                if($now->gt($due)){

                    $entry->update([
                        'status' => 'overdue'
                    ]);

                }
            }
        }

        //atualiza os boletos
        if(!empty($bankSlips)){
            foreach ($bankSlips as $bankSlip){

                //pega o vencimento do boelto
                $due = now($bankSlip->due)->format('Y-m-d');

                if($now->gt($due)){

                    $bankSlip->update([
                        'status' => 'overdue'
                    ]);

                }
            }
        }

        print "success";

    }

    /*
    |----------------------------------------------------------------------------
    | Notifica para os Clientes as Contas por parametros - Atrasadas/Antecipados
    |----------------------------------------------------------------------------
    */
    public function notifyPendings(){

        $notifyEntries = [];

        $frequencies = Config::array('frequency');

        foreach ($frequencies as $frequency) {

            $builder = BillEntry::whereHas('bill', function($query) {
                $query->where('category', 'receive');
            });

            if ($frequency->type === 'late') {
                $builder->where('status', "overdue")
                    ->whereDate('due', now()->subDays((int) $frequency->frequency));
            } else {
                $builder->where('status', "pendent")
                    ->whereDate('due', now()->addDays((int) $frequency->frequency));
            }

            foreach ($builder->cursor() as $entry) {
                $notifyEntries[] = [
                    'client'  => $entry->bill->client ?? $entry->bill->provider,
                    'entry'   => $entry
                ];
            }

        }

        // DISPARANDO E-MAILS PARA OS CLIENTES
        foreach ($notifyEntries as $entry) {

            $clientMail = $entry['client']->mails->first();

            $clientDetails = [];

            if ($entry['client']->idClient) {
                $clientDetails['name'] = $entry['client']->type === 'PF' ? $entry['client']->individual->name : $entry['client']->company->name;
            }

            $message = 'Lembrete de Fatura';
            $content = Config::val('content_billing_pendent');

            if ($entry['entry']->status === 'overdue') {
                $message = 'Fatura em Atraso';
                $content = Config::val('content_billing_overdue');
            }

            $mailer = Mailer::to(['bruno.firmiano@inovedados.com.br','eduardo.augusto@inovedados.com.br'])
                ->subject($message)
                ->template('mail.bills.overdue', [
                    'client' => $clientDetails,
                    'content' => $content,
                ]);

            if (Config::val('invoice') === 'Y') {
                $bankSlip = $entry['entry']->bankSlip->bankSlip ?? $this->createBankSlip($entry['entry']);

                if ($entry['entry']->status === 'overdue') {
                    $bankSlip->update(['mulct' => Config::val('mulct'), 'interest' => Config::val('interest')]);

                    $this->pjbank->sync($bankSlip);
                }

                if ($bankSlip) {
                    $fileName = "Fatura-" . now($entry['entry']->due)->format('d-m-Y'). '.pdf';

                    $mailer->stringAttachment($bankSlip->link, $fileName);
                }
            }

            $mailer->send();
        }

        echo "success";
    }

    /*
   |----------------------------------------------------------------------------
   | Criação de Faturas
   |----------------------------------------------------------------------------
   */
    public function createBankSlip($entry)
    {

        //localiza o endereço do cliente
        $address = Arr::first($entry->bill->client->addresses);

        if ($address) {
            //gera o boleto
            $bankSlip = BankSlip::create([
                'idAddress' => $address->idAddress,
                'due' => $entry->due,
                'amount' => $entry->amount,
                'demonstrative' => $entry->description,
                'order' => BankSlip::next()
            ]);

            //associa o boleto a entrada
            BankSlipHasBillEntry::create([
                'idBillEntry' => $entry->idBillEntry,
                'idBankSlip' => $bankSlip->idBankSlip
            ]);

            //HABILITAR PARA DEBUGAR ERRORS
//            if ($this->pjbank->sync($bankSlip)) {
//                return $bankSlip;
//            } else {
//                $bankSlip->update(['status' => 'canceled']);
//                echo "<pre>";var_dump($this->pjbank->error());die;
//            }
            return $this->pjbank->sync($bankSlip) ? $bankSlip : null;
        }

        return null;
    }



}
