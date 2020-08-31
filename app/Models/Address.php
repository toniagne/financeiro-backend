<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'addressable_id',
        'address',
        'city_id',
        'number',
        'neighborhood',
        'complement',
        'category',
        'zipcode'
    ];

    public function city(){
        return $this->belongsTo(City::class, 'city_id');
    }

    public function addressable()
    {
        return $this->morphTo();
    }
}
