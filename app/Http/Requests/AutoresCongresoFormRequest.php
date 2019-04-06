<?php

namespace sistemaWeb\Http\Requests;

use sistemaWeb\Http\Requests\Request;

class AutoresCongresoFormRequest extends Request
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
            "user_id"=>"required",
            "congreso_id"=>"required",
            "carrera"=>"required",
            "tema"=>"required",
            "url_archivo"=>"required",
            "dia"=>"required",
        ];
    }
}
