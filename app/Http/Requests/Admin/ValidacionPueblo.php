<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;


class ValidacionPueblo extends FormRequest
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
            'pue_id' => 'numeric|unique:pueblo,pue_id,' . $this->route('id')  . ',pue_id',
            'pue_descripcion' => 'required|max:25|unique:pueblo,pue_descripcion,' . $this->route('id')  . ',pue_id'
        ];
    }

    public function attributes()
    {
        return [
            'pue_id' => '<strong>Código</strong>',
            'pue_descripcion' => '<strong>Descripción</strong>'
        ];
    }
}
