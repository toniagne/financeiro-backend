<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankSlipHasBillEntry extends Model
{
    //allowed
    protected $fillable   = [
        'bill_entry_id',
        'bank_slip_id'
    ];


    /*
    |--------------------------------------------------------------------------
    | Retorna o boleto
    |--------------------------------------------------------------------------
    */
    public function bankSlip(){
        return $this->hasOne(BankSlip::class, 'bank_slip_id', 'id');
    }

    /*
    |--------------------------------------------------------------------------
    | Retorna a fatura
    |--------------------------------------------------------------------------
    */
    public function entry(){
        return $this->hasOne(BillEntry::class, 'bill_entry_id', 'id');
    }

}
