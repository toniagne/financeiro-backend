<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'path',
        'bankable_id',
        'agency',
        'account',
        'bank_name'
    ];

    public function bankable()
    {
        return $this->morphTo();
    }
}
