<?php

namespace App\Http\Requests\cyb;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionCheque extends FormRequest
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
            'che_cuentabancaria'=>'required|numeric',
            'che_cuentabancaria2'=>'nullable|numeric',
            'che_numero'=>'required|max:15|unique:cheque,che_numero,' . $this->route('id') . ',che_id',
            'che_fecha'=>'required',
            'che_monto'=>'required|numeric',
            'che_descripcion'=>'required',
            'che_beneficiario'=>'nullable',
            'che_negociable'=>'numeric|nullable',
            'che_tipo'=>'max:2',
            'che_tc'=>'numeric|nullable',
            'che_terminal'=>'numeric|nullable',
            'che_terminal2'=>'numeric|nullable',
            'empresaacreditar'=>'nullable',
            'beneficiario'=>'nullable',
            'che_numero2'=>'nullable|max:15|unique:cheque,che_numero,' . $this->route('id') . ',che_id',
        ];
    }

    public function attributes()
    {
        return [
            'che_cuentabancaria'=>'<strong>Cuenta Bancaria</strong>',
            'che_numero'=>'<strong>Numero de Referencia</strong>',
            'che_fecha'=>'<strong>Fecha</strong>',
            'che_monto'=>'<strong>Monto</strong>',
            'che_beneficiario'=>'<strong>Beneficiario</strong>',
            'che_descripcion'=>'<strong>Descripcion</strong>',
            'che_negociable'=>'<strong>Negociable</strong>',
            'che_tipo'=>'<strong>Tipo</strong>',
            'che_tc'=>'<strong>Tipo de Cambio</strong>',
            'che_correlativoInt'=>'<strong>Correlativo</strong>'
        ];
    }

}
