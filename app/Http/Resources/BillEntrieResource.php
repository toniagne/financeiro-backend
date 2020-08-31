<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Resources\Json\JsonResource;

class BillEntrieResource extends JsonResource
{
    use SoftDeletes;

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'due' => $this->due->format('d/m/Y'),
            'description' => $this->description,
            'amount' => $this->amount,
            'charging' => $this->charging,
            'status' => $this->status(),
            'bill' => new BillResource($this->bill)
        ];
    }
}
