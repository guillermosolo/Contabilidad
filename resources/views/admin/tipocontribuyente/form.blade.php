<div class="form-group row">
    <label for="tpc_nombre" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Nombre</label>
    <div class="col-lg-8">
        <input type="text" name="tpc_nombre" class="form-control" id="tpc_nombre" placeholder="Nombre"
            value="{{old('tpc_nombre', $data->tpc_nombre ?? '')}}" required>
    </div>
</div>

