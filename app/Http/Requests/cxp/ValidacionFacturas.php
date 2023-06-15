<?php

namespace App\Http\Requests\cxp;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ValidacionFacturas extends FormRequest
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
            'com_descripcion'=>'required|min:25',
            'com_numDoc'=>['required',Rule::unique('compras')->ignore($this->route('id'))->where('com_serie',$this->com_serie)->where('com_persona',$this->com_persona)],
        ];
    }

    public function attributes()
    {
        return [
            'com_descripcion'=>'<strong>Descripción</strong>',
            'com_numDoc'=>'<strong>Número y Serie de Factura</strong> del proveedor <strong>' . $this->nomProveedor . '</strong>'
        ];
    }
}
