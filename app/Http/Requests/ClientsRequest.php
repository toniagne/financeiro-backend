<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientsRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required|string|max:45',
            'type' => 'required|string',
            'email' => 'required|string|email|unique:clients,email,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome é informação obrigatória',
            'type.required' => 'Selecione o tipo de cliente',
            'unique' => 'Já existe um usuário com este e-mail.',
        ];
    }
}
