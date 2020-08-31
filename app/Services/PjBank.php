<?php

/*
 * File        : PJBank.php
 * Description : Serviço auxiliar de integração com a API de emissão de boletos
*/

namespace App\Services;

use App\Models\BankSlip;
use App\Models\BillEntry;
use App\Models\Bank;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PJBank  {

    protected $curl;
    protected $url = 'https://api.pjbank.com.br/contadigital/05483d3918cd7ea0189c335f4882ee3179ad6657';

    /*
    |--------------------------------------------------------------------------
    | Builder
    |--------------------------------------------------------------------------
    */
    public function __construct(){

        //instância um cliente do webservice
        $this->curl = Http::get($this->url, ['X-CHAVE-CONTA', 'b34420a391588384adff3ed3151802abdfdf0285']);


    }

    /*
    |--------------------------------------------------------------------------
    | Resolve a URL da chamada
    |--------------------------------------------------------------------------
    */
    public function url($path){
        $this->url = "{$this->url}/{$path}"; return $this;
    }

    /*
    |-------------------------------------------------------------------------
    | Chamada POST
    |--------------------------------------------------------------------------
    */
    public function post($data = []){
        $this->curl->header('Content-Type', 'application/json');
        $this->curl->post($this->url, $data);
        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Chamada DELETE
    |--------------------------------------------------------------------------
    */
    public function delete($data = []){
        $this->curl->header('Content-Type', 'application/x-www-form-urlencoded');
        $this->curl->delete($this->url, $data);
        return $this;
    }

    /*
    |--------------------------------------------------------------------------
    | Retorna a resposta da API
    |--------------------------------------------------------------------------
    */
    public function response(){
        if(!$this->curl->failed) {
            return $this->curl->clientError;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Retorna a mensagem de erro
    |--------------------------------------------------------------------------
    */
    public function error(){
        return $this->curl->failed . ': ' . $this->curl->clientError;
    }


    //wrappers

    /*
    |--------------------------------------------------------------------------
    | Sincroniza um boleto com a API do PJBank
    |--------------------------------------------------------------------------
    */
    public function sync(BankSlip $bankSlip){

        //envia o post com os dados do boleto
        $response = $this->url('recebimentos/transacoes')->post([
            'valor'               => $bankSlip->amount,
            'multa'               => $bankSlip->mulct ?? 0,
            'juros'               => $bankSlip->interest ?? 0,
            'nome_cliente'        => $bankSlip->address->client->name,
            'vencimento'          => now($bankSlip->due)->format('m/d/Y'),
            'cpf_cliente'         => St::nums($bankSlip->address->client->registration),
            'endereco_cliente'    => $bankSlip->address->street,
            'numero_cliente'      => $bankSlip->address->number,
            'complemento_cliente' => Str::print($bankSlip->address->complement),
            'bairro_cliente'      => $bankSlip->address->neighborhood,
            'cidade_cliente'      => $bankSlip->address->city->name,
            'estado_cliente'      => $bankSlip->address->state->initials,
            'cep_cliente'         => Str::nums($bankSlip->address->cep),
            'pedido_numero'       => $bankSlip->order,
            'logo_url'            => "https://financeiro.inovedados.com.br/cdn/img/logo/boleto.jpg",
            'texto'               => $bankSlip->serviceDemonstrative(),
        ])->response();

        if($response){

            //verifica se a data do venciemento foi atualizada
            $deadline = (empty($response->vencimento_atualizado)) ? $bankSlip->due : now($response->vencimento_atualizado)->format('Y-m-d');

            //atualiza o boleto com as informações do PJBank
            $bankSlip->update([
                'number'    => $response->id_unico,
                'digitable' => $response->linhaDigitavel,
                'link'      => $response->linkBoleto,
                'due'       => $deadline
            ]);

            return true;

        }

    }

    /*
    |--------------------------------------------------------------------------
    | Cancela o boleto
    |--------------------------------------------------------------------------
    */
    public function cancel(BankSlip $slip){

        //verifica se já foi cancelado
        if($slip->status != 'canceled'){

            //solicita o cancelamento junto ao PJBank
            $response = $this->url("recebimentos/transacoes/{$slip->order}")->delete()->response();

            if($response){

                //atualiza o boleto com as informações do PJBank
                $slip->update(['status' => 'canceled']);

                return true;

            }

        }

        return true;

    }

}
