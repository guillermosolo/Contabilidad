<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionRepresentante extends FormRequest
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
            'repr_nombre' => 'required|max:50|unique:representante,repr_nombre,' . $this->route('id')  . ',repr_id',
            'repr_NIT' => 'max:13'
        ];
    }

    public function attributes()
    {
        return [
            'repr_nombre' => '<strong>Nombre</strong>',
            'repr_NIT' => '<strong>NIT</strong>',
        ];
    }
}
