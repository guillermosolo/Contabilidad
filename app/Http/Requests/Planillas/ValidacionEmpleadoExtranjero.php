<?php

namespace App\Http\Requests\Planillas;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionEmpleadoExtranjero extends FormRequest
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
            'trex_ocupacion' => 'required|max:4',
            'trex_pais' => 'required',
            'trex_motivo' => 'required|max:50',
            'more_ext' => 'nullable',
        ];
    }

    public function attributes()
    {
        return [
            'trex_ocupacion' => '<strong>Ocupacion</strong>',
            'trex_pais' => '<strong>Pais</strong>',
            'trex_motivo' => '<strong>Motivo</strong>',
        ];
    }
}
