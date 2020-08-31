<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChargingResource extends JsonResource
{

    public function toArray($request)
    {
      return [
          'id' => $this->id,
          'client' => $this->client->name,
          'bill_entry' => $this->bill_entry,
          'user' => $this->user->name,
          'date' => $this->created_at->format('d/m/Y')
      ];
    }
}
