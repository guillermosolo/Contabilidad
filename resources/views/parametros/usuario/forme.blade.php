<div class="form-group row">
    <label for="usu_nombre" class="col-sm-12 col-lg-5 control-label text-sm-left text-lg-right requerido">Nombre</label>
    <div class="col-lg-3">
        <input type="text" name="usu_nombre" class="form-control" id="usu_nombre" placeholder="Nombre"
            value="{{old('usu_nombre', $data->usu_nombre ?? '')}}" required>
    </div>
</div>
        <input type="hidden" name="usu_pwd" class="form-control" id="usu_pwd" placeholder="Contraseña"
            value="{{old('usu_pwd', $data->usu_pwd ??'')}}" required readonly=»readonly >

<div class="form-group row">
    <label for="usu_activo" class="col-sm-12 col-lg-5 control-label text-sm-left text-lg-right">Usuario Activo</label>
    <div class="col-sm-12 col-lg-3">
        <input type="checkbox" name="usu_activo" id="usu_activo" value="1"
            {{old('usu_activo',$data->usu_activo ?? '1')==1?"checked":""}} data-bootstrap-switch data-off-color="danger"
            data-on-color="success" data-on-text="SI" data-off-text="NO">
    </div>
</div>



