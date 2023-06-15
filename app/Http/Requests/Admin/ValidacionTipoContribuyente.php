<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionTipoContribuyente extends FormRequest
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
            'tpc_nombre' => 'required|max:50|unique:tipocontribuyente,tpc_nombre,' . $this->route('id')  . ',tpc_id',
        ];
    }
    public function attributes()
    {
        return [
            'tpc_nombre' => '<strong>Nombre</strong>',
             ];
    }
}
