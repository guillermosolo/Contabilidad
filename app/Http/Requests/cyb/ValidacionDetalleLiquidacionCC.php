<?php

namespace App\Http\Requests\cyb;

use App\Rules\CajaBancos\ValidarDocumento;
use Illuminate\Foundation\Http\FormRequest;

class ValidacionDetalleLiquidacionCC extends FormRequest
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
            'dlcc_idcc'=>'required',
            'dlcc_fecha'=>'required',
            'dlcc_proveedor'=>'required',
            'dlcc_tipodoc'=>'required',
            'dlcc_seriedoc'=>'nullable',
            'dlcc_numerodoc'=>[new ValidarDocumento],
            'dlcc_descripcion'=>'required',
            'dlcc_terminal'=>'required',
            'dlcc_tipogasto'=>'required',
            'dlcc_monto'=>'required',
            'dlcc_galones'=>'nullable',
            'dlcc_tipoCombustible'=>'nullable',
            'dlcc_empresa'=>'nullable',
        ];

    }

    public function attributes()
    {
        return [
            'dlcc_idcc'=> '<strong>ID</strong>',
            'dlcc_fecha'=>'<strong>Fecha</strong>',
            'dlcc_proveedor'=>'<strong>Proveedor</strong>',
            'dlcc_tipodoc'=>'<strong>Tipo</strong>',
            'dlcc_seriedoc'=>'<strong>Numero de Serie</strong>',
            'dlcc_numerodoc'=>'<strong>Documento Referencial</strong>',
            'dlcc_descripcion'=>'<strong>Descripción</strong>',
            'dlcc_terminal'=>'<strong>Terminal</strong>',
            'dlcc_tipogasto'=>'<strong>Tipo de Gasto</strong>',
            'dlcc_monto'=>'<strong>Monto</strong>',
            'dlcc_galones'=>'<strong>Galones</strong>',
            'dlcc_tipoCombustible'=>'<strong>Tipo de Combustible</strong>',
            'dlcc_empresa'=>'<strong>Empresa</strong>',
        ];
    }
}
