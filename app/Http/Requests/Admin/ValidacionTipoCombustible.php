<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionTipoCombustible extends FormRequest
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
            'tco_nombre' => 'required|max:125|unique:tipocombustible,tco_nombre,' . $this->route('id')  . ',tco_id',
            'tco_idp' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'tco_nombre' => '<strong>Nombre</strong>',
            'tco_idp' => '<strong>IDP</strong>',
        ];
    }
}
