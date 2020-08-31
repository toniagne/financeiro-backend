<?php

namespace App;

use App\Models\Address;
use App\Models\Permission;
use App\Models\Phone;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;


    protected $fillable = [
        'name', 'email', 'password', 'cpf', 'phone', 'blocked'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roulesSearch(){
        return [
            'name' => 'required'
        ];
    }

    public function permission(){
        return $this->hasOne(Permission::class, 'user_id')->withTrashed();
    }

    public function addresses(){
        return $this->morphMany(Address::class, 'addressable');
    }

    public function phones(){
        return $this->morphMany(Phone::class, 'phonable');
    }

    public function setPhones(array $phones = [])
    {
        $this->phones()->forceDelete();

        $this->phones()->createMany($phones);
    }


}
