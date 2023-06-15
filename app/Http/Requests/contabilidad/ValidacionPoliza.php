<?php

namespace App\Http\Requests\contabilidad;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionPoliza extends FormRequest
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
            'pol_fecha' => 'required',
            'pol_descripcion' => 'required|max:250',
            'pol_empresa' => 'required|numeric',
        ];
    }


    public function attributes()
    {
        return [
            'pol_fecha' => '<strong>Fecha</strong>',
            'pol_descripcion' => '<strong>Descripción</strong>',
            'pol_empresa' => '<strong>Empresa</strong>',
        ];
    }
}
