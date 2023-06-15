<?php

namespace App\Http\Requests\Parametros;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionTerminal extends FormRequest
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
            'ter_nombre' => 'required|max:25|unique:terminal,ter_nombre,' . $this->route('id')  . ',ter_id',
            'ter_abreviatura' => 'required|max:2|unique:terminal,ter_abreviatura,' . $this->route('id')  . ',ter_id',
            'ter_municipio' => 'required|max:8',
            'ter_autoriza' => 'required|max:50'
        ];
    }

    public function attributes()
    {
        return [
            'ter_nombre' => '<strong>Nombre</strong>',
            'ter_abreviatura' => '<strong>Abreviatura</strong>',
            'ter_municipio' => '<strong>Municipio</strong>',
            'ter_autoriza' => '<strong>Nombre de quien autorizó</strong>'
        ];
    }
}
