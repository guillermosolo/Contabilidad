<input type="hidden" id="muniPath" value="{{url('admin/representante')}}">

<div class="form-group row">
    <label for="repr_nombre" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Nombre</label>
    <div class="col-lg-8">
        <input type="text" name="repr_nombre" class="form-control" id="repr_nombre" placeholder="Nombre"
            value="{{old('repr_nombre', $data->repr_nombre ?? '')}}" required>
    </div>
</div>

<div class="form-group row">
    <label for="repr_NIT" class="col-lg-3 control-label text-sm-left text-lg-right">NIT</label>
    <div class="col-lg-2">
        <input type="text" name="repr_NIT" class="form-control" id="repr_NIT" placeholder="NIT"
            value="{{old('repr_NIT', $data->repr_NIT ?? '')}}" onkeypress='return validaNumericos(event,"N");' onkeyup="javascript:this.value=this.value.toUpperCase();">
    </div>
</div>

