<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionTipoPersona extends FormRequest
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
            'tpp_nombre' => 'required|max:50|unique:tipopersona,tpp_nombre,' . $this->route('id')  . ',tpp_id',
            'tpp_nickname' => 'required|max:5|unique:tipopersona,tpp_nickname,' . $this->route('id')  . ',tpp_id',
        ];
    }

    public function attributes()
    {
        return [
            'tpp_nombre' => '<strong>Nombre</strong>',
            'tpp_nickname' => '<strong>Nickname</strong>',
        ];
    }
}
