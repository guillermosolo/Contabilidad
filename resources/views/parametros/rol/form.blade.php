<div class="form-group row">
    <label for="name" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Nombre</label>
    <div class="col-lg-9">
        <input type="text" name="name" class="form-control" id="name" placeholder="Nombre"
            value="{{old('emp_nombre', $data->emp_nombre ?? '')}}" required>
    </div>
</div>
