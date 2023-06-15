<?php

namespace App\Http\Requests\cyb;
Use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ValidacionCajaChica extends FormRequest
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
            'cch_nombre'=>'required|max:50|unique:cajachica,cch_nombre,' . $this->route('id') . ',cch_id',
            'cch_responsable'=>'required|numeric',
            'cch_cuentacontable'=>'required|numeric',
            'cch_empresa'=>'required|numeric',
            'cch_monto'=>'required|numeric'
        ];
    }

    public function attributes()
    {
        return [
            'cch_nombre'=>'<strong>Nombre de la Caja</strong>',
            'cch_responsable'=>'<strong>Responsable</strong>',
            'cch_cuentacontable'=>'<strong>Cuenta Contable</strong>',
            'cch_empresa'=>'<strong>Nombre de la Empresa</strong>',
            'cch_monto'=>'<strong>Monto</strong>',

        ];
    }
}
