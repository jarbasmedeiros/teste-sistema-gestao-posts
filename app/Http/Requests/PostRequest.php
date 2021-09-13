<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'image_url' => 'required|url'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'o campo :attribute é obrigatório',
            'min' => 'O campo :attribute deve ter no mínimo :min caracteres',
            'url' => 'O endereço da :attribute deve ser válido'
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'título',
            'description' => 'descrição',
            'image_url' => 'imagem'
        ];
    }

}


