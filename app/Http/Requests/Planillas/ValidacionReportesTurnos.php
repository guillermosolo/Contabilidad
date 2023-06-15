<?php

namespace App\Http\Requests\Planillas;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionReportesTurnos extends FormRequest
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
            'rept_fecha' => 'required',
            'rept_nombreBuque' => 'nullable|max:50',
            'rept_turno' => 'required',
            'rept_inicio'=>'required',
            'rept_fin'=>'required',
            'rept_bodegas'=>'required|max:50',
            'rept_produccion'=>'required|numeric',
            'rept_planilla'=>'required|numeric',
            'rept_empresa'=>'required|numeric',
            'rept_terminal'=>'required|numeric',
        ];
    }


    public function attributes()
    {
        return [

            'rept_fecha' => '<strong>Fecha</strong>',
            'rept_nombreBuque' => '<strong>Nombre Buque</strong>',
            'rept_turno' => '<strong>Turno</strong>',
            'rept_bodegas'=>'<strong>Bodegas</strong>',
            'rept_inicio' => '<strong>Inicio</strong>',
            'rept_fin' => '<strong>Fin</strong>',
            'rept_produccion' => '<strong>Produccion</strong>',
            'rept_planilla' => '<strong>Planilla</strong>',
            'rept_terminal' => '<strong>Terminal</strong>',
            'rept_empresa' => '<strong>Empresa</strong>',
        ];
    }
}
