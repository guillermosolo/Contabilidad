@extends("layout.layout")
@section("titulo")
    Caja Chica
@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
    <style>
        select[readonly] ~ .select2.select2-container .selection [role="combobox"] {
            background: repeating-linear-gradient(135deg, #dadada, #dadada 10px, rgba(255, 255, 255, 0.66) 10px, rgba(255, 255, 255, 0.66) 20px) !important;
            box-shadow: inset 0 0 0px 1px #77859133;
        }
    </style>
@endsection

@section('scripts')
    <script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
    <script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cyb/cajas/detalle/creardetalle.js")}}" type="text/javascript"></script>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('detalle.crear',$liquidacioness->lcc_id) }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/cajas/responsables')}}">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Detalle de Liquidación<small></small></h3>
                            <div class="card-tools">
                                <a href="{{route('liquidacion')}}" class="btn btn-block btn-info btn-sm">
                                    Lista de Liquidaciones<i class="fas fa-arrow-circle-left pl-1"></i></a>
                            </div>
                        </div>

                        <form action="{{route('detalle.guardar',['id'=>$liquidacioness->lcc_id])}}" id="form-general"
                              class="form-horizontal" method="post">
                            <input type="hidden" id="empPath" value="{{url('parametros/terminal')}}">
                            <input type="hidden" id="codigoterminal" value="{{old('dlcc_terminal')}}">
                            <input type="hidden" id="empleadoPath" value="{{url('planillas/empleados/get')}}">
                            <input type="hidden" name="dlcc_empresa" id="empCod" value="{{$empresas->emp_id}}">
                            <input type="hidden" id="cuentaContable" value="{{old('dlcc_tipogasto')}}">
                            <input type="hidden" id="ctaPath" value="{{url('contabilidad/ctaCuentaPorNivel')}}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="per_nit"
                                           class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Liquidacion
                                        Escogida</label>
                                    <div class="col-sm-12 col-lg-10">
                                        <input name="dlcc_idcc" type="text" class="form-control" id="exampleInputEmail1"
                                               aria-describedby="emailHelp" maxlengt="25"
                                               required value="{{$liquidacioness->lcc_id}}" hidden readonly>
                                        <input type="text" class="form-control hidden" id="exampleInputEmail1"
                                               aria-describedby="emailHelp" maxlengt="25"
                                               required
                                               value="{{$liquidacioness->lcc_descripcion}} - De la caja chica: {{$liquidacioness->Cajas->cch_nombre}}, {{$liquidacioness->Cajas->cch_empresa}}"
                                               readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="act_fechaAlta"
                                           class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Fecha
                                        de Referencia</label>
                                    <div class="input-group col-sm-12 col-lg-3">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputfechareferencia">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="inputfecha"
                                               name="dlcc_fecha"
                                               value="{{old('dlcc_fecha')}}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="per_nit"
                                           class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Proveedor</label>
                                    <div class="col-sm-12 col-lg-4">
                                        <select name="dlcc_proveedor" class="form-control select2" id="inputproveedor"
                                                required>
                                            <option value="">Seleccione un Proveedor</option>
                                            @if(count($proveedores))
                                                @foreach($proveedores as $proveedor)
                                                    <option
                                                        value="{{$proveedor['pro_id']}}">{{$proveedor->Persona->per_nombre}}</option>
                                                @endforeach
                                            @else
                                                <option value="">No se encontraron resultados
                                            @endif
                                        </select>
                                    </div>
                                    <label for="per_nit"
                                           class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Tipo
                                        de Documento</label>
                                    <div class="col-sm-12 col-lg-4">
                                        <select name="dlcc_tipodoc" class="form-control select2"
                                                required>
                                            <option value="F">Factura</option>
                                            <option value="R">Recibo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="per_nit"
                                           class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Número de
                                        Serie</label>
                                    <div class="col-sm-12 col-lg-4">
                                        <input name="dlcc_seriedoc" value="{{old('dlcc_seriedoc')}}" type="text"
                                               style="text-transform: uppercase" class="form-control" id="inputserie"
                                               maxlengt="25" placeholder="Ingrese el número">
                                    </div>
                                    <label for="per_nit"
                                           class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Numero
                                        de Documento</label>
                                    <div class="col-sm-12 col-lg-4">
                                        <input name="dlcc_numerodoc" value="{{old('dlcc_numerodoc')}}" type="text"
                                               class="form-control" id="inputdocumento" maxlengt="25"
                                               placeholder="Ingrese el número">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="per_nit"
                                           class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Descripción</label>
                                    <div class="col-sm-12 col-lg-10">
                                        <textarea name="dlcc_descripcion" class="form-control"
                                                  placeholder="Escriba una descripción" id="inputdescripcion" rows="3"
                                                  required>{{old('dlcc_descripcion')}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="per_nit"
                                           class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Terminal</label>
                                    <div class="col-sm-12 col-lg-4">
                                        <select name="dlcc_terminal" class="form-control select2" id="id_teminal"
                                                required>
                                            <option>Seleccionel una terminal</option>
                                            @foreach((new \App\Http\Controllers\Parametros\TerminalController())->getTerminales($empresas->emp_id) as $terminal)
                                                <option
                                                    value="{{$terminal->ter_id}}"{{old('dlcc_terminal')==$terminal->ter_id ?'selected':''}}>{{$terminal->ter_nombre}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <label for="per_nit"
                                           class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Tipo
                                        de Gasto</label>
                                    <div class="col-sm-12 col-lg-4">
                                        <select name="dlcc_tipogasto" class="form-control select2"
                                                id="inputcuentacontable" required>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="per_nit"
                                           class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Monto</label>
                                    <div class="col-sm-12 col-lg-4">
                                        <input name="dlcc_monto" value="{{old('dlcc_monto')}}" type="text"
                                               class="form-control" id="tipomonto" maxlengt="25"
                                               placeholder="Ingrese el número" required>
                                    </div>
                                    <label for="per_nit"
                                           class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Agregar
                                        gasto de combustible</label>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="checkbox">
                                        <label class="custom-control-label" for="checkbox"></label>
                                    </div>
                                </div>
                                <div class="form-group row" id="combustible">
                                    <label for="per_nit"
                                           class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Galones</label>
                                    <div class="col-sm-12 col-lg-4">
                                        <input name="dlcc_galones" value="{{old('lcc_descripcion')}}" type="text"
                                               class="form-control" id="tipomonto" maxlengt="25"
                                               placeholder="Ingrese el número">
                                    </div>
                                    <label for="per_nit"
                                           class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Tipo
                                        de Combustible</label>
                                    <div class="col-sm-12 col-lg-4">
                                        <select name="dlcc_tipoCombustible" class="form-control select2"
                                                id="inputgasto">
                                            <option value="">Seleccione Combustible</option>
                                            @foreach($combustible as $combus)
                                                <option value="{{$combus->tco_id}}">{{$combus->tco_nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    @if($liquidacioness->lcc_pendiente == 0)
                                    <div class="col-lg-4 text-center">
                                        @include('includes.boton-form-crear')
                                    </div>
                                    @else
                                        <div class="col-lg-4 text-center">
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>¡No se pueden agregar detalles a una Liquidacion Finalizada!</strong>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tabla-data">
                                    @include('includes.form-error')
                                    @include('includes.mensaje')
                                    <thead class='thead-dark'>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Fecha&nbspde&nbspCreación</th>
                                        <th scope="col">Proveedor</th>
                                        <th scope="col">Tipo&nbspde&nbspDocumento</th>
                                        &nbsp
                                        <th scope="col">Serie</th>
                                        <th scope="col">Numero&nbspReferencial</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Gasto</th>
                                        <th scope="col">Monto</th>
                                        <th scope="col">Status</th>
                                    </thead>
                                    <tbody>
                                    @foreach($detalles as $detalle)
                                        <tr>
                                            <td>{{$detalle['dlcc_id']}}</td>
                                            <td>{{$detalle['dlcc_fecha']}}</td>
                                            <td>{{$detalle->ProveedorDetalle->Persona->per_nombre}}</td>
                                            <td>@if($detalle['dlcc_tipodoc']=='F')
                                                    Factura
                                                @else
                                                    Recibo
                                                @endif
                                            </td>
                                            <td>{{$detalle['dlcc_seriedoc']}}</td>
                                            <td>{{$detalle['dlcc_numerodoc']}}</td>
                                            <td>{{$detalle['dlcc_descripcion']}}</td>
                                            <td>{{$detalle->DetalleContable->cta_descripcion}}</td>
                                            <td>{{Str::money($detalle['dlcc_monto'],"Q ")}}</td>
                                            <td>@if($detalle['dlcc_status']=='P')
                                                    Pendiente
                                                @elseif($detalle['dlcc_status']=='R')
                                                    Rechazado
                                                @else
                                                    Liquidado
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

