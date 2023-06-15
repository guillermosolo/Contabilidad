<?php

namespace App\Http\Requests\Planillas;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionTipoDesc extends FormRequest
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
            'tipd_descripcion' => 'nullable|max:50',
            'tipd_forma' => 'required',
            'tipd_clase' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'tipd_descripcion' => '<strong>Descripcion</strong>',
            'tipd_forma' => '<strong>Forma</strong>',
            'tipd_clase' => '<strong>Clase</strong>',
        ];
    }
}
