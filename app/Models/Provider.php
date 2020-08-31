<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provider extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'type',
        'cnpj',
        'ie',
        'im',
        'cpf',
        'name',
        'fantasy',
        'email',
        'description',
        'active'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function addresses(){
        return $this->morphMany(Address::class, 'addressable');
    }

    public function phones(){
        return $this->morphMany(Phone::class, 'phonable');
    }

    function formatPhoneNumber($data) {
        return
            "(".substr($data, 0, 2).")".substr($data, 2, 5)."-".substr($data,5, 9);
    }

    public function setPhones(array $phones = [])
    {
        $this->phones()->forceDelete();

        $this->phones()->createMany($phones);
    }

    public function setContacts(array $contacts = [])
    {
        $this->contacts()->forceDelete();

        $this->contacts()->createMany($contacts);
    }

    public function setAddresses(array $addresses = [])
    {
        $this->addresses()->forceDelete();

        $this->addresses()->createMany([$addresses]);
    }
}
