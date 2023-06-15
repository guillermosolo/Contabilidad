<input type="hidden" id="empPath" value="{{url('parametros/terminal')}}">
<input type="hidden" id="cuentaContable" value="{{old('desc_cuentaContable')}}">
<input type="hidden" id="empCod" value="{{old('pla_empresa')}}">
<input type="hidden" id="terCod" value="{{old('pla_terminal')}}">
<fieldset class="border p-2 col-sm-12 col-lg-12">
    <legend class="w-auto">Datos de planilla</legend>

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
                <label for="pla_fecha" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right">Fecha</label>
                <div class="input-group col-md-12 col-lg-7">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                    </div>
                        <select id="pla_fecha" name="pla_fecha" class="form-control select2" placeholder="Seleccione la fecha" required>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{$i}}" {{number_format(now()->format('m'))==$i?'selected':null}}>{{Str::nombreMes($i)}}</option>
                            @endfor
                        </select>
                    <select id="pla_tipo_quincena" name="pla_tipo_quincena" class="form-control select2" placeholder="Seleccione la fecha" required>
                        <option value="0" >Inicio</option>
                        <option value="1" >Fin</option>
                    </select>
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
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="pla_tipo"
                       class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Tipo</label>
                <div class="col-sm-12 col-lg-7">
                    <select id="pla_tipo" name="pla_tipo" class="form-control select2" placeholder="Tipo" required>

                        @if($tipo==='M')
                            <option value="O">ORDINARIA</option>
                        @else
                            <option value="E" {{old('pla_tipo')=="E" ? 'selected':''}}>EVENTUAL</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="pla_liquidacion"
                       class="col-md-12 col-sm-12 col-lg-3 control-label text-sm-left text-lg-right">Liquidacion</label>
                <div class="col-md-12 col-lg-6">
                    <input type="checkbox" name="pla_liquidacion" id="pla_liquidacion" value="0" data-bootstrap-switch
                           data-off-color="danger"
                           data-on-color="success" data-on-text="SI" data-off-text="NO">
                </div>
            </div>
        </div>
    </div>
</fieldset>
