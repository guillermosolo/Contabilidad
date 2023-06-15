


<div class="form-group row">
    <label for="sta_descripcion"
        class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Descripción</label>
    <div class="col-sm-12 col-lg-3">
        <input type="text" name="sta_descripcion" class="form-control" id="sta_descripcion" placeholder="DESCRIPCIÓN"
            value="{{old('sta_descripcion', $data->sta_descripcion ?? '')}}"
            onkeyup="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>

<div class="form-group row">
    <label for="sta_baja" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Es baja</label>
    <div class="col-sm-12 col-lg-3">
        <input type="checkbox" name="sta_baja" id="sta_baja" value="1"
            {{old('sta_baja',$data->sta_baja ?? '1')==1?"checked":""}} data-bootstrap-switch data-off-color="danger"
            data-on-color="success" data-on-text="SI" data-off-text="NO">
    </div>
</div>
