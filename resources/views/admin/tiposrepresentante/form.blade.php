<input type="hidden" id="muniPath" value="{{url('admin/tiposrepresentante')}}">

<div class="form-group row">
    <label for="trep_nombre" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Nombre</label>
    <div class="col-lg-8">
        <input type="text" name="trep_nombre" class="form-control" id="trep_nombre" placeholder="Nombre"
            value="{{old('trep_nombre', $data->trep_nombre ?? '')}}" required>
    </div>
</div>
