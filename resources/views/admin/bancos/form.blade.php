<input type="hidden" id="muniPath" value="{{url('admin/bancos')}}">


<div class="form-group row">
    <label for="ban_nombre" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Nombre</label>
    <div class="col-lg-8">
        <input type="text" name="ban_nombre" class="form-control" id="ban_nombre" placeholder="Nombre"
            value="{{old('ban_nombre', $data->ban_nombre ?? '')}}" required>
    </div>
</div>

<div class="form-group row">
    <label for="ban_siglas"
        class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Siglas</label>
    <div class="col-sm-12 col-lg-3">
        <input type="text" name="ban_siglas" class="form-control" id="ban_siglas" placeholder="Siglas"
            value="{{old('ban_siglas', $data->ban_siglas ?? '')}}"
            onkeyup="javascript:this.value=this.value.toUpperCase();" required>
        </div>
    </div>
</div>

