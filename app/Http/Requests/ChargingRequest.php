<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChargingRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {

        return [
            'client_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'Cliente é uma informação obrigatória',
        ];
    }
}
