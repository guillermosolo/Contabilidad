<?php

namespace App\Http\Requests\cyb;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionLiquidacionCC extends FormRequest
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
            'lcc_descripcion'=>'required',
            'lcc_fecha'=>'required',
            'lcc_cajachica'=>'required|numeric',
            'lcc_pendiente'=>'required|numeric'
        ];
    }

    public function attributes()
    {
        return [
            'lcc_descripcion' => '<strong>Descripción</strong>',
            'lcc_fecha' => '<strong>Fecha</strong>',
            'lcc_cajachica' => '<strong>Caja Chica</strong>',
            'lcc_pendiente'=> '<strong>Pendiente</strong>',
        ];
    }
}
