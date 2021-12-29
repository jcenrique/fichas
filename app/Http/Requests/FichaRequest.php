<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FichaRequest extends FormRequest
{


    public function __construct()
    {
    }

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
            'ficha.roles' => 'required',
            'ficha.title' => 'required|min:5',
            'ficha.description' => 'required|min:15',
            'ficha.user_id' => 'required',
            'codigo' => 'required',
            'category_id' => 'required'


        ];
    }

    public function messages()
    {

        return [
            'ficha.title.required' => "El  campo :attribute no puede estar vacío",
            'ficha.description.required' => "El  campo :attribute no puede estar vacío",
            'ficha.title.min' => "El :attribute debe contener minimo  5 caracteres",
            'ficha.description.min' => "La :attribute debe contener minimo  15 caracteres",
            'ficha.user_id.required' => "El campo :attribute no puede estar vacío",
            'ficha.roles.required' => "El campo :attribute no puede estar vacío",
            'codigo.required' => "El campo :attribute no puede estar vacío",
            'category_id.required' => "El campo :attribute no puede estar vacío",

        ];
    }

    public function attributes()
    {
        return [
            'ficha.title' => 'Título',
            'ficha.description' => 'Descripción',
            'ficha.roles' => 'Roles',
            'ficha.user_id' => "Autor",
            'codigo' => "Código",
            'category_id' => "Categoría",

        ];
    }
}
