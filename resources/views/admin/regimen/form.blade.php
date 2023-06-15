<div class="form-group row">
    <label for="reg_descripcion" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Descripción Larga</label>
    <div class="col-lg-8">
        <input type="text" name="reg_descripcion" class="form-control" id="reg_descripcion" placeholder="Descripción Larga"
            value="{{old('reg_descripcion', $data->reg_descripcion ?? '')}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>

<div class="form-group row">
    <label for="reg_desc_ct" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Nickname</label>
    <div class="col-lg-2">
        <input type="text" name="reg_desc_ct" class="form-control" id="reg_desc_ct" placeholder="Descripción Corta"
            value="{{old('reg_desc_ct', $data->reg_desc_ct ?? '')}}" required>
    </div>
</div>


