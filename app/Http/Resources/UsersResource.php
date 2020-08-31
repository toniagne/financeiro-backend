<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'phones' => $this->phones,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

       // return parent::toArray($request);
    }
}
