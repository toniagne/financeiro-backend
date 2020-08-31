<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProviderResource extends JsonResource
{

    public function toArray($request)
    {
        return  [
            'id' => $this->id,
            'type' => $this->type,
            'cnpj' => $this->cnpj,
            'cpf' => $this->cpf,
            'document' => $this->cpf ? $this->parseDocument($this->cpf, 'cpf') : $this->parseDocument($this->cnpj, 'cnpj'),
            'ie' => $this->ie,
            'im' => $this->im,
            'name' => $this->name,
            'email' => $this->email,
            'fantasy' => $this->fantasy,
            'description' => $this->description,
            'active' => $this->active,
            'phones' => $this->phones,
            'address' => AddressResource::collection($this->addresses)
        ];
    }

    public function parseDocument($document, $par){

        switch ($par){
            case 'cpf':
                return $document ?
                    substr($document, 0, 3).'.'.
                    substr($document, 3, 3).'.'.
                    substr($document, 6, 3).'-'.
                    substr($document, 9, 3) : '';
                break;

            case 'cnpj':
                return
                    $document ?
                        substr($document, 0, 2).'.'.
                        substr($document, 5, 3).'.'.
                        substr($document, 7, 3).'/'.
                        substr($document, 10, 4).'-'.
                        substr($document, 12, 2) : '';
                break;
        }


    }

}
