<input type="hidden" id="empPath" value="{{url('parametros/terminal')}}">
<input type="hidden" id="empCod" value="{{old('empresa')}}">
<input type="hidden" id="terCod" value="{{old('terminal')}}">
<input type="hidden" id="empleadoPath" value="{{url('planillas/empleados/get')}}">

<fieldset class="border p-2 col-sm-12 col-lg-12">
    <legend class="w-auto">Datos de generacion</legend>
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
    </div>

</fieldset>
