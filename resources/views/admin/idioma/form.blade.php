<div class="form-group row">
    <label for="idi_id" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Código</label>
    <div class="col-lg-2">
        <input type="text" name="idi_id" class="form-control" id="idi_id" placeholder="Código"
            value="{{old('idi_id', $data->idi_id ?? '')}}"  {{($data->idi_id??'')!=''?"disabled":""}} onkeypress='return validaNumericos(event,"P")' required>
    </div>
</div>

<div class="form-group row">
    <label for="idi_descripcion" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Descripción</label>
    <div class="col-lg-8">
        <input type="text" name="idi_descripcion" class="form-control" id="idi_descripcion" placeholder="Descripción"
            value="{{old('idi_descripcion', $data->idi_descripcion ?? '')}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>

