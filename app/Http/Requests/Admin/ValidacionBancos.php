<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionBancos extends FormRequest
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
                'ban_nombre' => 'required|max:50|unique:bancos,ban_nombre,' . $this->route('id')  . ',ban_id',
                'ban_siglas' => 'required|max:15|unique:bancos,ban_siglas,' . $this->route('id')  . ',ban_id',
            ];
        }

        public function attributes()
        {
            return [
                'ban_nombre' => '<strong>Nombre</strong>',
                'ban_siglas' => '<strong>Siglas</strong>',
               ];
        }

}
