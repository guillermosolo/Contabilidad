<?php

namespace App\Http\Requests\Parametros;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionUsuario extends FormRequest
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
            'usu_nombre' => 'required|max:15|unique:usuario,usu_nombre,' . $this->route('id')  . ',id',
            'usu_pwd' =>'required|max:256',
            'usu_activo'=>'boolean',
            'usu_empleado'=>'numeric',

        ];
    }

    public function attributes()
    {
        return [
            'usu_nombre' => '<strong>Nombre</strong>',
            'usu_pwd' => '<strong>Contraseña</strong>',
        ];
    }
}
