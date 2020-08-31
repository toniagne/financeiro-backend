<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'phone',
        'occupattion_id',
        'cnpj',
        'contract_type',
        'graduation_details',
        'img_address',
        'img_document',
        'img_graduation',
        'img_profile',
        'observation',
        'pay_day',
        'pay_type',
        'salary',
        'status',
        'workflow'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roulesSearch(){
        return [
            'name' => 'required'
        ];
    }
    public function occupation(){
        return $this->belongsTo(Occupation::class, 'occupattion_id');
    }

    public function addresses(){
        return $this->morphMany(Address::class, 'addressable');
    }

    public function phones(){
        return $this->morphMany(Phone::class, 'phonable');
    }

    public function banks(){
        return $this->morphMany(Bank::class, 'bankable');
    }

    public function service_type(){
        return $this->belongsTo(ServiceType::class, 'contract_type')->withTrashed();
    }

    public function setPhones(array $phones = [])
    {
        $this->phones()->forceDelete();

        $this->phones()->createMany($phones);
    }

    public function setBanks(array $banks = [])
    {
        $this->banks()->forceDelete();

        $this->banks()->createMany($banks);
    }

    public function setAddresses(array $addresses = [])
    {
        $this->addresses()->forceDelete();

        $this->addresses()->createMany([$addresses]);
    }

}
