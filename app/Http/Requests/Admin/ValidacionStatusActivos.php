<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionStatusActivos extends FormRequest
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
            'sta_descripcion' => 'required|max:50|unique:statusactivos,sta_descripcion,' . $this->route('id')  . ',sta_id',
        ];
    }

    public function attributes()
    {
        return [
            'sta_descripcion' => '<strong>Descripción</strong>',
            'sta_baja' => '<strong>Status Baja</strong>',
        ];
}
}
