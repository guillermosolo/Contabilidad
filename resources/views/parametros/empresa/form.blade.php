<input type="hidden" id="muniPath" value="{{url('admin/municipios')}}">
<input type="hidden" id="muniCod" value="{{old('emp_municipio',$data->emp_municipio??'I0101')}}">
<input type="hidden" id="hemp_inicio"
    value="{{old('emp_inicio',\Carbon\Carbon::parse($data->emp_inicio ?? now())->format('d/m/Y'))}}">

<div class="form-group row">
    <label for="emp_nombre" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Nombre</label>
    <div class="col-lg-9">
        <input type="text" name="emp_nombre" class="form-control" id="emp_nombre" placeholder="Nombre"
            value="{{old('emp_nombre', $data->emp_nombre ?? '')}}"  onkeyup="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>

<div class="form-group row">
    <label for="emp_nomComercial" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Nombre Comercial</label>
    <div class="col-lg-9">
        <input type="text" name="emp_nomComercial" class="form-control" id="emp_nomComercial" placeholder="Nombre"
            value="{{old('emp_nomComercial', $data->emp_nomComercial ?? '')}}"  onkeyup="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>

<div class="form-group row">
    <label for="emp_siglas" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Abreviatura</label>
    <div class="col-sm-12 col-lg-4">
        <input type="text" name="emp_siglas" class="form-control" id="emp_siglas" placeholder="Abreviatura"
            value="{{old('emp_siglas', $data->emp_siglas ?? '')}}"
            onkeyup="javascript:this.value=this.value.toUpperCase();">
    </div>

    <label for="emp_NIT" class="col-lg-1 control-label text-sm-left text-lg-right requerido">NIT</label>
    <div class="col-sm-12 col-lg-4">
        <input type="text" name="emp_NIT" class="form-control" id="emp_NIT" placeholder="NIT"
            value="{{old('emp_NIT', $data->emp_NIT ?? '')}}" onkeypress='return validaNumericos(event,"N");'
            onkeyup="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>

<div class="form-group row">
    <label for="emp_departamento"
        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Departamento</label>
    <div class="col-sm-12 col-lg-4">
        <select name="emp_departamento" id="emp_departamento" class="form-control select2" placeholder="Departamento">
            @foreach ($dep->getDepartamentos() as $item)
            <option value="{{$item->dep_id}}"
                {{substr(old('emp_municipio',$data->emp_municipio ?? ''),0,strlen($item->dep_id)-2)==substr($item->dep_id,0,strlen($item->dep_id)-2) ? 'selected':''}}>
                {{$item->dep_descripcion}}</option>
            @endforeach
        </select>
    </div>

    <label for="emp_municipio"
        class="col-sm-12 col-lg-1  control-label text-sm-left text-lg-right requerido">Municipio</label>
    <div class="col-sm-12 col-lg-4">
        <select name="emp_municipio" id="emp_municipio" class="form-control select2" placeholder="Municipio"></select>
    </div>
</div>

<div class="form-group row">
    <label for="emp_actividad" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Actividad
        Económica</label>
    <div class="col-sm-12 col-lg-2">
        <input type="text" name="emp_actividad" class="form-control" id="emp_actividad" placeholder="Código"
            value="{{old('emp_actividad', $data->emp_actividad ?? '')}}" required>
    </div>


    <label for="emp_descripcion"
        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Descripción de Actividad
        Económica</label>
    <div class="col-lg-5">
        <input type="text" name="emp_descripcion" class="form-control" id="emp_descripcion" placeholder="Descripción"
            value="{{old('emp_descripcion', $data->emp_descripcion ?? '')}}" required>
    </div>
</div>

<div class="form-group row">
    <label for="emp_regimen" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Régimen
        Fiscal</label>
    <div class="col-sm-12 col-lg-4">
        <select name="emp_regimen" id="emp_regimen" class="form-control select2" placeholder="Regimen">
            @foreach ($regimen->getRegimenes() as $item)
            <option value="{{$item->reg_id}}"
                {{old('emp_regimen',$data->emp_regimen ?? '')==$item->reg_id ? 'selected':''}}>
                {{$item->reg_descripcion}}</option>
            @endforeach
        </select>
    </div>

    <label for="emp_fel" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Certificador
        FEL</label>
    <div class="col-sm-12 col-lg-4">
        <select name="emp_fel" id="emp_fel" class="form-control select2" placeholder="Certificador FEL">
            @foreach ($fel->getCertificadores() as $item)
            <option value="{{$item->cer_id}}" {{old('emp_fel',$data->emp_fel ?? '')==$item->cer_id ? 'selected':''}}>
                {{$item->cer_nombre}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="emp_inicio" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Inicio de
        Operaciones</label>
    <div class="input-group col-sm-12 col-lg-3">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="far fa-calendar-alt"></i>
            </span>
        </div>
        <input type="text" class="form-control float-right" id="emp_inicio" name="emp_inicio" required>
    </div>


    <label for="emp_activa">Activa</label>
    <div class="col-sm-12 col-lg-2">
        <input type="checkbox" name="emp_activa" id="emp_activa" value="1"
            {{old('emp_activa',$data->emp_activa ?? '1')==1?"checked":""}} data-bootstrap-switch data-off-color="danger"
            data-on-color="success" data-on-text="SI" data-off-text="NO">
    </div>

    <label for="emp_sindicato" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Sindicato</label>
    <div class="col-sm-12 col-lg-2">
        <input type="checkbox" name="emp_sindicato" id="emp_sindicato" value="1"
            {{old('emp_sindicato',$data->emp_sindicato ?? '0')==1?"checked":""}} data-bootstrap-switch
            data-off-color="danger" data-on-color="success" data-on-text="SI" data-off-text="NO">
    </div>
</div>

<div class="form-group row">
    <label for="emp_logo" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Logo</label>
    <div class="input-group col-sm-12 col-lg-4">
        <div class="custom-file">
            <input type="file" accept=".jpg,.png" class="custom-file-input form-control float-right inline" id="emp_logo" name="emp_logo"
                lang="es">
            <label class="custom-file-label" for="emp_logo">Seleccione Archivo</label>
        </div>
    </div>

    <label for="emp_CUI" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">CUI</label>
    <div class="col-sm-12 col-lg-4">
        <input type="text" name="emp_CUI" class="form-control" id="emp_CUI" placeholder="CUI"
            value="{{old('emp_CUI', $data->emp_CUI ?? '')}}" onkeypress='return validaNumericos(event,"P");'>
    </div>
</div>

<div class="form-group row">
    <label for="emp_nacionalidad" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">País de
        Nacionalidad</label>
    <div class="col-sm-12 col-lg-4">
        <select name="emp_nacionalidad" id="emp_nacionalidad" class="form-control select2" placeholder="Nacionalidad">
            @foreach ($pais->getPaises() as $item)
            <option value="{{$item->pai_id}}"
                {{old('emp_nacionalidad',$data->emp_nacionalidad ?? '83')==$item->pai_id ? 'selected':''}}>
                {{$item->pai_descripcion}}</option>
            @endforeach
        </select>
    </div>

    <label for="emp_numeroIGSS" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Número
        IGSS</label>
    <div class="col-sm-12 col-lg-4">
        <input type="text" name="emp_numeroIGSS" class="form-control" id="emp_numeroIGSS"
            placeholder="Número Patronal IGSS" value="{{old('emp_numeroIGSS', $data->emp_numeroIGSS ?? '')}}"
            onkeypress='return validaNumericos(event,"P");'>
    </div>
</div>

<div class="row">
    <div class="col-lg-1"></div>
    <fieldset class="border p-2 col-sm-12 col-lg-10">
        <legend class="w-auto">Dirección</legend>
        <div class="form-group row">
            <label for="emp_direccion" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Ubicación</label>
            <div class="col-lg-11">
                <input type="text" name="emp_direccion" class="form-control" id="emp_direccion" placeholder="Dirección Completa"
                    value="{{old('emp_direccion', $data->emp_direccion ?? '')}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="emp_colonia" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Colonia</label>
            <div class="col-sm-12 col-lg-3">
                <input type="text" name="emp_colonia" class="form-control" id="emp_colonia" placeholder="Colonia"
                    value="{{old('emp_colonia', $data->emp_colonia ?? '')}}">
            </div>

            <label for="emp_zona" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Zona</label>
            <div class="col-sm-12 col-lg-1">
                <input type="text" name="emp_zona" class="form-control" id="emp_zona" placeholder="Zona"
                    value="{{old('emp_zona', $data->emp_zona ?? '')}}" onkeypress='return validaNumericos(event,"P");'>
            </div>

            <label for="emp_calle" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Calle</label>
            <div class="col-sm-12 col-lg-2">
                <input type="text" name="emp_calle" class="form-control" id="emp_calle" placeholder="Calle"
                    value="{{old('emp_calle', $data->emp_calle ?? '')}}">
            </div>

            <label for="emp_avenida" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Avenida</label>
            <div class="col-sm-12 col-lg-2">
                <input type="text" name="emp_avenida" class="form-control" id="emp_avenida" placeholder="Avenida"
                    value="{{old('emp_avenida', $data->emp_avenida ?? '')}}">
            </div>
        </div>
    </fieldset>
</div>

<div class="row">
    <div class="col-lg-12">&nbsp;</div>
</div>

<div class="form-group row">
    <label for="emp_nomenclatura"
        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Nomenclatura</label>
    <div class="col-sm-12 col-lg-4">
        <input type="text" name="emp_nomenclatura" class="form-control" id="emp_nomenclatura" placeholder="Nomenclatura"
            value="{{old('emp_nomenclatura', $data->emp_nomenclatura ?? '')}}">
    </div>

    <label for="emp_sitioWeb" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Sitio Web</label>
    <div class="col-sm-12 col-lg-4">
        <input type="text" name="emp_sitioWeb" class="form-control" id="emp_sitioWeb" placeholder="Sitio Web"
            value="{{old('emp_sitioWeb', $data->emp_sitioWeb ?? '')}}">
    </div>
</div>

<div class="form-group row">
    <label for="emp_email" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Correo
        Electrónico</label>
    <div class="input-group col-sm-12 col-lg-4">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fas fa-at"></i>
            </span>
        </div>
        <input type="email" name="emp_email" id="emp_email" class="form-control" placeholder="Correo Electrónico"
            value="{{old('emp_email',$data->emp_email ?? '')}}">
    </div>

    <label for="emp_telefono" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Teléfono</label>
    <div class="input-group col-sm-12 col-lg-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-phone"></i></span>
        </div>
        <input type="text" class="form-control" id="emp_telefono" name="emp_telefono"
            data-inputmask='"mask": "(999) 9999-9999"' value="{{old('emp_telefono', $data->emp_telefono ?? '')}}"
            data-mask onkeypress='return validaNumericos(event,"P")'>
    </div>
</div>
