<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=> ['required', 'string', 'max:255'],
            'email' => ['required','string','email','max:255','regex:/^[a-zA-Z0-9.]+@(ues+\.edu\.sv|gmail\.com|yahoo\.com)$/u'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'rol_id' => ['required','integer'],
            'monto' => ['nullable','numeric',],
        ];
    }
    public function messages(){
        return [
            'email.required' => 'Este campo es requerido.',
            'email.string' => 'Este campo solo acepta letras.',
            'email.email' => 'Utilice el formato de email, ej: ac13002@gmail.com',
            'email.max' => 'Este campo no puede tener mas de 255 caracteres.',
            //'email.unique' => 'Este campo no debe de estar repetido. Revise si ya existe un usuario con este email.',
            'email.regex' => 'Este correo no es valido, Ingrese el correo institucional o personal en Gmail o Yahoo.',
            'name.required' => 'Este campo es requerido.',
            'name.string' => 'Este campo acepta letras y numeros.',            
            'name.max' => 'Este campo solo acepta hasta 255 caracteres.',
            
            'password.required' => 'Este campo es requerido.',
            'password.string' => 'Este campo solo acepta letras.',
            'password.min' => 'Este campo no puede tener menos de 8 caracteres',

            'rol_id.required' => 'Este campo es requerido.',
            'rol_id.integer' => 'Este campo es requerido',

            'monto.numeric' => 'Este campo debe ser numerico, por favor intente de nuevo',

        ];
    }
}
