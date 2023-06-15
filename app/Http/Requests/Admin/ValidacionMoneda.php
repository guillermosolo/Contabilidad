<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionMoneda extends FormRequest
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
            'mon_nombre' => 'required|max:25|unique:moneda,mon_nombre,' . $this->route('id')  . ',mon_id',
            'mon_abreviatura' => 'required|max:3|unique:moneda,mon_abreviatura,' . $this->route('id')  . ',mon_id',
            'mon_simbolo' => 'required|max:1',
        ];
    }

    public function attributes()
    {
        return [
            'mon_nombre' => '<strong>Nombre</strong>',
            'mon_abreviatura' => '<strong>Abreviatura</strong>',
            'mon_simbolo' => '<strong>Símbolo</strong>',
        ];
    }
}
