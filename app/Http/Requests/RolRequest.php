<?php

namespace sistemaWeb\Http\Requests;

use sistemaWeb\Http\Requests\Request;

class RolRequest extends Request
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
            'rol'    => 'required|regex:/^[a-zA-ZáÁéÉíÍóÓúÚñÑüÜ ]+$/',
        ];
    }
}
