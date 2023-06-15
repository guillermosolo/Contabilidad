<?php

namespace App\Http\Requests\Cxc;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionProductos extends FormRequest
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
            'prod_desc_lg' => 'required|max:200|',
            'prod_desc_ct' => 'max:50',
            'prod_padre' => 'required|numeric',
            'prod_cuentacontable' => 'required|numeric',
            'prod_empresa' => 'required|numeric',
            'prod_terminal' => 'required|numeric',
            'prod_codigo'=>'unique:productos|nullable',
        ];
    }

    public function attributes()
    {
        return [
            'prod_desc_lg' => '<strong>Descripción Larga</strong>',
            'prod_desc_ct' => '<strong>Descripción corta</strong>',
            'prod_padre' => '<strong>Servicio</strong>',
            'prod_cuentacontable' => '<strong>Cuenta Contable</strong>',
            'prod_empresa' => '<strong>Empresa</strong>',
            'prod_terminal' => '<strong>Terminal</strong>',
            'prod_codigo' => '<strong> Código Producto</strong>',
        ];
    }
}
