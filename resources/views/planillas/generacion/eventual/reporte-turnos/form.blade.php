<input type="hidden" id="empPath" value="{{url('parametros/terminal')}}">
<input type="hidden" id="empCod" value="{{old('rept_empresa')}}">
<input type="hidden" id="terCod" value="{{old('rept_terminal')}}">
<input type="hidden" id="planillaCod" value="{{old('rept_planilla')}}">
<input type="hidden" id="planillaPath" value="{{url('planillas/generacion/eventual/get/turnos')}}">


<fieldset class="border p-2 col-sm-12 col-lg-12">
    <legend class="w-auto">Datos del Reporte</legend>
    <div class="form-group row">
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="rept_empresa"
                       class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Empresa</label>
                <div class="col-sm-12 col-lg-7">
                    <select id="rept_empresa" name="rept_empresa" class="form-control select2" placeholder="Empresa"
                            required>
                        <option value=""></option>
                        @foreach (auth()->user()->Empresas as $item)
                            <option value="{{$item->emp_id}}" {{old('rept_empresa')==$item->emp_id ? 'selected':''}}>
                                {{$item->emp_siglas}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="rept_terminal" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right requerido">Terminal</label>
                <div class="col-sm-12 col-lg-7">
                    <select id="rept_terminal" name="rept_terminal" class="form-control select2" placeholder="Terminal"
                            required>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="rept_fecha" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Fecha</label>
                <div class="input-group col-md-12 col-lg-7">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control" name="rept_fecha" id="rept_fecha"
                           value="{{old('rept_fecha', now()->format('d/m/Y'))}}"
                           required>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="rept_nombreBuque" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right">Nombre
                    de Buque</label>
                <div class="col-md-12 col-lg-7">
                    <input type="text" class="form-control" id="rept_nombreBuque" name="rept_nombreBuque" maxlength="50"
                           value="{{old('rept_nombreBuque')}}">
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="rept_turno"
                       class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Turno</label>
                <div class="col-md-12 col-lg-7">
                    <input type="text" class="form-control" id="rept_turno" name="rept_turno" maxlength="5"
                           onkeypress='return validaNumericos(event,"N",this.value);'
                           value="{{old('rept_turno')}}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="rept_bodegas" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right requerido">Bodegas</label>
                <div class="col-md-12 col-lg-7">
                    <input type="text" class="form-control" id="rept_bodegas" name="rept_bodegas" maxlength="50"
                           value="{{old('rept_bodegas')}}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="rept_inicio" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Inicio</label>
                <div class="input-group col-md-12 col-lg-7">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                    </div>
                    <input type="time" class="form-control" name="rept_inicio"
                           value="{{old('rept_inicio')}}" required >
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="rept_fin" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right requerido">Fin</label>
                <div class="input-group col-md-12 col-lg-7">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>

                    </div>
                    <input class="form-control" name="rept_fin" type="time"
                           value="{{old('rept_fin')}}" required>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="rept_produccion"
                       class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Produccion</label>
                <div class="col-md-12 col-lg-7">
                    <input type="text" class="form-control" id="rept_produccion" name="rept_produccion" maxlength="10" step=".01"
                           onkeypress='return validaNumericos(event,"D",this.value);'
                           value="{{old('rept_produccion')}}" required>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="rept_planilla" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right requerido">Planillas</label>
                <div class="col-sm-12 col-lg-7">
                    <select  id="rept_planilla" class="form-control select2" placeholder="Planillas" name="rept_planilla" required>
                        <option value=""></option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</fieldset>
