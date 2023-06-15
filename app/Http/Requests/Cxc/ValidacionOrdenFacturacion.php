<?php

namespace App\Http\Requests\Cxc;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionOrdenFacturacion extends FormRequest
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
            'ordf_eta' => '',
            'ordf_buque' => 'max:100',
            'ordf_viaje' => 'max:20',
            'ordf_descripcion' => 'max:100',
            'ordf_contenedores' => 'max:200',
            'ordf_cliente'=>'required|numeric',
            'ordf_moneda'=>'required|numeric',
            'ordf_factura'=>'numeric',
            'ordf_empresa'=>'required|numeric',
            'ordf_terminal'=>'required|numeric',
            'ordf_total'=>'numeric',



        ];
    }

    public function attributes()
    {
        return [
            'ordf_eta' => '<strong>ETA</strong>',
            'ordf_buque' => '<strong>Buque</strong>',
            'ordf_viaje' => '<strong>Viaje</strong>',
            'ordf_cliente' => '<strong>Cliente</strong>',
            'ordf_descripcion' => '<strong>Descripción</strong>',
            'ordf_moneda' => '<strong>Moneda</strong>',
            'ordf_factura' => '<strong>Factura</strong>',
            'ordf_empresa' => '<strong>Empresa</strong>',
            'ordf_terminal' => '<strong>Terminal</strong>',


        ];
    }
}
