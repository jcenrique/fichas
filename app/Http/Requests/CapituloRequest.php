<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CapituloRequest extends FormRequest
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
            'title' => 'required|min:5|max:100',
            'body' => 'required|min:50',

        ];
    }

    public function messages()
    {
        return[
              'title.required' => "El :attribute no puede estar vacio",
              'body.required' => "El :attribute no puede estar vacio",
             'title.min' => "El :attribute debe contener minimo  5 caracteres",
             'title.max' => "El :attribute debe contener 100 caracteres como máximo",
             'body.min' => "El :attribute debe contener minimo  50 caracteres",



        ];
    }

    public function attributes()
    {
        return [
         'title' => 'título',
         'body' => 'contenido',


     ];
    }
}
