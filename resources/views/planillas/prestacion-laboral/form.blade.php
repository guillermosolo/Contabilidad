<input type="hidden" id="empPath" value="{{url('parametros/terminal')}}">
<input type="hidden" id="empCod" value="{{old('empresa')}}">
<input type="hidden" id="terCod" value="{{old('terminal')}}">
<input type="hidden" id="empleadoPath" value="{{url('planillas/empleados/get')}}">

<fieldset class="border p-2 col-sm-12 col-lg-12">
    <legend class="w-auto">Datos de prestacion laboral</legend>
    <div class="form-group row">
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empresa"
                       class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Empresa</label>
                <div class="col-sm-12 col-lg-7">
                    <select id="empresa"  class="form-control select2" placeholder="Empresa" name="empresa"
                            required>
                        <option value=""></option>

                        @foreach (auth()->user()->Empresas as $item)
                            <option value="{{$item->emp_id}}"  {{old('cons_empresa')==$item->emp_id ? 'selected':''}}>
                                {{$item->emp_siglas}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="terminal" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right requerido">Terminal</label>
                <div class="col-sm-12 col-lg-7">
                    <select  id="terminal" class="form-control select2" placeholder="Terminal" name="terminal" required>
                        <option value=""></option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="empleado" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Empleado </label>
                <div class="col-sm-12 col-lg-7">
                    <select id="empleado" name="empleado" class="form-control select2" placeholder="Empleado" required>

                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="fecha" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right">Fecha</label>
                <div class="input-group col-md-12 col-lg-7">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control" name="fecha" id="fecha"
                           value="{{old('cons_fecha', now()->format('d/m/Y'))}}"
                           required>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">

                <label for="vacaciones" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right">Dias de Vacaciones</label>
                <div class="input-group col-md-12 col-lg-7">
                    <input type="number" class="form-control" name="vacaciones"
                           value="0" step="0.01">
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="motivo" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right requerido">Motivo </label>
                <div class="col-sm-12 col-lg-7">
                    <select id="motivo" name="motivo" class="form-control select2" placeholder="Motivo" required>
                        <option value="1">Despido</option>
                        <option value="2">Renuncia</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="descuentos" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right">Descuento </label>
                <div class="col-sm-12 col-lg-7">
                    <input type="number" class="form-control" name="descuentos"
                           value="0" step="0.01">
                </div>
            </div>
        </div>
    </div>
</fieldset>
