<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Charging extends Model
{
    protected $fillable = [
        'client_id',
        'bill_entry_id',
        'user_id'
    ];


    public function bill_entry(){
        return $this->hasMany(BillEntry::class, 'id', 'bill_entry_id')->withTrashed();
    }

    public function client(){
        return $this->belongsTo(Client::class, 'client_id')->withTrashed();
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function verified($requests)
    {
        // CONSULTA SE EXISTE ALGUMA COBRANÇA
        $charging = self::where('client_id', $requests['client_id'])
            ->where('bill_entry_id', $requests['bill_entry_id'])
            ->orderBy('id', 'DESC')
            ->first();

        // CASO OBTEVE ALGUM RESULTADO
            if ($charging){
                    // RETORNA A DIFERENÇA DE DIAS
                        $diffDays = now()->diffInDays($charging->created_at);

                    // SE PASSOU DE 3 DIAS
                        if ($diffDays >= 3) {
                            return true;
                        }

        // SE NÃO RETORNA VERDADEIRO
            } else {

                return true;
            }
    }
}
