<?php

namespace App\Http\Requests\cyb;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionTransacciones extends FormRequest
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
            'trab_cuentabancaria'=>'required|numeric',
            'trab_fecha'=>'required',
            'trab_documento'=>'numeric|required|unique:transaccionbancaria,trab_documento,' . $this->route('id') . ',trab_id',
            'trab_tipo'=>'max:2',
            'trab_descripcion'=>'required',
            'trab_monto'=>'numeric|required',
            'trab_correlativoInt'=>'numeric',
            'terminal'=>'numeric',
            'trab_conciliado'=>'numeric',
            'empresa'=>'numeric|nullable',
        ];
    }

    public function attributes()
    {
        return [
            'trab_cuentabancaria'=>'<strong>Cuenta Bancaria</strong>',
            'trab_fecha'=>'<strong>Fecha</strong>',
            'trab_documento'=>'<strong>Documento de Referencia</strong>',
            'trab_tipo'=>'<strong>Tipo</strong>',
            'trab_descripcion'=>'<strong>Descripción</strong>',
            'trab_monto'=>'<strong>Monto</strong>',
            'trab_correlativoInt'=>'<strong>Correlativo</strong>',
            'terminal'=>'<strong>Terminal</strong>',
            'trab_conciliado'=>'<strong>Conciliado</strong>'
        ];
    }
}
