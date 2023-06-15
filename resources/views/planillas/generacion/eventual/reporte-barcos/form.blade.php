<input type="hidden" id="empPath" value="{{url('parametros/terminal')}}">
<input type="hidden" id="empCod" value="{{old('retb_empresa')}}">
<input type="hidden" id="terCod" value="{{old('retb_terminal')}}">
<input type="hidden" id="empleadoCod" value="{{old('retb_empleado')}}">

<input type="hidden" id="planillaCod" value="{{old('retb_planilla')}}">
<input type="hidden" id="planillaPath" value="{{url('planillas/generacion/eventual/get/barcos')}}">
<input type="hidden" id="empleadoPath" value="{{url('planillas/empleados/get')}}">


<fieldset class="border p-2 col-sm-12 col-lg-12">
    <legend class="w-auto">Datos del Reporte</legend>
    <div class="form-group row">
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="retb_empresa"
                       class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Empresa</label>
                <div class="col-sm-12 col-lg-7">
                    <select id="retb_empresa" name="retb_empresa" class="form-control select2" placeholder="Empresa"
                            required>
                        <option value=""></option>
                        @foreach (auth()->user()->Empresas as $item)
                            <option value="{{$item->emp_id}}" {{old('retb_empresa')==$item->emp_id ? 'selected':''}}>
                                {{$item->emp_siglas}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="retb_terminal" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right requerido">Terminal</label>
                <div class="col-sm-12 col-lg-7">
                    <select id="retb_terminal" name="retb_terminal" class="form-control select2" placeholder="Terminal"
                            required>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="retb_fecha" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Fecha</label>
                <div class="input-group col-md-12 col-lg-7">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control" name="retb_fecha" id="retb_fecha"
                           value="{{old('retb_fecha', now()->format('d/m/Y'))}}"
                           required>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="retb_planilla" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right requerido">Planillas</label>
                <div class="col-sm-12 col-lg-7">
                    <select  id="retb_planilla" class="form-control select2" placeholder="Planillas" name="retb_planilla" required>
                        <option value=""></option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</fieldset>
<fieldset class="border p-2 col-sm-12 col-lg-12">
    <legend class="w-auto">Informacion de empleados</legend>
    <div class="form-group row">
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="retb_empleado" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Empleado </label>
                <div class="col-sm-12 col-lg-7">
                    <select id="retb_empleado" name="retb_empleado" class="select2 form-control" placeholder="Empleado"
                            required>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="retb_turnos" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right">Turnos</label>
                <div class="input-group col-md-12 col-lg-7">
                    <input type="text" class="form-control" name="retb_turnos" id="retb_turnos"
                           value="{{old('retb_turnos')}}" required
                           onkeypress='return validaNumericos(event,"N",this.value);'>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="retb_extras" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right">Horas
                    Extras</label>
                <div class="input-group col-md-12 col-lg-7">
                    <input type="text" class="form-control" name="retb_extras" id="retb_extras"
                           value="{{old('retb_extras')}}"
                           onkeypress='return validaNumericos(event,"N",this.value);'>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="retb_ordinales" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right">Horas
                    Ordinales</label>
                <div class="input-group col-md-12 col-lg-7">
                    <input type="text" class="form-control" name="retb_ordinales" id="retb_ordinales"
                           value="{{old('retb_ordinales')}}"
                           onkeypress='return validaNumericos(event,"N",this.value);'>
                </div>
            </div>
        </div>

    </div>
</fieldset>
