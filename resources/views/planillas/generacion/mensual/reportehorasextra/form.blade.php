<input type="hidden" id="empPath" value="{{url('parametros/terminal')}}">
<input type="hidden" id="empCod" value="{{old('empresa')}}">
<input type="hidden" id="terCod" value="{{old('terminal')}}">
<input type="hidden" id="empleadoPath" value="{{url('planillas/empleados/get')}}">

<fieldset class="border p-2 col-sm-12 col-lg-12">
    <legend class="w-auto">Informacion</legend>
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
                <label for="ree_empleado" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Empleado </label>
                <div class="col-sm-12 col-lg-7">
                    <select id="ree_empleado" name="ree_empleado" class="form-control select2" placeholder="Empleado" required>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="ree_fecha" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right">Fecha</label>
                <div class="input-group col-md-12 col-lg-7">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control" name="ree_fecha" id="ree_fecha" value="{{old('ree_fecha')}}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="ree_tipo" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Tipo Hora</label>
                <div class="col-sm-12 col-lg-7">
                    <select id="ree_tipo" name="ree_tipo" class="form-control select2" placeholder="Tipo Hora" required>
                        <option value="E">Extra</option>
                        <option value="O" >Ordinaria</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="ree_horas" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right">Horas</label>
                <div class="input-group col-md-12 col-lg-7">
                    <input type="text" class="form-control" name="ree_horas" id="ree_horas" value="{{old('ree_horas')}}"  onkeypress='return validaNumericos(event,"N",this.value);' required>
                </div>
            </div>
        </div>
    </div>
</fieldset>
