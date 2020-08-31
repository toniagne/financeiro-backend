<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required|string|max:45',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nome é informação obrigatória.',
            'name.max' => "Você deve digitar um nome até 45 caracteres."
        ];
    }
}
