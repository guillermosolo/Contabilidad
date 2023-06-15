<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionDiscapacidad extends FormRequest
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
            'dis_id' => 'numeric|unique:discapacidad,dis_id,' . $this->route('id')  . ',dis_id',
            'dis_descripcion' => 'required|max:15|unique:discapacidad,dis_descripcion,' . $this->route('id')  . ',dis_id'
        ];
    }

    public function attributes()
    {
        return [
            'dis_id' => '<strong>Código</strong>',
            'dis_descripcion' => '<strong>Descripción</strong>'
        ];
    }
}
