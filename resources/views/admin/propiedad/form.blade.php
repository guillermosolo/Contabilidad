<div class="form-group row">
    <label for="prop_nombre"
        class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Nombre</label>
    <div class="col-sm-12 col-lg-8">
        <input type="text" name="prop_nombre" class="form-control" id="sta_descripcion" placeholder="Nombre"
            value="{{old('prop_nombre', $data->prop_nombre ?? '')}}"
            onkeyup="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>

