<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {

        return [
            'name' => 'required|string|max:45',
            'email' => 'required|string|unique:employees,email,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome é informação obrigatória',
            'unique' => 'Já existe um usuário com este e-mail.',
        ];
    }
}
