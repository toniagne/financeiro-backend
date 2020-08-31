<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMargin extends Model
{
    protected $fillable = [
        'name',
        'dolar_value',
        'fixed_margin',
        'margin',
        'custom_margin'
    ];
}
