<?php

namespace App\Http\Requests\cxp;

use App\Rules\validarDPI;
use App\Rules\validarNIT;
use Illuminate\Foundation\Http\FormRequest;

class ValidacionProveedores extends FormRequest
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
            'per_nit'=>['required',new validarNIT],
            'per_cui'=>[new validarDPI],
        ];
    }

    public function attributes()
    {
        return [
            'per_nombre'=>'<strong>Nombre</strong>',
            'per_nit'=>'<strong>NIT</strong>',
            'per_cui'=>'<strong>CUI</strong>',
        ];
    }
}
