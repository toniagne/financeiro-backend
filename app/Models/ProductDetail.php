<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $fillable = [
        'productable_id',
        'key',
        'value'
    ];

    public function productable()
    {
        return $this->morphTo();
    }
}
