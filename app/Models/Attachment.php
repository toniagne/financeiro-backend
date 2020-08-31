<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'path',
        'attachmentable_id'
    ];

    public function attachable()
    {
        return $this->morphTo();
    }

}
