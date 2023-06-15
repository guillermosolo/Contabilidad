<input type="hidden" id="muniPath" value="{{url('admin/municipios')}}">
<input type="hidden" id="muniCod" value="{{old('ter_municipio',$data->ter_municipio??'I0101')}}">

<div class="form-group row">
    <label for="ter_nombre" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Nombre</label>
    <div class="col-lg-8">
        <input type="text" name="ter_nombre" class="form-control" id="ter_nombre" placeholder="Nombre"
            value="{{old('ter_nombre', $data->ter_nombre ?? '')}}" required>
    </div>
</div>

<div class="form-group row">
    <label for="ter_departamento"
        class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right">Departamento</label>
    <div class="col-sm-12 col-lg-3">
        <select name="ter_departamento" id="ter_departamento" class="form-control select2" placeholder="Departamento">
            @foreach ($dep->getDepartamentos() as $item)
            <option value="{{$item->dep_id}}"
                {{substr(old('ter_municipio',$data->ter_municipio ?? ''),0,strlen($item->dep_id)-2)==substr($item->dep_id,0,strlen($item->dep_id)-2) ? 'selected':''}}>
                {{$item->dep_descripcion}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row">
    <label for="ter_municipio" class="col-sm-12 col-lg-3  control-label text-sm-left text-lg-right">Municipio</label>
    <div class="col-sm-12 col-lg-3">
        <select name="ter_municipio" id="ter_municipio" class="form-control select2"
            placeholder="Departamento"></select>
    </div>
</div>


<div class="form-group row">
    <label for="ter_abreviatura"
        class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Abreviatura</label>
    <div class="col-sm-12 col-lg-3">
        <input type="text" name="ter_abreviatura" class="form-control" id="ter_abreviatura" placeholder="Abreviatura"
            value="{{old('ter_abreviatura', $data->ter_abreviatura ?? '')}}"
            onkeyup="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>

<div class="form-group row">
    <label for="ter_activo" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right">Activa</label>
    <div class="col-sm-12 col-lg-3">
        <input type="checkbox" name="ter_activo" id="ter_activo" value="1"
            {{old('ter_activo',$data->ter_activo ?? '1')==1?"checked":""}} data-bootstrap-switch data-off-color="danger"
            data-on-color="success" data-on-text="SI" data-off-text="NO">
    </div>
</div>

<div class="form-group row">
    <label for="ter_autoriza"
        class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Nombre de quien Autorizó</label>
    <div class="col-sm-12 col-lg-3">
        <input type="text" name="ter_autoriza" class="form-control" id="ter_autoriza" placeholder="Autorización"
            value="{{old('ter_autoriza', $data->ter_autoriza ?? '')}}" required>
    </div>
</div>
