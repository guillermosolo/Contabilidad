<div class="form-group row">
    <label for="mon_nombre" class="col-sm-12 col-lg-5 control-label text-sm-left text-lg-right requerido">Nombre</label>
    <div class="col-lg-3">
        <input type="text" name="mon_nombre" class="form-control" id="mon_nombre" placeholder="Nombre"
            value="{{old('mon_nombre', $data->mon_nombre ?? '')}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>

<div class="form-group row">
    <label for="mon_abreviatura" class="col-sm-12 col-lg-5 control-label text-sm-left text-lg-right requerido">Abreviatura</label>
    <div class="col-lg-2">
        <input type="text" name="mon_abreviatura" class="form-control" id="mon_abreviatura" placeholder="Abreviatura"
            value="{{old('mon_abreviatura', $data->mon_abreviatura ?? '')}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>

<div class="form-group row">
    <label for="mon_simbolo" class="col-sm-12 col-lg-5 control-label text-sm-left text-lg-right requerido">Símbolo</label>
    <div class="col-lg-1">
        <input type="text" name="mon_simbolo" class="form-control" id="mon_simbolo" placeholder="Símbolo"
            value="{{old('mon_simbolo', $data->mon_simbolo ?? '')}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>
 