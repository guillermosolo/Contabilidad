<input type="hidden" id="empPath" value="{{url('parametros/terminal')}}">
<input type="hidden" id="empCod" value="{{old('empresa')}}">
<input type="hidden" id="terCod" value="{{old('terminal')}}">
<input type="hidden" id="empleadoPath" value="{{url('planillas/empleados/get')}}">
<fieldset class="border p-2 col-sm-12 col-lg-12">
    <legend class="w-auto">Informacion de descuento</legend>
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
                <label for="dee_empleado" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Empleado </label>
                <div class="col-sm-12 col-lg-7">
                    <select id="dee_empleado" name="dee_empleado" class="form-control select2" placeholder="Empleado" required>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="dee_fecha" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right">Fecha</label>
                <div class="input-group col-md-12 col-lg-7">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control" name="dee_fecha" id="dee_fecha" value="{{old('dee_fecha')}}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="dee_monto" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right">Monto</label>
                <div class="input-group col-md-12 col-lg-7">
                    <input type="text" class="form-control" name="dee_monto" id="dee_monto" value="{{old('dee_monto')}}" required onkeypress='return validaNumericos(event,"D",this.value);'>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="dee_saldo" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right">Total</label>
                <div class="input-group col-md-12 col-lg-7">
                    <input type="text" class="form-control" name="dee_saldo" id="dee_saldo" value="{{old('dee_saldo')}}" required onkeypress='return validaNumericos(event,"D",this.value);'>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="dee_observaciones" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right">Observaciones</label>
                <div class="input-group col-md-12 col-lg-7">
                    <input type="text" class="form-control" name="dee_observaciones" id="dee_observaciones" value="{{old('observaciones')}}" required maxlength="100">
                </div>
            </div>
        </div>
    </div>
</fieldset>
