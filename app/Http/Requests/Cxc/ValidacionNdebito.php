<?php

namespace App\Http\Requests\Cxc;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionNdebito extends FormRequest
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
            'ven_fecha' => 'required',
            'ven_persona' => 'required|numeric',
            'ven_tipo' => 'max:1',
            'ven_moneda' => 'required|numeric',
            'ven_descripcion'=>'required|max:200',
            'ven_total'=>'required|numeric',
            'ven_iiud'=>'max:100',
            'ven_numDoc'=>'max:100',
            'ven_serie'=>'max:100',
            'ven_fechaCert'=>'max:100',
            'ven_empresa'=>'required|numeric',
            'ven_terminal'=>'required|numeric',

        ];
    }


    public function attributes()
    {
        return [
            'ven_fecha' => '<strong>Fecha</strong>',
            'ven_persona' => '<strong>Cliente</strong>',
            'ven_tipo' => '<strong>Tipo de Documento</strong>',
            'ven_moneda' => '<strong>Moneda</strong>',
            'ven_descripcion' => '<strong>Descripción</strong>',
            'ven_total' => '<strong>Total</strong>',
            'ven_iiud' => '<strong>Código de autorización documento electrónico</strong>',
            'ven_numDoc' => '<strong>No. de Documento</strong>',
            'ven_serie' => '<strong>Serie</strong>',
            'ven_fechaCert' => '<strong>Fecha de Certificación Electrónica</strong>',
            'ven_empresa'=>'<strong>Empresa</strong>',
            'ven_terminal'=>'<strong>Terminal</strong>',


        ];
    }
}
