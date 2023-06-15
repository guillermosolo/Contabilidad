<?php

namespace App\Http\Requests\cyb;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionExcelConciliacion extends FormRequest
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
            'excel'  => 'required|mimes:xls,xlsx'
        ];
    }

    public function attributes()
    {
        return [
            'excel' => '<strong>Excel</strong>',
        ];
    }
}
