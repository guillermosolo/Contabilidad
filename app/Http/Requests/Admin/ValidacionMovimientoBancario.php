<?php

namespace App\Http\Requests\Admin;

use App\Rules\Admin\ValidarCampoMovBan;
use Illuminate\Foundation\Http\FormRequest;

class ValidacionMovimientoBancario extends FormRequest
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
            'movb_descripcion' => ['required','max:25',new ValidarCampoMovBan]
        ];
    }

    public function attributes()
    {
        return [
            'movb_descripcion' => '<strong>Descripcion</strong>',
        ];
    }
}
