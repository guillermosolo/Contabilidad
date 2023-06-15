<?php

namespace App\Http\Requests\Planillas;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionControlSeguridad extends FormRequest
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
            'cons_empleado' => 'required|numeric',
            'cons_fecha' => 'required',
            'cons_ingreso' => 'nullable',
            'cons_salida'=>'nullable',
            'cons_empresa'=>'nullable',
            'cons_terminal'=>'nullable',

        ];
    }


    public function attributes()
    {
        return [
            'cons_empleado' => '<strong>Empleado</strong>',
            'cons_fecha' => '<strong>Fecha</strong>',
            'cons_ingreso' => '<strong>Ingreso</strong>',
            'cons_salida' => '<strong>Salida</strong>',
        ];
    }
}
