<?php

namespace App\Http\Requests\Parametros;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionRol extends FormRequest
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
            'rol_nombre' => 'required|max:50|unique:rol,rol_nombre,' . $this->route('id')  . ',rol_id',
        ];
    }

    public function attributes()
    {
        return [
            'rol_nombre' => '<strong>Nombre</strong>',
        ];
    }
}
