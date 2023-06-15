<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionRegimen extends FormRequest
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
            'reg_descripcion' => 'required|max:100|unique:regimen,reg_descripcion,' . $this->route('id')  . ',reg_id',
            'reg_desc_ct' => 'required|max:15|unique:regimen,reg_desc_ct,' . $this->route('id')  . ',reg_id',
        ];
    }

    public function attributes()
    {
        return [
            'reg_descripcion' => '<strong>Descripción Larga</strong>',
            'reg_desc_ct' => '<strong>Descripción Corta</strong>',
        ];
    }
}
