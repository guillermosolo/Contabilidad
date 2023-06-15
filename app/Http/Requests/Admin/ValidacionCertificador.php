<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionCertificador extends FormRequest
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
            'cer_nombre' => 'required|max:100|unique:certificador,cer_nombre,' . $this->route('id')  . ',cer_id',
            'cer_direccion' =>'max:100',
            'cer_contacto'=>'max:50'
        ];
    }

    public function attributes()
    {
        return [
            'cer_nombre' => '<strong>Nombre</strong>',
            'cer_direccion' => '<strong>Dirección</strong>',
            'cer_contacto' => '<strong>Contacto</strong>',
        ];
    }
}
