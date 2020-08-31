<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Client extends Model
{
    use SoftDeletes;
    use Notifiable;

   protected $fillable = [
       'type',
       'description',
       'active',
       'name',
       'cnpj',
       'cpf',
       'ie',
       'im',
       'billing',
       'email',
       'fantasy'
   ];

    public function addresses(){
        return $this->morphMany(Address::class, 'addressable');
    }


    public function phones(){
        return $this->morphMany(Phone::class, 'phonable');
    }

    public function contacts(){
        return $this->morphMany(Contacts::class, 'contactable');
    }

    public function bill(){
        return $this->hasMany(Bill::class, 'client_id')->withTrashed();
    }

    public function search($filters){
        $v_Query = self::where('active', 1);
        
        $v_Query->when(isset($filters['sort']), function ($query) use ($filters){
            return $query->orderBy( 'name', $filters['sort']);
        });

        $v_Query->when(isset($filters['filter']), function ($query) use ($filters){
            return $query->where( 'name', 'like', '%'.$filters['filter'].'%');
        });

        return $v_Query->get();
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
