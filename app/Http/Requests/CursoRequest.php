<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CursoRequest extends FormRequest
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
            'nombre_curso'=>'required|min:4|max:100|string|unique:cursos',
        ];
    }
    public function messages()
    {
        return [

        'nombre_curso.min:4.max:100.string.unique:cursos'=>'Nombre debe tener minimo de 4 caracteres y maximo 150',

        ];
    }
}
