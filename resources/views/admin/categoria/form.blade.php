<div class="form-group row">
    <label for="cat_descripcion" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Descripción</label>
    <div class="col-lg-8">
        <input type="text" name="cat_descripcion" class="form-control" id="cat_descripcion" placeholder="Descripción"
            value="{{old('cat_descripcion', $data->cat_descripcion ?? '')}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>

<div class="form-group row">
    <label for="cat_porcentaje" class="col-lg-3 control-label text-right requerido">Porcentaje Máximo</label>
    <div class="col-lg-3">
        <input data-suffix="%" type="number" step="any" min="0" max="100" data-decimals= "2" name="cat_porcentaje" class="form-control" id="cat_porcentaje" placeholder="Porcentaje"
            value="{{old('cat_porcentaje', ($data->cat_porcentaje ?? 0)*100)}}">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-3 control-label text-right requerido">Tipo</label>
    <div class="col-lg-8">
        <div class="icheck-midnightblue d-inline">
            <input type="radio" id="accionDep" name="cat_tipo" value="D" {{old('cat_tipo',$data->cat_tipo ?? 'D')=='D'?"checked":""}}>
            <label for="accionDep" class="mr-5">Depreciación</label>
        </div>
        <div class="icheck-midnightblue d-inline">
            <input type="radio" id="accionAmort" name="cat_tipo" value="A" {{old('cat_tipo',$data->cat_tipo ?? '')=='A'?"checked":""}}>
            <label for="accionAmort">Amortización</label>
        </div>
    </div>
</div>
