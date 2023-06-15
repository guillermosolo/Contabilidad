<?php

namespace App\Http\Requests\Planillas;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionPrestacionLaboral extends FormRequest
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

    public function rules()
    {
        return [
            'empresa' => 'required',
            'terminal' => 'required',
            'fecha' => 'required',
            'empleado' => 'required|numeric',
            'vacaciones' => 'required|numeric',
            'motivo' => 'required|numeric',
            'descuentos' => 'nullable|numeric',

        ];
    }

    public function attributes()
    {
        return [
            'empresa' => '<strong>Empresa</strong>',
            'terminal' => '<strong>Terminal</strong>',
            'fecha' => '<strong>Fecha</strong>',
            'empleado' => '<strong>Empleado</strong>',
            'vacaciones' => '<strong>Vacaciones</strong>',
            'descuentos' => '<strong>Vacaciones</strong>',

        ];
    }
}
