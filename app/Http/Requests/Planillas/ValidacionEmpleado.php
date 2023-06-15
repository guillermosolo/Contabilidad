<?php

namespace App\Http\Requests\Planillas;

use App\Rules\Empleados\ValidarDPIEmpleado;
use App\Rules\Empleados\ValidarNitEmpleado;
use App\Rules\validarDPI;
use App\Rules\validarNIT;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ValidacionEmpleado extends FormRequest
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
            'empl_extranjero' => 'nullable',
            'empl_idiomas' => 'nullable',
            'empl_codigo' => 'nullable',
            'empl_empresa' => 'required|numeric',
            'empl_terminal' => 'required|numeric',
            'empl_tipoDocID' => 'required|numeric',
            "empl_docID" => ['required',new validarDPI],
            "empl_nom1" => "required|max:15",
            "empl_nom2" => 'nullable|max:15',
            "empl_ape1" => "required|max:15",
            "empl_ape2" => "nullable|max:15",
            "empl_sexo" => "required|numeric",
            "empl_nacionalidad" => "required|numeric",
            "empl_discapacidad" => "required|numeric",
            "empl_estadoCivil" => "required|numeric",
            "empl_origen" => "required|numeric",
            'empl_NIT'=>['required',new validarNIT],
            "empl_lugNac" => "required|max:8",
            "empl_IGSS" => "nullable|max:25",
            "empl_fecNac" => "nullable",
            "empl_pueblo" => "required|numeric",
            "empl_hijos" => "required|numeric",
            "empl_nivelAcad" => "required|numeric",
            "empl_titulo" => "nullable|max:100",
            "empl_expedienteExt" => "nullable|max:25",
            "empl_temporalidad" => "required|numeric",
            "empl_tipoContrato" => "required|numeric",
            "empl_inicio" => "required",
            "empl_retiro" => "nullable",
            "empl_ocupacion" => "required|max:4",
            "empl_jornada" => "required",
            "empl_tipoSalario" => "required|max:1",
            "empl_salario" => "required|numeric",
        ];
    }

    public function attributes()
    {
        return [
            'empl_codigo' => '<strong>Codigo</strong>',
            'empl_extranjero' => '<strong>Extranjero</strong>',
            'empl_idiomas' => '<strong>Idiomas</strong>',
            'empl_empresa' => '<strong>Empresa</strong>',
            'empl_terminal' => '<strong>Terminal</strong>',
            'empl_tipoDocID' => '<strong>Tipo Doc ID</strong>',
            "empl_docID" => '<strong>Doc ID</strong>',
            "empl_nom1" => '<strong>Nombre 1</strong>',
            "empl_nom2" => '<strong>Nombre 2</strong>',
            "empl_ape1" => '<strong>Apellido 1</strong>',
            "empl_ape2" => '<strong>Apellido 2</strong>',
            "empl_sexo" => '<strong>Sexo</strong>',
            "empl_nacionalidad" => '<strong>Nacionalidad</strong>',
            "empl_discapacidad" => '<strong>Discapacidad</strong>',
            "empl_estadoCivil" => '<strong>Estado Civil</strong>',
            "empl_origen" => '<strong>Origen</strong>',
            "empl_NIT" => '<strong>NIT</strong>',
            "empl_lugNac" => '<strong>Lugar Nacimiento</strong>',
            "empl_IGSS" => '<strong>IGSS</strong>',
            "empl_fecNac" => '<strong>Fecha Nacimiento</strong>',
            "empl_pueblo" => '<strong>Pueblo</strong>',
            "empl_hijos" => '<strong>Hijos</strong>',
            "empl_nivelAcad" => '<strong>Nivel Acadademico</strong>',
            "empl_titulo" => '<strong>Titulo</strong>',
            "empl_expedienteExt" => '<strong>Expediente Extranjero</strong>',
            "empl_temporalidad" => '<strong>Temporalidad</strong>',
            "empl_tipoContrato" => '<strong>Tipo Contrato</strong>',
            "empl_inicio" => '<strong>Inicio</strong>',
            "empl_retiro" => '<strong>Retiro</strong>',
            "empl_ocupacion" => '<strong>Ocupacion</strong>',
            "empl_jornada" => '<strong>Jornada</strong>',
            "empl_tipoSalario" => '<strong>Tipo Salario</strong>',
            "empl_salario" => '<strong>Salario</strong>',


        ];
    }
}
