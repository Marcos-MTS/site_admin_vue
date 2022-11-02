<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->id,
            //'password' => 'required',
            'new_image' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048',
            'users_levels_id' => 'int|required',
        ];
    }

    public function messages()
    {
        return [            
            'name.required' => 'Informe o nome!',
            'email.required' => 'Informe o email!',
            'email.email' => 'Informe um email válido!',
            'email.unique' => 'Outro usuário possui o mesmo email!',
            'image.mimes' => 'Extenção do arquivo inválido!',
            'image.max' => 'Tamanho máximo do arquivo excedido!',
            'users_levels_id.required' => 'Informe o perfil!',
            'users_levels_id.int' => 'Formato do perfil inválido!',
        ];
    }
}
