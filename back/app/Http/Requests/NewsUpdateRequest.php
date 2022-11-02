<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'author' => 'required',
            'categorie_id' => 'int|required',
            'new_image' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048'
        ];
    }

    public function messages()
    {
        return [            
            'title.required' => 'Informe o título!',
            'author.required' => 'Informe o autor!',
            'categorie_id.required' => 'Informe a categoria!',
            'categorie_id.int' => 'Formato da categoria inválida!',
            'new_image.mimes' => 'Extenção do arquivo inválido!',
            'new_image.max' => 'Tamanho máximo do arquivo excedido!',
        ];
    }
    
}
