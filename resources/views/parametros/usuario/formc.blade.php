<input type="hidden" name="usu_nombre" class="form-control" id="usu_nombre" placeholder="Nombre"
    value="{{old('usu_nombre', $data->usu_nombre ?? '')}}" required readonly=»readonly>

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


