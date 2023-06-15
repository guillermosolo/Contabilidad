<?php

namespace App\Http\Requests\contabilidad;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionDetPoliza extends FormRequest
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
            'dpol_ctaContable' => 'required',
            'dpol_monto' => 'required|numeric',
            'dpol_posicion' => 'required|max:1',
        ];
    }


    public function attributes()
    {
        return [
            'dpol_ctaContable' => '<strong>Cuenta Contable</strong>',
            'dpol_monto' => '<strong>Monto</strong>',
            'dpol_posicion' => '<strong>Tipo</strong>',
        ];
    }
}
