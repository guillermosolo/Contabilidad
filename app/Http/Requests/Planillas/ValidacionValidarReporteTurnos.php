<?php

namespace App\Http\Requests\Planillas;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionValidarReporteTurnos extends FormRequest
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
            'fecha' => 'required',
            'terminal' => 'nullable|max:50',
            'empresa' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'fecha' => '<strong>Fecha</strong>',
            'terminal' => '<strong>Terminal</strong>',
            'empresa' => '<strong>Empresa</strong>',
        ];
    }
}
