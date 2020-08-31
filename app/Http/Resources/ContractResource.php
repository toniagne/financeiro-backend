<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
{

    public function toArray($request)
    {

       return [
           'id' => $this->id,
           'name' => $this->name,
           'employee_id' => $this->employee_id,
           'provider_id' => $this->provider_id,
           'observation' => $this->observation,
           'active' => $this->active,
           'date_start' => $this->date_start,
           'date_end' => $this->date_end,
           'file' => $this->file,
           'date_start_description' => $this->date_start->format('d/m/Y'),
           'date_end_description' => $this->date_end->format('d/m/Y'),
           'permanent' => $this->permanent,
           'type' => $this->type,
           'type_description' => $this->getType($this->type),
           'client' => $this->type == "provider" ? $this->provider->name : $this->employee->name
           ];
    }

    public function getType($arg){
        return $arg == 'provider'? 'Fornecedor' : 'Funcionário';
    }
}
