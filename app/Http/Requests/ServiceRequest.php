<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:45',
            'price' => 'required',
            'observation' => 'required|string',
            'service_type_id' => 'required',
            'service_category_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome é informação obrigatória',
            'price.required' => 'Valor é informação obrigatória',
            'observation.required' => 'Observação é informação obrigatória',
            'service_type_id.required' => 'Tipo do serviço é informação obrigatória',
            'service_category_id.required' => 'Categoria do serviço é informação obrigatória'
        ];
    }
}
