<?php

namespace App\Http\Requests\Planillas;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionDescBon extends FormRequest
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
            'desc_monto' => 'required|numeric',
            'desc_inicio' => 'required',
            'desc_fin' => 'nullable',
            'desc_general'=>'nullable|boolean',
            'desc_cuentaContable'=>'required|numeric',
            'desc_tipo'=>'required|numeric',
        ];
    }


    public function attributes()
    {
        return [
            'desc_monto' => '<strong>Monto</strong>',
            'desc_inicio' => '<strong>Inicio</strong>',
            'desc_fin' => '<strong>Fin</strong>',
            'desc_general' => '<strong>General</strong>',
            'desc_cuentaContable' => '<strong>Cuenta Contable</strong>',
        ];
    }
}
