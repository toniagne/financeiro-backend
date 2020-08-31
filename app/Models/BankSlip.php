<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class BankSlip extends Model
{
    //allowed
    protected $fillable   = [
        'idAddress',
        'number',
        'digitable',
        'order',
        'due',
        'amount',
        'interest',
        'mulct',
        'discount',
        'link',
        'status',
        'demonstrative'
    ];

    public $translations = [

        'status' => [
            'pendent'  => 'Aguardando pagamento',
            'overdue'  => 'Em atraso',
            'payed'    => 'Pago',
            'canceled' => 'Cancelado'
        ],

        'labels' => [
            'pendent'  => 'info',
            'overdue'  => 'warning',
            'payed'    => 'sucess',
            'canceled' => 'danger'
        ]

    ];

    //soft delete trait
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | Retorna a cobrança
    |--------------------------------------------------------------------------
    */
    public function bill(){
        return $this->hasOne(Bill::class, 'bill_id', 'id');
    }

    /*
    |--------------------------------------------------------------------------
    | Retorna o endereço
    |--------------------------------------------------------------------------
    */
    public function address(){
        return $this->hasOne(Address::class, 'address_id', 'id');
    }

    /*
    |--------------------------------------------------------------------------
    | Retorna as entradas
    |--------------------------------------------------------------------------
    */
    public function entries(){
        return $this->hasMany(BankSlipHasBillEntry::class, 'bank_slip_id', 'id');
    }

    /*
    |--------------------------------------------------------------------------
    | Retorna o demonstrativo de serviços
    |--------------------------------------------------------------------------
    */
    public function serviceDemonstrative(){

        $demonstrative = '';

        foreach ($this->entries as $item){
            $demonstrative .= $item->entry->demonstrative();
        }

        return $demonstrative;
    }

    /*
    |--------------------------------------------------------------------------
    | Retorna o número de pedido do boleto
    |--------------------------------------------------------------------------
    */
    public static function next() {

        //pega o último registro
        $last = self::orderBy('bank_slip_id', 'desc')->first();

        if(empty($last)){
            return '10000005';
        }else{

            //calcula o próximo número
            $next = Str::pad($last->order, 8);

            //checka duplicidades
            while (self::where(['order' => $next])->first()){
                $next = Str::pad($next, 8);
            }

            return $next;

        }

    }

}
