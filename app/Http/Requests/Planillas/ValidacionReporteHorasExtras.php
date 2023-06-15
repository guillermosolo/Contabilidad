<?php

namespace App\Http\Requests\Planillas;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionReporteHorasExtras extends FormRequest
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
            'ree_empleado' => 'required|numeric',
            'ree_fecha' => 'required|',
            'ree_horas' => 'required|numeric',
            'ree_tipo' => 'required|max:1',
        ];
    }

    public function attributes()
    {
        return [
            'ree_empleado' => '<strong>Empleado</strong>',
            'ree_fecha' => '<strong>Fecha</strong>',
            'ree_horas' => '<strong>Horas</strong>',
            'ree_tipo' => '<strong>Tipo</strong>',
        ];
    }
}
