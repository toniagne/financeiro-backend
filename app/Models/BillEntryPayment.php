<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillEntryPayment extends Model
{
    //allowed
    protected $fillable   = [
        'bill_entry_id',
        'bank_slip_id',
        'date',
        'amount',
        'description',
        'created_at'
    ];

    /*
    |--------------------------------------------------------------------------
    | Retorna a entrada
    |--------------------------------------------------------------------------
    */
    public function entry(){
        return $this->hasOne(BillEntry::class, 'bill_entry_id', 'id');
    }

    /*
    |--------------------------------------------------------------------------
    | Retorna o boleto que pagou a fatura
    |--------------------------------------------------------------------------
    */
    public function slip(){
        return $this->hasOne(BankSlip::class, 'bank_slip_id', 'id');
    }

}
