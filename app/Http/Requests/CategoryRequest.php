<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'category.name' => 'required|min:5',
            'category.description' => 'required|min:15',
            'category.code'=> 'required|min:3|max:5',
        ];
    }

    public function messages()
    {
        return[
              'category.name.required' => "El :attribute no puede estar vacio",
              'ficha.description.required' => "El :attribute no puede estar vacio",
             'category.name.min' => "El :attribute debe contener minimo  5 caracteres",
             'category.description.min' => "La :attribute debe contener minimo  15 caracteres",
             'category.code.max' => "El :attribute debe contener máximo  5 caracteres",
             'category.code.min' => "El :attribute debe contener minimo  2 caracteres",
             'category.code.required' => "El :attribute no puede estar vacio",


        ];
    }

    public function attributes()
    {
        return [
         'category.name' => 'ficha',
         'category.description' => 'descripción',
         'category.code' => 'código',


     ];
    }
}
