<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cpf' => $this->cpf,
            'cnpj' => $this->cnpj,
            'document' => $this->cpf ? $this->parseDocument($this->cpf, 'cpf') : $this->parseDocument($this->cnpj, 'cnpj'),
            'email' => $this->email,
            'contract_type' => $this->contract_type,
            'graduation_details' => $this->graduation_details,
            'img_address' => $this->img_address,
            'img_document' => $this->img_document,
            'img_graduation' => $this->img_graduation,
            'img_profile' => $this->img_profile,
            'observation' => $this->observation,
            'pay_day' => $this->pay_day,
            'pay_type' => $this->pay_type,
            'salary' => $this->salary,
            'status' => $this->status,
            'workflow' => $this->workflow,
            'service_type' => $this->service_type,
            'occupattion_id' => $this->occupation->id,
            'occupation' => $this->occupation->name,
            'phones' => $this->phones,
            'banks' => $this->banks,
            'address' => $this->addresses
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
