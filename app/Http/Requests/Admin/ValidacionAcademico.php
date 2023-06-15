<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionAcademico extends FormRequest
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
            'aca_id' => 'numeric|unique:academico,aca_id,' . $this->route('id')  . ',aca_id',
            'aca_descripcion' => 'required|max:25|unique:academico,aca_descripcion,' . $this->route('id')  . ',aca_id'
        ];
    }

    public function attributes()
    {
        return [
            'aca_id' => '<strong>Código</strong>',
            'aca_descripcion' => '<strong>Descripción</strong>'
        ];
    }
}
