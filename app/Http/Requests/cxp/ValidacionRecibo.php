<?php

namespace App\Http\Requests\cxp;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionRecibo extends FormRequest
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
        $rules = $this->rules;
        $rules['rec_descripcion']='required|min:30';
        if($this->rec_moneda!=1){
            $rules['rec_tipoCambio']='gt:1';
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'rec_descripcion'=>'<strong>Descripción</strong>',
            'rec_tipoCambio'=>'<strong>Tipo de Cambio</strong>'
        ];
    }
}
