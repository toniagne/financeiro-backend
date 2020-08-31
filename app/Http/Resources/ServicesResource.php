<?php

namespace App\Http\Resources;

use App\Models\ServiceType;
use Illuminate\Http\Resources\Json\JsonResource;

class ServicesResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'service_type_id' => $this->serviceType->id,
            'service_category_id' => $this->serviceCategory->id,
            'recurrence_id' => $this->recurrence_id,
            'service_type' => $this->serviceType->name,
            'service_category' => $this->serviceCategory->name,
            'recurrence' => $this->recurrence->name,
            'price' => $this->price,
            'priceParsed' => $this->parseMonetary($this->price),
            'observation' => $this->observation,
            'created_at' => $this->created_at,
            'active' => $this->active
        ];
    }
    public function parseMonetary($price){
        return  'R$ ' . number_format($price, 2, ',', '.');
    }


}
