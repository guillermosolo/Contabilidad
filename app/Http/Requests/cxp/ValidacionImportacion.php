<?php

namespace App\Http\Requests\cxp;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionImportacion extends FormRequest
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
        $rules['poim_descripcion']='required|min:25';
        $rules['poim_dua']='required|unique:polizasimportacion,poim_dua,' . $this->route('id')  . ',poim_id';
        $rules['poim_orden']='required|unique:polizasimportacion,poim_orden,' . $this->route('id')  . ',poim_id';
        if($this->poim_moneda!=1){
            $rules['poim_tipoCambio']='gt:1';
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'poim_descripcion'=>'<strong>Descripción</strong>',
            'poim_orden'=>'<strong>Orden</strong>',
            'poim_dua'=>'<strong>DUA</strong>',
            'poim_tipoCambio'=>'<strong>Tipo de Cambio</strong>'
        ];
    }
}
