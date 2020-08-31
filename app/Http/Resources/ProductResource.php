<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'product_category_id' => $this->product_category_id,
            'value' => $this->value,
            'currence_rate' => $this->currence_rate,
            'total' => $this->price,
            'status' => $this->status,
            'observation' => $this->observation,
            'productCategory' => $this->product_category->name,
            'details' => $this->product_details
        ];
    }
}
