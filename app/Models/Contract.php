<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use SoftDeletes;

    protected  $fillable = [
        'name',
        'employee_id',
        'provider_id',
        'observation',
        'date_start',
        'date_end',
        'permanent',
        'active',
        'type',
        'file'
    ];

    protected $dates = [
        'created',
        'updated',
        'date_start',
        'date_end'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function provider(){
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function parse_date($date){
        return Carbon::parse($date)->format('Y-m-d');
    }

}
