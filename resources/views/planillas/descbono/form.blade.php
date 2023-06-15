<input type="hidden" id="ctaPath" value="{{url('contabilidad/ctaCuentaPorNivel')}}">
    <input type="hidden" id="cuentaContable" value="{{old('desc_cuentaContable')}}">

<fieldset class="border p-2 col-sm-12 col-lg-12">
    <legend class="w-auto">{{$tipo=='D'?'Datos de descuento':'Datos de Bonificacion'}}</legend>
    <div class="form-group row">
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="desc_monto"
                       class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Monto</label>
                <div class="col-md-12 col-lg-7">
                    <input type="text" class="form-control" id="desc_monto" name="desc_monto"
                           onkeypress='return validaNumericos(event,"D",this.value);'
                           value="{{old('desc_monto')}}" required Step=".00001">
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="desc_general"
                       class="col-sm-12 col-lg-6 control-label text-sm-left text-lg-right">General</label>
                <div class="col-md-12 col-lg-6">
                    <input type="checkbox" name="desc_general" value="1" data-bootstrap-switch
                           data-off-color="danger"
                           data-on-color="success" data-on-text="SI" data-off-text="NO" checked>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="desc_inicio" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right">Inicio</label>
                <div class="input-group col-md-12 col-lg-7">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control" name="desc_inicio" id="desc_inicio"
                           value="{{old('desc_inicio', now()->format('d/m/Y'))}}"
                           required>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="desc_fin" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right">Fin</label>
                <div class="input-group col-md-12 col-lg-7">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control" name="desc_fin"  id="desc_fin"
                           value="{{old('desc_fin')}}">
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="prod_empresa"
                       class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Empresa</label>
                <div class="col-sm-12 col-lg-7">
                    <select id="desc_empresa" class="form-control select2" placeholder="Empresa"
                            required>
                        <option value=""></option>
                        @foreach (auth()->user()->Empresas as $item)
                            <option value="{{$item->emp_id}}" {{old('desc_empresa')==$item->emp_id ? 'selected':''}}>
                                {{$item->emp_siglas}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="desc_cuentaContable" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right requerido">Cuenta Contable</label>
                <div class="col-sm-12 col-lg-7">
                    <select id="desc_cuentaContable" name="desc_cuentaContable" class="form-control select2" placeholder="Cuenta Contable" required>
                    </select>
                    <div class="invalid-feedback">
                        Este campo es obligatorio.
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="prod_empresa"
                       class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Tipo {{$tipo=='D'?'Descuentos':'Bonificaciones'}}</label>
                <div class="col-sm-12 col-lg-7">
                    <select id="desc_tipo" name="desc_tipo" class="form-control select2" placeholder="Tipo {{$tipo=='D'?'Descuentos':'Bonificaciones'}}"
                            required>
                        @foreach ($tipodesc->getTipo($tipo) as $item)
                            <option value="{{$item->tipd_id}}" {{old('desc_tipo')==$item->tipd_id ? 'selected':''}} >{{$item->tipd_descripcion}}-{{$item->tipd_forma=='P'?'PORCENTUAL':"FIJO"}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</fieldset>
