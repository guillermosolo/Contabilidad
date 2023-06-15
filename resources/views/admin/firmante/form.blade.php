<div class="form-group row">
    <label for="fir_nombre" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Nombre</label>
    <div class="col-lg-8">
        <input type="text" name="fir_nombre" class="form-control" id="fir_nombre" placeholder="Nombre"
            value="{{old('fir_nombre', $data->fir_nombre ?? '')}}" required>
    </div>
</div>

