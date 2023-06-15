<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionFirmante extends FormRequest
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
            'fir_nombre' => 'required|max:100|unique:firmante,fir_nombre,' . $this->route('id')  . ',fir_id',
        ];
    }

    public function attributes()
    {
        return [
            'fir_nombre' => '<strong>Nombre</strong>',
             ];
    }
}
