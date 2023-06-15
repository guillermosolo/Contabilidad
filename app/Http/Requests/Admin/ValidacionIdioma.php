<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionIdioma extends FormRequest
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
            'idi_id' => 'numeric|unique:idiomas,idi_id,' . $this->route('id')  . ',idi_id',
            'idi_descripcion' => 'required|max:50|unique:idiomas,idi_descripcion,' . $this->route('id')  . ',idi_id'
        ];
    }

    public function attributes()
    {
        return [
            'idi_id' => '<strong>Código</strong>',
            'idi_descripcion' => '<strong>Descripción</strong>'
        ];
    }
}
