<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function state(){
        return $this->belongsTo(State::class, 'state_id');
    }

   public static function getCityId($arg){
       $city = Self::where('title', $arg)->first();
       return $city->id;
   }
}
