<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {

        return [
            'name' => 'required|string|max:45',
            'email' => 'required|string|unique:users,email,'.$this->id,
            'password' => 'required|string|min:6',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome é informação obrigatória',
            'password.required' => 'Senha é informação obrigatória',
            'unique' => 'Já existe um usuário com este e-mail.',
            'min' => 'A senha deve ter mínimo de 6 caracteres'
        ];
    }
}
