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
        if ($this->method()=='PATCH')
        {
            $url_archivo='';
        }
        else
        {
            $url_archivo="required";
        }

        return [
            "usuario_id"=>"required",
            "congreso_id"=>"required",
            "carrera"=>"required",
            "tema"=>"required",
            "dia"=>"required",
            'url_archivo'=>$url_archivo
        ];
    }
}
