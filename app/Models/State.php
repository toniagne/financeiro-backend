<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public static function getStateId($arg){
        $city = Self::where('letter', $arg)->first();
        return $city->id;
    }
}
