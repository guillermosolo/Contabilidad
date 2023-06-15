<?php

namespace App\Http\Requests\cyb;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionConciliaciones extends FormRequest
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
            'con_anio'=>'required',
            'con_mes'=>'required|numeric',
            'con_saldo'=>'required|numeric',
            'con_cuentabancaria'=>'required|numeric',
            'con_conciliado'=>'nullable'
        ];
    }

    public function attributes()
    {
        return [
            'con_anio'=>'<strong>Año</strong>',
            'con_mes'=>'<strong>Mes</strong>',
            'con_saldo'=>'<strong>Saldo</strong>',
            'con_cuentabancaria'=>'<strong>Cuenta Bancaria</strong>'
        ];
    }
}
