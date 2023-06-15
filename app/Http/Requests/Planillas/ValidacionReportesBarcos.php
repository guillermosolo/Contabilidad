<?php

namespace App\Http\Requests\Planillas;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionReportesBarcos extends FormRequest
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
            'retb_fecha' => 'required',
            'retb_turnos' => 'required|numeric',
            'retb_extras'=>'nullable|numeric',
            'retb_ordinales'=>'nullable|numeric',
            'retb_planilla'=>'required|numeric',
            'retb_empleado'=>'required|numeric',
            'retb_empresa'=>'required|numeric',
            'retb_terminal'=>'required|numeric',
        ];
    }


    public function attributes()
    {
        return [

            'retb_fecha' => '<strong>Fecha</strong>',
            'retb_turnos' => '<strong>Turnos</strong>',
            'retb_extras'=>'<strong>Extras</strong>',
            'retb_ordinales' => '<strong>Ordinales</strong>',
            'retb_planilla' => '<strong>Planilla</strong>',
            'retb_empleado' => '<strong>Empleado</strong>',
            'retb_empresa' => '<strong>Empresa</strong>',
            'retb_terminal' => '<strong>Terminal</strong>',
        ];
    }
}
