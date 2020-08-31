<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Resources\Json\JsonResource;

class BillResource extends JsonResource
{
    use SoftDeletes;

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'client' => $this->client_id ? $this->client->name : $this->provider->name,
            'client_email' => $this->client->email,
            'created' => $this->created_at->format('d/m/Y'),
            'description' => $this->description,
            'client_id' => $this->client_id,
            'provider_id' => $this->provider_id,
            'negotiation_id' => $this->negotiation_id,
            'recurrence_id' => $this->recurrence_id,
            'payment_category_id' => $this->payment_category_id,
            'amount' => $this->amount,
            'recurrence' => $this->recurrence->name,
            'payment_category' => $this->payment_category->name,
            'bill_details' => $this->bill_details,
            'entries' => $this->bill_entry
        ];
    }
}
