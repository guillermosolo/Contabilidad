<input type="hidden" id="empPath" value="{{url('parametros/terminal')}}">
<input type="hidden" id="cuentaContable" value="{{old('desc_cuentaContable')}}">
<input type="hidden" id="empCod" value="{{old('pla_empresa')}}">
<input type="hidden" id="terCod" value="{{old('pla_terminal')}}">
<fieldset class="border p-2 col-sm-12 col-lg-12">
    <legend class="w-auto">Datos de planilla Eventual</legend>
    <div class="form-group row">
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="pla_empresa"
                       class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Empresa</label>
                <div class="col-sm-12 col-lg-7">
                    <select id="pla_empresa" name="pla_empresa" class="form-control select2" placeholder="Empresa"
                            required>
                        <option value=""></option>
                        @foreach (auth()->user()->Empresas as $item)
                            <option value="{{$item->emp_id}}" {{old('pla_empresa')==$item->emp_id ? 'selected':''}}>
                                {{$item->emp_siglas}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="pla_terminal" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right requerido">Terminal</label>
                <div class="col-sm-12 col-lg-7">
                    <select name="pla_terminal" id="pla_terminal" class="form-control select2" placeholder="Terminal"
                            required>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="pla_fecha" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right">Inicio</label>
                <div class="input-group col-md-12 col-lg-7">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control" name="pla_fecha" id="pla_fecha" value="{{old('pla_fecha')}}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="pla_descripcion"
                       class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right requerido">Descripcion</label>
                <div class="col-md-12 col-lg-7">
                    <input type="text" class="form-control" id="pla_descripcion" name="pla_descripcion"
                           value="{{old('pla_descripcion')}}" required maxlength="100">
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3" hidden>
            <div class="row">
                <label for="pla_tipo"
                       class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Tipo</label>
                <div class="col-sm-12 col-lg-7">
                    <select id="pla_tipo" name="pla_tipo" class="form-control select2" placeholder="Tipo" required>
                            <option value="E" selected>EVENTUAL</option>
                    </select>
                </div>
            </div>
        </div>
{{--        <div class="col-lg-6 col-sm-12 mb-3">--}}
{{--            <div class="row">--}}
{{--                <label for="pla_liquidacion"--}}
{{--                       class="col-md-12 col-sm-12 col-lg-4 control-label text-sm-left text-lg-right">Liquidacion</label>--}}
{{--                <div class="col-md-12 col-lg-6">--}}
{{--                    <input type="checkbox" name="pla_liquidacion" id="pla_liquidacion" value="0" data-bootstrap-switch--}}
{{--                           data-off-color="danger"--}}
{{--                           data-on-color="success" data-on-text="SI" data-off-text="NO">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</fieldset>
