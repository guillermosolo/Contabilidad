<?php

namespace App\Http\Requests\cyb;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionDetalleAnticipo extends FormRequest
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
            'dant_anticipo'=>'required',
            'dant_tipo'=>'required',
            'dant_documento'=>'required',
            'dant_monto'=>'required'
        ];
    }

    public function attributes()
    {
        return [
            'dant_anticipo'=>'<strong>Numero de Anticipo</strong>',
            'dant_tipo'=>'<strong>Tipo</strong>',
            'dant_documento'=>'<strong>Numero Referencial</strong>',
            'dant_monto'=>'<strong>Monto</strong>'
        ];
    }
}
