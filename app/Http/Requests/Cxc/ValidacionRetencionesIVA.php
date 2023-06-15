<?php

namespace App\Http\Requests\Cxc;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionRetencionesIVA extends FormRequest
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
            'docv_fecha' => 'required',
            'docv_fomularioSAT' => 'max:10',
            'docv_numero' => 'required|max:25',
            'docv_persona' => 'required|numeric',
            'docv_monto' => 'required|numeric',
            'docv_empresa' => 'required|numeric',
            'docv_terminal' => 'required|numeric',
            'docv_tipo' => 'max:1',
        ];
    }

    public function attributes()
    {
        return [
            'docv_fecha' => '<strong>Fecha</strong>',
            'docv_formularioSAT' => '<strong>Formulario SAT</strong>',
            'docv_numero' => '<strong>Número</strong>',
            'docv_persona' => '<strong>Cliente</strong>',
            'docv_monto' => '<strong>Monto</strong>',
            'docv_empresa' => '<strong>Empresa</strong>',
            'docv_terminal' => '<strong>Terminal</strong>',
            'docv_tipo' =>  '<strong>Tipo</strong>'
        ];
    }
}



