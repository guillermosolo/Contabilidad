<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionTipoCompra extends FormRequest
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
            'tipc_descripcion' => 'required|max:50|unique:tipocompra,tipc_descripcion,' . $this->route('id')  . ',tipc_id',
        ];
    }

    public function attributes()
    {
        return [
            'tipc_descripcion' => '<strong>Descripción</strong>'
        ];
    }
}
