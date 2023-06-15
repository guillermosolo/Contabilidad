<?php

namespace App\Http\Requests\cyb;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionAnticipo extends FormRequest
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
            'ant_numero'=>'required|unique:anticipo,ant_numero,' . $this->route('id') . ',ant_id',
            'ant_fecha'=>'required',
            'ant_cheque'=>'numeric|required|unique:anticipo,ant_cheque,' . $this->route('id') . ',ant_id',
            'ant_proveedor'=>'required',
            'descripcion'=>'nullable',
            'terminal'=>'nullable',
            'monto'=>'nullable',
        ];
    }

    public function attributes()
    {
        return [
            'ant_numero'=>'<strong>Numero de Cuenta</strong>',
            'ant_fecha'=>'<strong>Fecha</strong>',
            'ant_cheque'=>'<strong>Cheque</strong>',
            'ant_proveedor'=>'<strong>Proveedor</strong>',
            'descripcion'=>'<strong>Descripción</strong>',
            'terminal'=>'<strong>Terminal</strong>',
            'monto'=>'<strong>Monto</strong>'
        ];
    }


}
