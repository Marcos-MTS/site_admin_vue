<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'email|required',
            'password' => 'required'
        ];
    }

    public function messages()
    {
        return [            
            'email.required' => 'Informe o email!',
            'email.email' => 'Informe um email válido!',
            'password.required' => 'Informe a senha!',
        ];
    }
}
