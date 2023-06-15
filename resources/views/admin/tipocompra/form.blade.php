<div class="form-group row">
    <label for="tipc_descripcion" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Descripción</label>
    <div class="col-lg-8">
        <input type="text" name="tipc_descripcion" class="form-control" id="tipc_descripcion" placeholder="Descripción"
            value="{{old('tipc_descripcion', $data->tipc_descripcion ?? '')}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>
