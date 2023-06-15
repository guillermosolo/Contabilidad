<div class="form-group row">
    <label for="pai_id" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Código</label>
    <div class="col-lg-2">
        <input type="text" name="pai_id" class="form-control" id="pai_id" placeholder="Código"
            value="{{old('pai_id', $data->pai_id ?? '')}}"  {{($data->pai_id??'')!=''?"disabled":""}} onkeypress='return validaNumericos(event,"P")' required>
    </div>
</div>

<div class="form-group row">
    <label for="pai_descripcion" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Descripción</label>
    <div class="col-lg-8">
        <input type="text" name="pai_descripcion" class="form-control" id="pai_descripcion" placeholder="Descripción"
            value="{{old('pai_descripcion', $data->pai_descripcion ?? '')}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>

