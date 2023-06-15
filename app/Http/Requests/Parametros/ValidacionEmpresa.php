<?php

namespace App\Http\Requests\Parametros;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionEmpresa extends FormRequest
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
            'emp_nombre' => 'required|max:100|unique:empresa,emp_nombre,' . $this->route('id')  . ',emp_id',
            'emp_nomComercial' => 'required|max:50',
            'emp_siglas' => 'max:15|unique:empresa,emp_siglas,' . $this->route('id') . ',emp_id',
            'emp_NIT' => 'required|max:13|unique:empresa,emp_NIT,' . $this->route('id') . ',emp_id',
            'emp_municipio' => 'required|max:8',
            'emp_actividad' => 'required|max:9',
            'emp_descripcion' => 'required|max:200',
            'emp_regimen'=>'required|numeric',
            'emp_fel'=>'required|numeric',
            'emp_inicio'=>'required',
            'emp_activa'=>'boolean',
            'emp_logo'=>'nullable|image',
            'emp_CUI'=>'max:13',
            'emp_nacionalidad'=>'required|numeric',
            'emp_numeroIGSS'=>'max:15',
            'emp_colonia'=>'max:50',
            'emp_zona'=>'nullable|numeric',
            'emp_calle'=>'max:25',
            'emp_avenida'=>'max:25',
            'emp_nomenclatura'=>'max:25',
            'emp_sitioWeb'=>'max:50',
            'emp_email'=>'nullable|email|max:50',
            'emp_sindicato'=>'boolean',
            'emp_telefono'=>'max:15',
            'emp_direccion'=>'max:100'
        ];
    }

    public function attributes()
    {
        return [
            'emp_nombre' => '<strong>Nombre</strong>',
            'emp_nomComercial' => '<strong>Nombre Comercial</strong>',
            'emp_siglas' => '<strong>Siglas</strong>',
            'emp_NIT' => '<strong>NIT</strong>',
            'emp_municipio' => '<strong>Municipio</strong>',
            'emp_actividad' => '<strong>Actividad Económica</strong>',
            'emp_descripcion' => '<strong>Descripción de Actividad </strong>',
            'emp_regimen'=>'<strong>Régimen Fiscal</strong>',
            'emp_fel' => '<strong>Certificador FEL</strong>',
            'emp_inicio' => '<strong>Inicio de Operaciones</strong>',
            'emp_activa' => '<strong>Activa</strong>',
            'emp_CUI' => '<strong>CUI</strong>',
            'emp_nacionalidad' => '<strong>Nacionalidad</strong>',
            'emp_numeroIGSS' => '<strong>Número IGSS</strong>',
            'emp_colonia' => '<strong>Colonia</strong>',
            'emp_zona'=> '<strong>Zona</strong>',
            'emp_calle' => '<strong>Calle</strong>',
            'emp_avenida' => '<strong>Avenida</strong>',
            'emp_nomenclatura' => '<strong>Nomenclatura</strong>',
            'emp_sitioWeb' => '<strong>Sitio Web</strong>',
            'emp_email' => '<strong>Correo Electrónico</strong>',
            'emp_sindicato' => '<strong>Posee Sindicato</strong>',
            'emp_telefono' => '<strong>Teléfono</strong>',
            'emp_direccion' => '<strong>Dirección</strong>',
        ];
    }
}
