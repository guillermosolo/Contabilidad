@extends("layout.layout")
@section("titulo")
    Liquidaciones
@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
@endsection

@section("scriptPlugins")
    <script src="{{asset("assets/plugins/datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}"></script>
@endsection

@section('scripts')
    <script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
    <script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cyb/bancos/cuentasbancarias/table.js")}}" type="text/javascript"></script>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('detalle.lista',$nombre->lcc_id) }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/cajas/responsables')}}">
    @inject('empleado','App\Models\Planilla\Empleado')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Detalles de la Liquidacion con código: <strong>{{$nombre->lcc_id}},</strong> llamada: <strong>{{$nombre->lcc_descripcion}}</strong><small></small></h3>
                            <div class="card-tools">
                                @can('crear cyb/cajas/liquidaciones')
                                    <a href="{{route('liquidacion')}}" class="btn btn-block btn-info btn-sm">
                                        Volver al Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                                @else
                                    <a href="" class="btn btn-block btn-info btn-sm disabled">
                                        Volver al Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                                @endcan
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <a href="{{route('dlccexcel',[$nombre->lcc_id])}}" class="btn btn btn-outline-success">Generar Excel<i class="far fa-file-excel pl-1"></i></a>
                                    <a href="{{route('pdfDetalleLiquidacion',[$nombre->lcc_id])}}" class="btn btn btn-outline-danger">Generar PDF<i class="far fa-file-pdf pl-1"></i></a>

                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tabla-data">
                                    <thead class='thead-dark'>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Fecha&nbspde&nbspCreación</th>
                                        <th scope="col">Proveedor</th>
                                        <th scope="col">Tipo&nbspde&nbspDocumento</th>&nbsp
                                        <th scope="col">Serie</th>
                                        <th scope="col">Numero&nbspReferencial</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Gasto</th>
                                        <th scope="col">Monto</th>
                                        <th scope="col">Galones</th>
                                        <th scope="col">Combustible</th>
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
                                            <td>{{$detalle['dlcc_galones']}}</td>
                                            <td>@if($detalle['dlcc_tipoCombustible']==null)
                                                @else
                                                    {{$detalle->NombreCombustible->tco_nombre}}
                                                @endif
                                            </td>
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
