<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacts extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'contactable_id',
        'name',
        'phone',
        'email',
        'file'
    ];

    public function contactable()
    {
        return $this->morphTo();
    }
}
