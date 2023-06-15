<?php

namespace App\Http\Requests\cyb;
Use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionCuentasBancarias extends FormRequest
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
            'ctab_numero'=>'required|max:25|unique:cuentabancaria,ctab_numero,' . $this->route('id') . ',ctab_id',
            'ctab_tipo'=>'required|numeric',
            'ctab_banco'=>'required|numeric',
            'ctab_moneda'=>'required|numeric',
            'ctab_cuentacontable'=>'required|numeric',
            'ctab_empresa'=>'required|numeric',
            'ctab_contacto'=>'nullable|max:50',
            'ctab_telefono'=>'nullable|max:15',

        ];
    }

    public function attributes()
    {
        return [
            'ctab_numero' => '<strong>Cuenta Bancaria</strong>',
            'ctab_tipo' => '<strong>Tipo</strong>',
            'ctab_banco' => '<strong>Banco</strong>',
            'ctab_moneda' => '<strong>Moneda</strong>',
            'ctab_cuentacontable' => '<strong>Cuenta Contable</strong>',
            'ctab_empresa' => '<strong>Empresa</strong>',
            'ctab_contacto' => '<strong>Contacto</strong>',
            'ctab_telefono' => '<strong>Telefono</strong>',

        ];
    }
}
