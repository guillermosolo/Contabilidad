<?php

namespace App\Http\Requests\Planillas;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionDescuentoEventual extends FormRequest
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
            'dee_monto' => 'required|numeric',
            'dee_saldo' => 'required|numeric',
            'dee_fecha' => 'required',
            'dee_empleado' => 'required|numeric',
            'dee_observaciones' =>'required|max:100'
        ];
    }

    public function attributes()
    {
        return [
            'dee_monto' => '<strong>Monto</strong>',
            'dee_saldo' => '<strong>Total</strong>',
            'dee_fecha' => '<strong>Fecha</strong>',
            'dee_empleado' => '<strong>Empleado</strong>',
            'dee_observaciones' => '<strong>Observaciones</strong>'
        ];
    }
}
