<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProposalResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->created,
            'client_id' => $this->client_id,
            'category_id' => $this->category_id,
            'validity' => $this->validity,
            'validity_description' => $this->validity->format('d/m/Y'),
            'observation' => $this->observation,
            'value' => $this->value,
            'value_parsed' =>  'R$' . number_format($this->value, 2, ',', '.'),
            'situation' => $this->situation,
            'file' => $this->file,
            'situation_description' => $this->situation($this->situation),
            'client' => $this->client,
            'category' => $this->category
        ];
    }
}
