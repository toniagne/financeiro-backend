<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'observation',
        'service_type_id',
        'service_category_id',
        'recurrence_id',
        'active'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function serviceType(){
        return $this->belongsTo(ServiceType::class, 'service_type_id')->withTrashed();
    }

    public function serviceCategory(){
        return $this->belongsTo(ServiceCategory::class, 'service_category_id')->withTrashed();
    }

    public function recurrence(){
        return $this->belongsTo(Recurrence::class, 'recurrence_id')->withTrashed();
    }

    public function parseMonetary(){
        return  'R$' . number_format(Self::price, 2, ',', '.');
    }
}
