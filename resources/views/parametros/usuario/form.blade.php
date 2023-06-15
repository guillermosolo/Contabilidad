<div class="form-group row">
    <label for="usu_nombre" class="col-sm-12 col-lg-5 control-label text-sm-left text-lg-right requerido">Nombre</label>
    <div class="col-lg-3">
        <input type="text" name="usu_nombre" class="form-control" id="usu_nombre" placeholder="Nombre"
            value="{{old($data->usu_nombre ?? '')}}" required>
    </div>
</div>


<div class="form-group row">
    <label for="usu_pwd" class="col-sm-12 col-lg-5 control-label text-sm-left text-lg-right">Contraseña</label>
    <div class="input-group col-sm-12 col-lg-4" id="show_hide_password">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fas fa-lock"></i>
            </span>
        </div>
        <input type="Password" name="usu_pwd" id="txtPassword" class="form-control" placeholder="Contraseña"
            value="{{old($data->usu_pwd ?? '')}}">
        <div class="input-group-apend">
            <span class="input-group-text">
                <a href="" tabindex="-1"><i class="fas fa-eye-slash" aria-hidden="true"></i></a>
            </span>
        </div>
    </div>
</div>

<div class="row">
<div class="col-lg-6"></div>
<div id="strengthMessage" class="col-sm-12 col-lg-6 text-lg-left"></div>
</div>

<div class="form-group row">
    <label for="usu_pwd2" class="col-sm-12 col-lg-5 control-label text-sm-left text-lg-right">Confirmación</label>
    <div class="input-group col-sm-12 col-lg-4" id="show_hide_password">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fas fa-lock"></i>
            </span>
        </div>
        <input type="Password" name="usu_pwd2" id="confirmtxtPassword" class="form-control" placeholder="Contraseña"
            value="{{old($data->usu_pwd ?? '')}}">
    </div>
</div>
<div class="row">
    <div class="col-lg-6"></div>
<div id="confirmMessage" class="col-sm-12 col-lg-6 text-lg-left"></div>
</div>

<div class="row">
<div class="col-lg-6"></div>
<div id="strengthMessage" class="col-sm-12 col-lg-6 text-lg-left"></div>
</div>

<div class="form-group row">
    <label for="usu_activo" class="col-sm-12 col-lg-5 control-label text-sm-left text-lg-right">Usuario Activo</label>
    <div class="col-sm-12 col-lg-3">
        <input type="checkbox" name="usu_activo" id="usu_activo" value="1"
            {{old('usu_activo',$data->usu_activo ?? '1')==1?"checked":""}} data-bootstrap-switch data-off-color="danger"
            data-on-color="success" data-on-text="SI" data-off-text="NO">
    </div>
</div>

<div class="form-group row">
    <label for="usu_empleado"
        class="col-sm-12 col-sm-12 col-lg-5 control-label text-sm-left text-lg-right">Empleado</label>
    <div class="col-sm-12 col-lg-3">
        <select name="usu_empleado" id="usu_empleado" class="form-control select2" placeholder="Empleado">
            @foreach ($empl->getEmpleados() as $item)
            <option value="{{$item->empl_id}}"
                {{old('usu_empleado',$data->usu_empleado ?? '')==$item->empl_id ? 'selected':''}}>
                {{$empl->getNombreCompleto($item->empl_id)}}</option>
            @endforeach
        </select>
    </div>
</div>
