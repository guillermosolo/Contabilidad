<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionCategoria extends FormRequest
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
            'cat_descripcion' => 'required|max:100|unique:categoria,cat_descripcion,' . $this->route('id')  . ',cat_id',
            'cat_porcentaje' =>'numeric',
            'cat_tipo'=>'required|max:1'
        ];
    }

    public function attributes()
    {
        return [
            'cat_descripcion' => '<strong>Descripción</strong>',
            'cat_porcentaje' => '<strong>Porcentaje</strong>',
            'cat_tipo' => '<strong>Tipo</strong>',
        ];
    }
}
