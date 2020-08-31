<?php

namespace App\Models;

use App\Services\Recurrency;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Date;


class Bill extends Model
{
    use SoftDeletes;

    protected $occurrences = [];

    protected $fillable = [
        'client_id',
        'payment_category_id',
        'service_id',
        'recurrence_id',
        'negotiation_type_id',
        'amount',
        'description',
        'active',
        'due',
        'category',
        'issue',
        'status'
    ];


    protected $dates = [
        'due',
        'issue',
        'yearly_due',
        'deleted_at'
    ];

    public function attachments(){
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

    public function client(){
        return $this->belongsTo(Client::class, 'client_id')->withTrashed();
    }

    public function bill_entry(){
        return $this->hasMany(BillEntry::class, 'bill_id', 'id')->withTrashed();
    }

    public function provider(){
        return $this->belongsTo(Provider::class, 'provider_id')->withTrashed();
    }

    public function payment_category(){
        return $this->belongsTo(PaymentCategory::class, 'payment_category_id')->withTrashed();
    }

    public function recurrence(){
        return $this->belongsTo(Recurrence::class, 'recurrence_id')->withTrashed();
    }

    public function details(){
        return $this->hasMany(BillDetail::class);
    }

    public function parse_date($date){
        return Carbon::parse($date)->format('Y-m-d');
    }

    public function sendFiles($files){

        if (isset($files)){
            foreach ($files as $file){
                $path = $file->store('bills');
                $this->attachments()->create(['path' => $path]);
            }
        }

        return true;
    }
//methods

    /*
    |--------------------------------------------------------------------------
    | Adiciona as informações de cobrança
    |--------------------------------------------------------------------------
    */
    public function setDetails($data){

        //remove as informações antigas
        BillDetail::where(['bill_id' => $this->id])->delete();

        //cadastra as novas informações de recorrência
        BillDetail::create(array_merge($data, [
            'bill_id' => $this->id
        ]));

    }

    /*
    |--------------------------------------------------------------------------
    | Configura as entradas
    |--------------------------------------------------------------------------
    */
    public function setEntries($parcels = []){

        //api de recorrência
        $this->recurrency = new Recurrency();

        //monta as faturas conforme o intervalo
        switch($this->recurrence->frequency){
            case 'weekly'       : $this->weekly();  break;
            case 'monthly'      : $this->monthly(); break;
            case 'yearly'       : $this->yearly();  break;
            case 'quarterly'    : $this->quarterly();  break;
            case 'semiannually' : $this->semiannually();  break;
            case 'parcels'      : $this->parcels($parcels); break;
            case 'unique'       : $this->unique($parcels);  break;
        }


        //lança as faturas
        foreach($this->occurrences as $due){
            $this->addEntry($due, $this->service_id, $this->amount, $this->description);
        }

    }

    /*
    |--------------------------------------------------------------------------
    | Recorrência semanal
    |--------------------------------------------------------------------------
    */
    protected function weekly(){
        $details = $this->details->first();
        //gera o intervalo
        $this->recurrency->startDate(Date::now())
            ->until(Date::now()->endOfYear())
            ->freq("weekly")
            ->byday($details->weekly_due)
            ->generateOccurrences();

        $this->occurrences = $this->recurrency->occurrences;

    }

    /*
    |--------------------------------------------------------------------------
    | Recorrência mensal
    |--------------------------------------------------------------------------
    */
    protected function monthly(){
        $details = $this->details->first();
        //gera o intervalo
        $this->recurrency->startDate(Date::now())
            ->until(Date::now()->endOfYear())
            ->freq("monthly")
            ->bymonthday($details->day)
            ->generateOccurrences();

        $this->occurrences = $this->recurrency->occurrences;

    }

    /*
    |--------------------------------------------------------------------------
    | Recorrência anual
    |--------------------------------------------------------------------------
    */
    protected function yearly(){
        $details = $this->details->first();
        //extrai o mês e ano
        list($day, $month) = explode('/', $details->yarly_due);

        //gera o intervalo
        $this->recurrency->startDate(Date::now())
            ->freq("monthly")
            ->bymonth($month)
            ->bymonthday($day)
            ->count(1)
            ->generateOccurrences();

        $this->occurrences = $this->recurrency->occurrences;

    }

    /*
    |--------------------------------------------------------------------------
    | Recorrência trimestral
    |--------------------------------------------------------------------------
    */
    protected function quarterly(){
        $details = $this->details->first();
        //gera o intervalo
        $this->recurrency->startDate(Date::now())
            ->until(Date::now()->endOfYear())
            ->freq("monthly")
            ->interval(3)
            ->bymonthday($details->day)
            ->generateOccurrences();

        $this->occurrences = $this->recurrency->occurrences;

    }

    /*
    |--------------------------------------------------------------------------
    | Recorrência semestral
    |--------------------------------------------------------------------------
    */
    protected function semiannually(){
        $details = $this->details->first();
        //gera o intervalo
        $this->recurrency->startDate(Date::now())
            ->until(Date::now()->endOfYear())
            ->freq("monthly")
            ->interval(6)
            ->bymonthday($details->day)
            ->generateOccurrences();

        $this->occurrences = $this->recurrency->occurrences;

    }

    /*
    |--------------------------------------------------------------------------
    | Adiciona as entradas manualmente
    |--------------------------------------------------------------------------
    */
    protected function parcels($parcels){

        // REPETIÇÃO PARA CADASTRO NAS ENTRADAS
        for ($i = 1; $i <= $parcels; $i++){

            // MESCLA O DIA SELECIONADO COM A DATA PARSEADA ADICIONANDO O MES DINAMICAMENTE
            $dateReceive = Carbon::parse($this->day.'-'.date('m-Y'))->addMonths($i);

            // GRAVA OS DADOS NA TABELA DE ENTRADAS
            $this->bill_entry()->create([
                'due'           => $dateReceive->format('Y-m-d'),
                'amount'        => $this->amount,
                'description'   => $this->description,
                'status'        => $this->status
            ]);

        }


    }

    /*
    |--------------------------------------------------------------------------
    | Adiciona o vencimento como uma entrada única
    |--------------------------------------------------------------------------
    */
    protected function unique($entry){
        $this->occurrences[] = $this->due->format('Y-m-d');
    }

    /*
    |--------------------------------------------------------------------------
    | Adiciona a fatura
    |--------------------------------------------------------------------------
    */
    protected function addEntry($due, $service, $amount, $description) {

        //gera a entrada
        $entry = BillEntry::firstOrCreate([
            'bill_id'      => $this->id,
            'due'         => $due
        ], [
            'bill_id'      => $this->id,
            'amount'      => $amount,
            'description' => $description,
            'status'      => $this->status
        ]);


        //cadastra as informações da planilha de lançamento
        if($this->category == 'pay'){

            Taxe::create([
                'idBillEntry' => $entry->idBillEntry,
                'day'         => $due->format('d'),
                'month'       => $due->format('m'),
                'year'        => $due->format('Y'),
                'amount'      => $amount,
                'description' => $description
            ]);

        }

    }


}
