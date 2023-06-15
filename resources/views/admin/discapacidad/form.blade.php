<div class="form-group row">
    <label for="dis_id" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Código</label>
    <div class="col-lg-2">
        <input type="text" name="dis_id" class="form-control" id="dis_id" placeholder="Código"
            value="{{old('dis_id', $data->dis_id ?? '')}}"  {{($data->dis_id??'')!=''?"disabled":""}} onkeypress='return validaNumericos(event,"P")' required>
    </div>
</div>

<div class="form-group row">
    <label for="dis_descripcion" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Descripción</label>
    <div class="col-lg-8">
        <input type="text" name="dis_descripcion" class="form-control" id="dis_descripcion" placeholder="Descripción"
            value="{{old('dis_descripcion', $data->dis_descripcion ?? '')}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>

