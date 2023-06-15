<input type="hidden" id="empPath" value="{{url('parametros/terminal')}}">
<input type="hidden" id="muniPath" value="{{url('admin/municipios')}}">
<input type="hidden" id="idiomaEmpleadoPath" value="{{url('planillas/empleados/idioma')}}">
<input type="hidden" id="idiomaPath" value="{{url('planillas/empleados/idioma')}}">

<input type="hidden" id="empCod" value="{{old('empl_empresa',$empleado->empl_empresa??'')}}">
<input type="hidden" id="terCod" value="{{old('empl_terminal',$empleado->empl_terminal??'')}}">
<input type="hidden" id="muniCod" value="{{old('empl_lugNac',$empleado->empl_lugNac??'I0101')}}">
<input type="hidden" id="idEmpl" value="{{old('empl_id',$empleado->empl_id??'')}}">

<fieldset class="border p-2 col-sm-12 col-lg-12">
    <div class="form-group row">
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="prod_empresa"
                       class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Empresa</label>
                <div class="col-sm-12 col-lg-7">
                    <select name="empl_empresa" id="prod_empresa" class="form-control select2" placeholder="Empresa"
                            required>
                        <option value=""></option>
                        @foreach (auth()->user()->Empresas as $item)
                            <option value="{{$item->emp_id}}"
                                {{old('empl_empresa',$empleado->empl_empresa ?? '') == $item->emp_id ? 'selected':''}}>
                                {{$item->emp_siglas}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="prod_terminal" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right requerido">Terminal</label>
                <div class="col-sm-12 col-lg-7">
                    <select name="empl_terminal" id="prod_terminal" class="form-control select2" placeholder="Terminal"
                            required>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <input type="text" hidden value="{{$empleado->empl_tipoDocID}}" name="empl_tipoDocID">
                <label for="empl_tipoDocID" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Tipo
                    de ID</label>
                <div class="col-md-12 col-lg-7">
                    <select class="form-control select2" id="empl_tipoDocID" name="empl_tipoDocID" required>
                        <option value="1" {{old('empl_tipoDocID',$empleado->empl_tipoDocID ?? null)==1 ? 'selected':''}}>DPI</option>
                        <option value="2" {{old('empl_tipoDocID',$empleado->empl_tipoDocID ?? null)==2 ? 'selected':''}}>Partida de Nacimiento</option>
                        <option value="3" {{old('empl_tipoDocID',$empleado->empl_tipoDocID ?? null)==3 ? 'selected':''}}>Pasaporte</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_docID" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right requerido">No. ID</label>
                <div class="col-md-12 col-lg-7">
                    <input type="text" class="form-control w-100" id="empl_docID" name="empl_docID" required
                    value="{{old('empl_docID', $empleado->empl_docID ?? '')}}">
                </div>
            </div>
        </div>
    </div>
</fieldset>
<fieldset class="border p-2 col-sm-12 col-lg-12">
    <legend class="w-auto">Datos del Empleado</legend>
    <div class="form-group row">
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_nom1" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Primer
                    Nombre</label>
                <div class="col-md-12 col-lg-7">
                    <input type="text" class="form-control" id="empl_nom1" name="empl_nom1" maxlength="15"
                           value="{{old('empl_nom1', $empleado->empl_nom1 ?? '')}}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_nom2" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right">Segundo
                    Nombre</label>
                <div class="col-md-12 col-lg-7">
                    <input type="text" class="form-control" id="empl_nom2" name="empl_nom2" maxlength="15"
                           value="{{old('empl_nom2', $empleado->empl_nom2 ?? '')}}">
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_ape1" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Primer
                    Apellido </label>
                <div class="col-md-12 col-lg-7">
                    <input type="text" class="form-control" id="empl_ape1" name="empl_ape1" maxlength="15"
                           value="{{old('empl_ape1', $empleado->empl_ape1 ?? '')}}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_ape2" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right">Segundo
                    Apellido</label>
                <div class="col-md-12 col-lg-7">
                    <input type="text" class="form-control" id="empl_ape2" name="empl_ape2" maxlength="15"
                           value="{{old('empl_ape2', $empleado->empl_ape2 ?? '')}}">
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_codigo" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right">Codigo</label>
                <div class="col-md-12 col-lg-7">
                    <input type="text" class="form-control" id="empl_ape2" name="empl_codigo" maxlength="10"
                           value="{{old('empl_codigo', $empleado->empl_codigo ?? '')}}">
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_nacionalidad"
                       class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right requerido">Nacionalidad</label>
                <div class="col-md-12 col-lg-7">
                    <select class="form-control select2" id="empl_nacionalidad" name="empl_nacionalidad"
                            required {{$empleado->empl_nacionalidad ?? null?'readonly':''}}>
                        @foreach ($pais->getPaises() as $item)
                            <option
                                value="{{$item->pai_id}}"{{old('empl_nacionalidad',$empleado->empl_nacionalidad ?? 83)==$item->pai_id ? 'selected':''}}>
                                {{$item->pai_descripcion}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_discapacidad"
                       class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Discapacidad</label>
                <div class="col-md-12 col-lg-7">
                    <select class="form-control select2 w-100" id="empl_discapacidad" name="empl_discapacidad" required>
                        @foreach ($discapacidad->getDiscapacidades() as $item)
                        <option
                            value="{{$item->dis_id}}"{{old('empl_discapacidad',$empleado->empl_discapacidad ?? 7)==$item->dis_id ? 'selected':''}}>
                            {{$item->dis_descripcion}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_estadoCivil" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right requerido">Estado
                    Civil</label>
                <div class="col-md-12 col-lg-7">
                    <select class="form-control select2 w-100" id="empl_estadoCivil" name="empl_estadoCivil" required>
                        <option value="1" {{old('empl_estadoCivil',$empleado->empl_estadoCivil ?? null)==1 ? 'selected':''}}>Soltero</option>
                        <option value="2" {{old('empl_estadoCivil',$empleado->empl_estadoCivil ?? null)==2 ? 'selected':''}}>Casado</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_origen" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Origen</label>
                <div class="col-md-12 col-lg-7">
                    <select class="form-control w-100 select2"
                            {{$empleado->empl_origen ?? null?'readonly':''}} name="empl_origen" required>
                        @foreach ($pais->getPaises() as $item)
                        <option
                            value="{{$item->pai_id}}"{{old('empl_origen',$empleado->empl_origen ?? 83)==$item->pai_id ? 'selected':''}}>
                            {{$item->pai_descripcion}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_NIT"
                       class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right requerido">Nit</label>
                <div class="col-md-12 col-lg-7">
                    <input type="text" class="form-control w-100" id="empl_NIT" name="empl_NIT"
                           {{$empleado->empl_NIT ?? null?'readonly':''}}  maxlength="9"
                           value="{{old('empl_NIT', $empleado->empl_NIT ?? '')}}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_departamento"
                       class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Lugar Nac.</label>
                <div class="col-md-12 col-lg-7">
                    <select id="empl_departamento" class="form-control select2 w-100"
                            placeholder="Departamento" {{$empleado->empl_lugNac ?? null?'readonly':''}}>
                        @foreach ($dep->getDepartamentos() as $item)
                            <option value="{{$item->dep_id}}"
                                {{substr(old('empl_lugNac',$empleado->empl_lugNac ?? ''),0,strlen($item->dep_id)-2)==substr($item->dep_id,0,strlen($item->dep_id)-2) ? 'selected':''}}>
                                {{$item->dep_descripcion}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_lugNac" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right requerido">Municipio</label>
                <div class="col-md-12 col-lg-7">
                    <select name="empl_lugNac" id="empl_lugNac" class="form-control select2 w-100"
                            {{$empleado->empl_lugNac ?? null?'readonly':''}}
                            placeholder="Municipio"></select>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_IGSS" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right">IGSS</label>
                <div class="col-md-12 col-lg-7">
                    <input type="text" class="form-control w-100" id="empl_IGSS" name="empl_IGSS"
                           {{$empleado->empl_IGSS ?? null?'readonly':''}}
                           onkeypress='return validaNumericos(event,"N",this.value);'
                           value="{{old('empl_IGSS', $empleado->empl_IGSS ?? '')}}" maxlength="25">
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_fecNac" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right">Fecha
                    Nac.</label>
                <div class="input-group col-md-12 col-lg-7">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control" name="empl_fecNac"
                           {!!$empleado->empl_fecNac ?? null?'readonly':'id="empl_fecNac"'!!}
                           value="{{old('empl_fecNac', Carbon\Carbon::parse($empleado->empl_fecNac??'')->format('d/m/Y'))}}"
                           required>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_pueblo" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Pueblo</label>
                <div class="col-md-12 col-lg-7">

                    <select name="empl_pueblo" id="empl_pueblo" class="form-control select2 w-100"
                            placeholder="Pueblo" {{$empleado->empl_pueblo ?? null?'readonly':''}} >
                        @foreach ($pue->getPueblos() as $item)
                            <option value="{{$item->pue_id}}"
                                    value="{{$item->pue_id}}"{{old('empl_pueblo',$empleado->empl_pueblo ?? 4)==$item->pue_id ? 'selected':''}}>
                                {{$item->pue_descripcion}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_hijos" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right">Hijos</label>
                <div class="col-md-12 col-lg-7">
                    <input type="number" class="form-control w-100" id="empl_hijos" name="empl_hijos"
                           value="{{old('empl_hijos', $empleado->empl_hijos ?? 0)}}"
                           onkeypress='return validaNumericos(event,"N",this.value);'>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_nivelAcad" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Academico</label>
                <div class="col-md-12 col-lg-7">
                    <select name="empl_nivelAcad" id="empl_nivelAcad" class="form-control select2 w-100"
                            placeholder="Academico">
                        @foreach ($aca->getAcademicos() as $item)
                            <option value="{{$item->aca_id}}" value="{{$item->aca_id}}"{{old('empl_nivelAcad',$empleado->empl_nivelAcad ?? 0)==$item->aca_id ? 'selected':''}}>{{$item->aca_descripcion}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_titulo" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right">Titulo</label>
                <div class="col-md-12 col-lg-7">
                    <input type="text" class="form-control w-100" id="empl_titulo" name="empl_titulo" maxlength="100"
                           value="{{old('empl_titulo', $empleado->emp_tituloempl_titulo ?? '')}}">
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_expedienteExt" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right">Expediente
                    Ext</label>
                <div class="col-md-12 col-lg-7">
                    <input type="text" class="form-control w-100" id="empl_expedienteExt" name="empl_expedienteExt"
                           maxle ngth="50"
                           value="{{old('empl_expedienteExt', $empleado->empl_expedienteExt ?? '')}}">
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_idiomas"
                       class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right">Idiomas</label>
                <input type="text" hidden name="empl_idiomas" id="empl_idiomas">
                <div class="col-md-12 col-lg-7">
                    <select id="idiomas" class="form-control w-100" placeholder="Idiomas" multiple="multiple">
                        @foreach ($idi->getIdiomas()  as $item)
                            <option value="{{$item->idi_id}}" value="{{$item->idi_id}}" {{in_array($item->idi_id,$idiomasSelecionados??[23] )? 'selected':''}}>{{$item->idi_descripcion}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_sexo"
                       class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Sexo</label>
                <div class="col-md-12 col-lg-7">
                    <select class="form-control select2" id="empl_sexo" name="empl_sexo"
                            required {{$empleado->empl_sexo ?? null?'readonly':''}}>
                        <option value="1" {{old('empl_sexo',$empleado->empl_sexo ?? null)==1 ? 'selected':''}}>Femenino</option>
                        <option value="2" {{old('empl_sexo',$empleado->empl_sexo ?? null)==2 ? 'selected':''}}>Masculino</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</fieldset>

<fieldset class="border p-2 col-sm-12 col-lg-12">
    <legend class="w-auto">Informacion Laboral</legend>
    <div class="form-group row">
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_temporalidad"
                       class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Temporalidad</label>
                <div class="col-md-12 col-lg-7">
                    <select class="form-control select2 w-100" id="empl_temporalidad" name="empl_temporalidad" required>
                        <option value="1" {{old('empl_temporalidad',$empleado->empl_temporalidad ?? null)==1 ? 'selected':''}}>Indefinido</option>
                        <option value="2" {{old('empl_temporalidad',$empleado->empl_temporalidad ?? null)==2 ? 'selected':''}}>Definido</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_tipoContrato"
                       class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right requerido">Tipo de
                    Contrato</label>
                <div class="col-md-12 col-lg-7">
                    <select class="form-control select2 w-100" id="empl_tipoContrato" name="empl_tipoContrato" required>
                        <option value="1" {{old('empl_tipoContrato',$empleado->empl_tipoContrato ?? null)==1 ? 'selected':''}}>Verbal</option>
                        <option value="2" {{old('empl_tipoContrato',$empleado->empl_tipoContrato ?? null)==2 ? 'selected':''}}>Escrito</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_inicio" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Fecha
                    Inicio</label>
                <div class="input-group col-lg-7 col-md-12">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control" name="empl_inicio"
                           {!!$empleado->empl_inicio ?? null?'readonly':'id="empl_inicio"'!!}
                           value="{{old('empl_inicio', Carbon\Carbon::parse($empleado->empl_inicio??'')->format('d/m/Y'))}}"
                           required>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_retiro" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right">Fecha
                    Retiro</label>
                <div class="input-group col-lg-7 col-md-12">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control" name="empl_retiro"
                           {!!$empleado->empl_retiro ?? null?'readonly':'id="empl_retiro"'!!}
                           value="{{old('empl_retiro', Carbon\Carbon::parse($empleado->empl_retiro??'')->format('d/m/Y'))}}">
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_ocupacion"
                       class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right">Ocupacion</label>
                <div class="col-md-12 col-lg-7">
                    <input type="text" class="form-control w-100" id="empl_ocupacion" name="empl_ocupacion" required
                           maxlength="4" {{$empleado->empl_ocupacion ?? null?'readonly':''}}
                           value="{{old('empl_ocupacion', $empleado->empl_ocupacion ?? '')}}">
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_jornada"
                       class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right">Jornada</label>
                <div class="col-md-12 col-lg-7">
                    <select name="empl_jornada" id="empl_jornada" class="form-control select2 w-100"
                            placeholder="Jornada">
                        <option value="1" {{old('empl_jornada',$empleado->empl_jornada ?? null)==1 ? 'selected':''}}>Diurna</option>
                        <option value="2" {{old('empl_jornada',$empleado->empl_jornada ?? null)==2 ? 'selected':''}}>Mixta</option>
                        <option value="3" {{old('empl_jornada',$empleado->empl_jornada ?? null)==3 ? 'selected':''}}>Nocturna</option>
                        <option value="4" {{old('empl_jornada',$empleado->empl_jornada ?? null)==4 ? 'selected':''}}>No está sujeto a jornada</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_tipoSalario" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Tipo
                    Salario</label>
                <div class="col-md-12 col-lg-7">
                    <select name="empl_tipoSalario" id="empl_tipoSalario" class="form-control select2 w-100"
                            placeholder="Tipo Salario" required>
                        <option value="M" {{old('empl_tipoSalario',$empleado->empl_tipoSalario ?? null)=="M" ? 'selected':''}}>Mensual</option>
                        <option value="T" {{old('empl_tipoSalario',$empleado->empl_tipoSalario ?? null)=="T" ? 'selected':''}}>Turnos</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empl_salario"
                       class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right">Salario</label>
                <div class="col-md-12 col-lg-7">
                    <input type="number" class="form-control w-100" id="empl_salario" name="empl_salario" onkeypress='return validaNumericos(event,"D",this.value);' value="{{old('empl_salario', $empleado->empl_salario ?? 0)}}" Step=".01" required>
                </div>
            </div>
        </div>
        @if($editForm?? true)
            <div class="col-lg-4 col-sm-12 mb-3">
                <div class="row">
                    <label for="emp_activa" class="col-sm-12 col-lg-6 control-label text-sm-left text-lg-right">Trabajo en el Extranjero</label>
                    <div class="col-md-12 col-lg-6">
                        <input type="checkbox" name="empl_extranjero" value="1" data-bootstrap-switch
                               data-off-color="danger"
                               data-on-color="success" data-on-text="SI" data-off-text="NO">
                    </div>
                </div>
            </div>
        @endif

    </div>
</fieldset>
