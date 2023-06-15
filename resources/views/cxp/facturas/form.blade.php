<input type="hidden" id="empPath" value="{{url('parametros/terminal')}}">
<input type="hidden" id="ctaPath" value="{{url('contabilidad/ctaContable')}}">
<input type="hidden" id="ctaExcenta" value="{{url('contabilidad/ctaExcenta')}}">
<input type="hidden" id="actPath" value="{{url('activos/listaActivos')}}">
<input type="hidden" id="empCod" value="{{old('com_empresa',$data->com_empresa??'')}}">
<input type="hidden" id="terCod" value="{{old('com_terminal',$data->com_terminal??'')}}">
<input type="hidden" id="ctaCod" value="{{old('com_tipoGasto',$data->com_tipoGasto??'')}}">
<input type="hidden" name="nomProveedor" id="nomProveedor">
<input type="hidden" id="linea" value="0">
<section class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">

                    <label for="empresa"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Empresa</label>
                    <div class="col-sm-12 col-lg-2">
                        <input type= "text" name="empresa" id="empresa" class="form-control" placeholder="Empresa" required>
                        <datalist id="lst_empresa">
                            @foreach (auth()->user()->Empresas as $item)
                            <option value= "{{$item->emp_NIT}}" data-id="{{$item->emp_id}}" data-nombre="{{$item->emp_siglas}}"></option>
                            @endforeach
                        </datalist>
                        <input type="hidden" name="com_empresa" id="com_empresa" value="">
                    </div>
                    <div class="col-sm-12 col-lg-2">
                        <label id="nom_empresa" class="col-form-label-lg"></label>
                    </div>

                    <label for="com_terminal"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Terminal</label>
                    <div class="col-sm-12 col-lg-4">
                        <select name="com_terminal" id="com_terminal" class="form-control select2"
                            placeholder="Terminal" required>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="com_persona"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Proveedor</label>
                    <div class="col-sm-12 col-lg-4">
                        <select name="com_persona" id="com_persona" class="form-control select2" placeholder="Proveedor"
                            required>
                            @foreach ($pro->getProveedores() as $item)
                            <option value="{{$item->Persona->per_id}}" data-nombre="{{$item->Persona->per_nombre}}"
                                data-tipo="{{$item->Persona->per_tipoContribuyente}}"
                                {{old('com_persona',$data->com_persona ?? '') == $item->Persona->per_id ? 'selected':''}}>
                                {{$item->Persona->per_nit . " - " . $item->Persona->per_nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-12 col-lg-1">
                        <a class="btn btn-lg btn-outline-dark" id="proveedores" href="{{route('proveedores.crear','#')}}" data-toggle="tooltip"
                        title="Agregar nuevo proveedor">
                        <i class="fas fa-user-tie"></i></a>
                    </div>
                    <label class="col-sm-12 col-lg-1 control-label text-right">Activo/Gasto</label>
                    <div class="col-sm-12 col-lg-4">
                        <div class="icheck-midnightblue d-inline">
                            <input type="radio" id="facActivo" name="GastoActivo" value="A"
                                {{old('facActivo',$data->facActivo ?? '')=='A'?"checked":""}}>
                            <label for="facActivo" class="mr-5">Activo</label>
                        </div>
                        <div class="icheck-midnightblue d-inline">
                            <input type="radio" id="facGasto" name="GastoActivo" value="G"
                                {{old('facGasto',$data->facGasto ?? 'G')=='G'?"checked":""}}>
                            <label for="facGasto">Gasto</label>
                        </div>
                        <input type="hidden" name="com_monto" id="com_monto" class="form-control disabled" tabindex="-1"
                            placeholder="Monto">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="com_numDoc"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Número de
                        Documento</label>
                    <div class="col-sm-12 col-lg-4">
                        <input type="text" name="com_numDoc" id="com_numDoc" class="form-control"
                            placeholder="Número de Documento" value="{{old('com_numDoc',$data->com_numDoc??'')}}"
                            required>
                    </div>
                    <label for="com_serie"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Serie</label>
                    <div class="col-sm-12 col-lg-4">
                        <input type="text" name="com_serie" id="com_serie" class="form-control"
                            placeholder="Serie del Documento" value="{{old('com_serie',$data->com_serie??'')}}"
                            required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="com_descripcion"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Descripción</label>
                    <div class="col-sm-12 col-lg-9">
                        <input type="text" name="com_descripcion" id="com_descripcion" class="form-control"
                            placeholder="Descripción" minlength="25" value="{{old('com_descripcion',$data->com_descripcion??'')}}"
                            required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="com_tipo"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Clasificación</label>
                    <div class="col-sm-12 col-lg-2">
                        <select name="com_tipo" id="com_tipo" class="form-control select2" placeholder="Tipo" required>
                            @foreach ($tcom->gettipoCompra() as $item)
                            <option value="{{$item->tipc_id}}"
                                {{old('com_tipo',$data->com_tipo ?? '') == $item->tipc_id ? 'selected':''}}>
                                {{$item->tipc_descripcion}}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="com_fecha"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Fecha</label>
                    <div class="input-group col-sm-12 col-lg-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control float-right" id="com_fecha" name="com_fecha" required>
                    </div>

                    <label for="com_mesReportar"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Mes a
                        Reportar</label>
                    <div class="col-sm-12 col-lg-2">
                        <select name="com_mesReportar" id="com_mesReportar" class="form-control select2"
                            placeholder="Mes a Reportar" required>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-1 col-lg-none"></div>
                    <div class="col-sm-12 col-lg-1">
                        <div class="icheck-midnightblue d-inline">
                            <input type="checkbox" id="aplicaExcento" name="aplicaExcento" value=1>
                            <label for="aplicaExcento" class="text-sm-left">Monto Excento</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-3">
                        <input type="text" name="com_excento" id="com_excento" class="form-control" placeholder="Monto excento" onkeypress='return validaNumericos(event,"D",this.value);'>
                    </div>

                    <label for="com_ctaExcento"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Cuenta Excento</label>
                    <div class="col-sm-12 col-lg-4">
                        <select name="com_ctaExcento" id="com_ctaExcento" class="form-control select2" placeholder="Cuenta">

                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-1"></div>
                    <div class="col-sm-12 col-lg-2">
                        <div class="icheck-midnightblue d-inline">
                            <input type="checkbox" id="com_retencion" name="com_retencion" value=1
                                {{old('com_retencion',$data->com_retencion ?? '')=='1'?"checked":""}}>
                            <label for="com_retencion">Aplicar Retención ISR</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-2">
                        <div class="icheck-midnightblue d-inline">
                            <input type="checkbox" id="com_peqcontribuyente" name="com_peqcontribuyente" value=1
                                {{old('com_peqcontribuyente',$data->com_peqcontribuyente ?? '')=='1'?"checked":""}}>
                            <label for="com_peqcontribuyente">Pequeño Contribuyente</label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-2">
                        <div class="icheck-midnightblue d-inline">
                            <input type="checkbox" id="aplicaActivo" name="aplicaActivo" value=1>
                            <label for="aplicaActivo">Aplicar a Activo</label>
                        </div>
                    </div>

                    <label for="facturaActivo"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Activo</label>
                    <div class="col-sm-12 col-lg-3">
                        <select name="facturaActivo" id="facturaActivo" class="form-control select2"
                            placeholder="facturaActivo">

                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="numeroRetencion"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Número de
                        Constancia</label>
                    <div class="col-sm-12 col-lg-4">
                        <input type="text" name="numeroRetencion" id="numeroRetencion" class="form-control"
                            placeholder="Número de Constancia" onkeypress='return validaNumericos(event,"N",this.value);'>
                    </div>

                    <label for="fechaRetencion"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Fecha de la
                        Retención</label>
                    <div class="input-group col-sm-12 col-lg-3" id="gfechaRetencion">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control float-right" id="fechaRetencion" name="fechaRetencion">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-11">
                        <div class="form-group row">
                            <div class="col-sm-12 col-lg-4">
                                <label for="descripcion" class="control-label requerido">Artículo o Servicio</label>
                                <input type="text" id="descripcion" class="form-control" placeholder="Descripción">
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-2" id="alarma">
                                <label for="precioU" class="control-label requerido">Precio Unitario con IVA</label>
                                <input type="text" id="precioU" class="form-control" placeholder="Precio Unitario"
                                    onkeypress='return validaNumericos(event,"D",this.value);'>
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-2">
                                <label for="cantidad" class="control-label requerido">Cantidad</label>
                                <input type="text" id="cantidad" class="form-control" placeholder="Cantidad"
                                    onkeypress='return validaNumericos(event,"D",this.value);'>
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="tipoGasto" class="control-label requerido">Tipo de Gasto</label>
                                <select id="tipoGasto" class="form-control select2" placeholder="Tipo de Gasto">

                                </select>
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-lg-3">
                                <label for="tipoCombustible" class="control-label" style="display: none">Tipo de
                                    Combustible</label>
                                <select id="tipoCombustible" class="form-control select2"
                                    placeholder="Tipo de Combustible">
                                    <option value="0"></option>
                                    @foreach ($comb->getCombustibles() as $item)
                                    <option value="{{$item->tco_id}}" data-IDP="{{$item->tco_idp}}">
                                        {{$item->tco_nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-12 col-lg-2">
                                <label for="totalComb" class="control-label" style="display: none">Total</label>
                                <input type="text" id="totalComb" class="form-control" style="display: none"
                                    placeholder="Total" onkeypress='return validaNumericos(event,"D",this.value);'>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <button id="agregar" type="button" class="btn btn-lg btn-outline-success float-right"><i
                                class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-striped table-hover" id="tabla-data">
                        <thead class='thead-dark'>
                            <tr>
                                <th></th>
                                <th>Cantidad</th>
                                <th>Descripción</th>
                                <th>Precio Unitario</th>
                                <th>Total</th>
                                <th>Tipo de Gasto</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="detCompra">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
