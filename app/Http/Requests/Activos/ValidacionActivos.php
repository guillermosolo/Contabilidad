<?php

namespace App\Http\Requests\Activos;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionActivos extends FormRequest
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
            'act_descripcion' => 'required|max:100',
            'act_categoria' => 'required',
            'act_correlativo' => 'required|max:50',
            'act_serie' => 'required|max:50',
            'act_fechaAlta' => 'required',
            'act_valor' => 'required|numeric',
            'act_status'=>'required',
            'act_cuentaDep'=>'required',
            'act_cuentaDepAcum'=>'required',
            'act_inicial'=>'numeric|lt:act_valor',
            'act_porcentaje'=>'required|numeric',
            'act_empresa'=>'required',
            'act_terminal'=>'required',
            'act_propio'=>'boolean',
        ];
    }

    public function attributes()
    {
        return [
            'act_descripcion' => '<strong>Descripción</strong>',
            'act_categoria' => '<strong>Categoría</strong>',
            'act_correlativo' => '<strong>Correlativo</strong>',
            'act_serie'=>'<strong>Serie</strong',
            'act_fechaAlta'=>'<strong>Fecha de Alta</strong',
            'act_valor'=>'<strong>Valor</strong',
            'act_inicial'=>'<strong>Depreciación Inicial</strong>',
            'act_status' => '<strong>Status</strong>',
            'act_empresa' => '<strong>Empresa</strong>',
            'act_terminal' => '<strong>Terminal</strong>',
            'act_propio' => '<strong> Propio </strong>',
        ];
    }

}
