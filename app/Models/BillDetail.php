<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillDetail extends Model
{
    use SoftDeletes;

   protected $fillable = [
       'day',
       'bill_id',
       'weekly_due',
       'first_bi_weekly_due',
       'second_bi_weekly_due',
       'yearly_due',
   ];

    protected $dates = [
        'deleted_at'
    ];

    public function bill(){
        return $this->belongsTo(Bill::class, 'bill_id');
    }
}
