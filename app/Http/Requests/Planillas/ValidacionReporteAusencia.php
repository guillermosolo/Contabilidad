<?php

namespace App\Http\Requests\Planillas;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionReporteAusencia extends FormRequest
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
            'empresa' => 'required',
            'terminal' => 'required',
            'fecha' => 'required',
            'empleado' => 'required|numeric',
            'observaciones' =>'required|max:100'
        ];
    }

    public function attributes()
    {
        return [
            'empresa' => '<strong>Empresa</strong>',
            'terminal' => '<strong>Terminal</strong>',
            'fecha' => '<strong>Fecha</strong>',
            'empleado' => '<strong>Empleado</strong>',
            'observaciones' => '<strong>Observaciones</strong>'
        ];
    }
}
