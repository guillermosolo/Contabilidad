<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionTipoPago extends FormRequest
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
            'tip_nombre' => 'required|max:50|unique:tipopago,tip_nombre,' . $this->route('id')  . ',tip_id',
            ];
    }

    public function attributes()
    {
        return [
            'tip_nombre' => '<strong>Nombre</strong>',
            'tip_referencia' => '<strong>Referencia</strong>',
            'tip_tabla' => '<strong>Documento de Referencia</strong>',
        ];
    }
}
