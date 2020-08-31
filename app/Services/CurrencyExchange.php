<?php

/*
 * File        : CurrencyExchange.php
 * Description : Serviço auxiliar para retorno do valor corrente das moedas EURO - DOLLAR
*/

namespace App\Services;

use App\Models\BankSlip;
use App\Models\BillEntry;
use App\Models\Bank;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class CurrencyExchange  {

    protected $dollar;
    protected $euro;
    /*
    |--------------------------------------------------------------------------
    | Builder
    |--------------------------------------------------------------------------
    */
    public function __construct(){

        //instância um cliente do webservice
        $this->dollar = Http::get('https://api.ratesapi.io/api/latest?base=USD&symbols=BRL');
        $this->euro = Http::get('https://api.ratesapi.io/api/latest?base=EUR&symbols=BRL');
    }

    /*
    |--------------------------------------------------------------------------
    | Resolve a URL da chamada
    |--------------------------------------------------------------------------
    */
    public function url($currency){

        switch ($currency){
            case 'dollar':
                $rate = $this->dollar->json(); break;
            case 'euro':
                $rate = $this->euro->json(); break;
        }

        return $rate['rates']['BRL'];
    }



}
