<?php

namespace App\Http\Requests\Planillas;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionPlanillaEventual extends FormRequest
{
    /**
     * @var mixed
     */

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
            'pla_empresa' => 'required',
            'pla_terminal' => 'required',
            'pla_fecha' => 'required',
            'pla_descripcion' => 'required|max:100',
            'pla_tipo' => 'required|max:1',
            'pla_liquidacion'=>'nullable|max:1'
        ];
    }

    public function attributes()
    {
        return [
            'pla_empresa' => '<strong>Empresa</strong>',
            'pla_terminal' => '<strong>Terminal</strong>',
            'pla_fecha' => '<strong>Fecha</strong>',
            'pla_descripcion' => '<strong>Descripcion</strong>',
            'pla_tipo' => '<strong>Tipo</strong>',
        ];
    }
}
