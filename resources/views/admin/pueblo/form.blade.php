<div class="form-group row">
    <label for="pue_id" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Código</label>
    <div class="col-lg-2">
        <input type="text" name="pue_id" class="form-control" id="pue_id" placeholder="Código"
            value="{{old('pue_id', $data->pue_id ?? '')}}"  {{($data->pue_id??'')!=''?"disabled":""}} onkeypress='return validaNumericos(event,"P")' required>
    </div>
</div>

<div class="form-group row">
    <label for="pue_descripcion" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Descripción</label>
    <div class="col-lg-8">
        <input type="text" name="pue_descripcion" class="form-control" id="pue_descripcion" placeholder="Descripción"
            value="{{old('pue_descripcion', $data->pue_descripcion ?? '')}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>

