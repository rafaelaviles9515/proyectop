<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeliculaRequest extends FormRequest
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
            'titulo'=> ['required', 'string', 'max:255'],
            'estreno' => ['nullable'],
            'ano' => ['required', 'integer'],
            'cantidad' => ['required','numeric'],
            'saldo_compra' => ['nullable','numeric'],
            'saldo_alquiler' => ['nullable','numeric'],
            'categoria_id' => ['required','integer'],
        ];
    }
    public function messages(){
        return [
            'titulo.required' => 'Este campo es requerido.',
            'titulo.string' => 'Este campo debe ser caracteres.',
            'titulo.max' => 'Este campo debe tener como maximo 255 caracteres.',
            'estreno.required' => 'el campo estreno es requerido.',
            'estreno.integer' => 'Este campo estreno debe ser entero.',
            'ano.required' => 'Este campo es requerido.',
            'ano.integer' => 'Este campo debe ser entero.',
            'cantidad.required' => 'Este campo es requerido.',
            'cantidad.numeric' => 'Este campo debe ser un numero.',
            'categoria_id.required' => 'Este campo es requerido.',

        ];
    }
}
