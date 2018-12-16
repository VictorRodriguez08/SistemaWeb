<?php

namespace sistemaWeb\Http\Requests;

use sistemaWeb\Http\Requests\Request;

class UsuarioFormRequest extends Request
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
            'name'=>'required|max:100',
            'apellidos'=>'required|max:100',
            'email'=>'required|string|email|max:255|unique:users,email'.$this->id,
            'password'=>'required|min:6|confirmed',
            'direccion'=>'required|max:200',
            'titulo'=>'required|max:100',
            'otros_estudios'=>'max:100',
            'fecha_nac'=>'required',
            'dui'=>'required|max:10',
            'telefonos'=>'required|max:100',
            'otros_email'=>'max:255'
        ];
    }
}
