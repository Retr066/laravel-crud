<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstudianteRequest extends FormRequest
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
            'nombres'=>'required|min:4|max:100|string',
            'apellidos'=>'required|min:4|max:100',
            'fecha_de_nacimiento'=>'required|date',
            'correo'=>'required|email',
            'curso'=>'required'
            ,
        ];
    }

    public function messages()
    {
        return [

        'nombres.min:4.max:100.string'=>'Nombre debe tener minimo de 4 caracteres y maximo 150',
        'apellidos.min:4.max:100'=>'Nombre debe tener minimo de 4 caracteres ',
        'fecha_de_nacimiento.date'=>'Nombre debe tener minimo de 4 caracteres y maximo 150',
        'correo.unique:estudiantes.email'=>'Nombre debe tener minimo de 4 caracteres ',




        ];
    }
}
