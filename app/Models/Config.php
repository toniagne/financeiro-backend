<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Config extends Model
{
    //campos cadastraveis
    protected $fillable   = [
        'name',
        'value'
    ];

    //nome de mapeamento
    const name = "configuração";

    //soft delete trait
    use SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | Decodifica e retorna uma configuração de array
    |--------------------------------------------------------------------------
    */
    public static function val($key, $default = ''){

        //localiza a configuração
        $config = self::where(['name' => $key])->first();

        return ($config) ? $config->value : $default;

    }

    /*
    |--------------------------------------------------------------------------
    | Decodifica e retorna uma configuração de array
    |--------------------------------------------------------------------------
    */
    public static function array($key, $default = []){

        //localiza a configuração
        $config = self::where(['name' => $key])->first();

        return ($config) ? json_decode($config->value) : $default;

    }

}
