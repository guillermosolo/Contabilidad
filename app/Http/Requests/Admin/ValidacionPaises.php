<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionPaises extends FormRequest
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
            'pai_id' => 'numeric|unique:paises,pai_id,' . $this->route('id')  . ',pai_id',
            'pai_descripcion' => 'required|max:25|unique:paises,pai_descripcion,' . $this->route('id')  . ',pai_id'
        ];
    }

    public function attributes()
    {
        return [
            'pai_id' => '<strong>Código</strong>',
            'pai_descripcion' => '<strong>Descripción</strong>'
        ];
    }
}
