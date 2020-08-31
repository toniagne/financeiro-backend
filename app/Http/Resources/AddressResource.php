<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'city_id' => $this->city_id,
            'complement' => $this->complement,
            'address' => $this->address,
            'neighborhood' => $this->neighborhood,
            'number' => $this->number,
            'zipcode' => $this->zipcode,
            'state' => $this->city->state->id
        ];
    }
}
