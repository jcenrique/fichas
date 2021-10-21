<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FichaRequest extends FormRequest
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
            'ficha.title' => 'required|min:5',
            'ficha.description' => 'required|min:15',
            'ficha.user_id'=> 'required',

        ];
    }

    public function messages()
    {
        return[
              'ficha.title.required' => "El :attribute no puede estar vacio",
              'ficha.description.required' => "El :attribute no puede estar vacio",
             'ficha.title.min' => "El :attribute debe contener minimo  5 caracteres",
             'ficha.description.min' => "La :attribute debe contener minimo  15 caracteres",

        ];
    }

    public function attributes()
 {
     return [
         'ficha.title' => 'ficha',
         'ficha.description' => 'descripción',


     ];
}

}
