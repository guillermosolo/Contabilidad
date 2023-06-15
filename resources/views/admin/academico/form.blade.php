<div class="form-group row">
    <label for="aca_id" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Código</label>
    <div class="col-lg-2">
        <input type="text" name="aca_id" class="form-control" id="aca_id" placeholder="Código"
            value="{{old('aca_id', $data->aca_id ?? '')}}"  {{($data->aca_descripcion??'')!=''?"disabled":""}} onkeypress='return validaNumericos(event,"P")' required>
    </div>
</div>

<div class="form-group row">
    <label for="aca_descripcion" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Descripción</label>
    <div class="col-lg-8">
        <input type="text" name="aca_descripcion" class="form-control" id="aca_descripcion" placeholder="Descripción"
            value="{{old('aca_descripcion', $data->aca_descripcion ?? '')}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>

