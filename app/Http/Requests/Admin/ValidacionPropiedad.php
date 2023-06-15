<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionPropiedad extends FormRequest
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
            'prop_nombre' => 'required|max:50|unique:propiedad,prop_nombre,' . $this->route('id')  . ',prop_id',
        ];
    }

    public function attributes()
    {
        return [
            'prop_nombre' => '<strong>Nombre</strong>',
             ];
    }
}
