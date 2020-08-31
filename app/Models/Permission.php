<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class Permission extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'clients',
        'providers',
        'services',
        'proposals',
        'bank_slips',
        'fiscal_notes',
        'bills_to_pay',
        'bills_to_receive',
        'contracts',
        'configs',
        'employees',
    ];

    protected $dates = [
        'deleted_at',
    ];

    //permissões do usuário
    protected $parsed    = [];
    protected $allocated = [];


    /*
    |--------------------------------------------------------------------------
    | Aplica as permissões ao funcionário
    |--------------------------------------------------------------------------
    */

    public function parse()
    {
        //monta as permissões
        foreach ($this->available() as $column) {

        //quebra as permissões em um array
            $content = explode(';', $this->{$column->Field});

        //adiciona as permissões
            $this->parsed[$column->Field] = [
                'create' => (@!empty($content[0]) and $content[0] == 1),
                'view' => (@!empty($content[1]) and $content[1] == 1),
                'edit' => (@!empty($content[2]) and $content[2] == 1),
                'delete' => (@!empty($content[3]) and $content[3] == 1),
                'add' => (@!empty($content[4]) and $content[4] == 1)
            ];

        }

        return $this->parsed;

    }

    /*
    |--------------------------------------------------------------------------
    | Retorna as colunas de permissões
    |--------------------------------------------------------------------------
    */

    private static function available()
    {
        return DB::select(
            DB::raw("SHOW COLUMNS FROM permissions WHERE Field NOT IN ('id','user_id', 'created_at', 'updated_at', 'deleted_at')")
        );
    }

    public static function setPermissions($idUser, array $permissions = []){


        //permissões alocadas
        $allocated = [];

        //remove permissões antigas
        self::where(['user_id' => $idUser])->delete();

        //monta as permissões
        foreach (self::available() as $column) {

            //verifica se a permissão foi enviada
            if(Arr::get($permissions, $column->Field)){

                $C = (!empty($permissions[$column->Field]['create'])) ? '1' : '0';
                $R = (!empty($permissions[$column->Field]['view']))   ? '1' : '0';
                $U = (!empty($permissions[$column->Field]['edit'])) ? '1' : '0';
                $D = (!empty($permissions[$column->Field]['delete'])) ? '1' : '0';
                $A = (!empty($permissions[$column->Field]['add'])) ? '1' : '0';

                $allocated[$column->Field] = "{$C};{$R};{$U};{$D};{$A}";

            }else{
                $allocated[$column->Field] = '0;0;0;0;0';
            }

        }

        //cadastra as novas permissões
        self::create(array_merge([
            'user_id' => $idUser,
        ], $allocated));

    }


}
