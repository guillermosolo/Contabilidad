<div class="form-group row">
    <label for="tco_nombre" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Nombre</label>
    <div class="col-lg-8">
        <input type="text" name="tco_nombre" class="form-control" id="tco_nombre" placeholder="Nombre"
            value="{{old('tco_nombre', $data->tco_nombre ?? '')}}" required>
    </div>
</div>

<div class="form-group row">
    <label for="tco_idp" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">IDP</label>
    <div class="col-lg-3">
        <input type="number" data-prefix='Q' step="any" min=0 data-decimals= 2 name="tco_idp" class="form-control" id="tco_idp" placeholder="0.00"
            value="{{old('tco_idp', $data->tco_idp ?? '')}}" required>
    </div>
</div>
