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
    <script src="{{asset("assets/pages/scripts/cxc/nabono\orden.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cyb/bancos/cuentasbancarias/table.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/pages/scripts/cyb/bancos/autorizacion/autorizar.js")}}" type="text/javascript"></script>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('autorizar')}}
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
                                    <a href="{{route('autorizar')}}" class="btn btn-block btn-info btn-sm">
                                        Volver al listado<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                            </div>

                        </div>
                        <div class="card-body">
                                <input type="hidden" id="autPath" value="{{url('cyb/bancos/autorizacion/revision')}}">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tabla-data">
                                    <thead class='thead-dark'>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Proveedor</th>
                                        <th scope="col">Documento</th>&nbsp
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Terminal</th>
                                        <th scope="col">Gasto</th>
                                        <th scope="col">Monto</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Autorizar</th>
                                        <th scope="col">Rechazar</th>
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
                                            <td>{{$detalle['dlcc_descripcion']}}</td>
                                            <td>{{$detalle->DetalleTerminal->ter_nombre}}</td>
                                            <td>{{$detalle->DetalleContable->cta_descripcion}}</td>
                                            <td>{{Str::money($detalle['dlcc_monto'], "Q ")}}</td>
                                            <td id="{{$detalle['dlcc_id']}}status">{{$detalle['dlcc_status']=='P'? 'Pendiente':($detalle['dlcc_status']== 'L'? 'Liquidado': 'Rechazado')}}</td>

                                            <td align="center">
                                                <div class="icheck-green  @if($nombre->lcc_pendiente== 1) disabled @endif">
                                                    <input type="checkbox" id="{{$detalle['dlcc_id']}}L" value="0" @if($detalle['dlcc_status']=='L') checked @endif onclick="autorizar({{$detalle['dlcc_id']}})">
                                                    <label for="{{$detalle['dlcc_id']}}L">
                                                    </label>
                                                </div>
                                            </td>
                                            <td align="center">
                                                <div class="icheck-red @if($nombre->lcc_pendiente== 1) disabled @endif">
                                                    <input type="checkbox" id="{{$detalle['dlcc_id']}}R" value="0" @if($detalle['dlcc_status']=='R') checked @endif onclick="rechazar({{$detalle['dlcc_id']}})">
                                                    <label for="{{$detalle['dlcc_id']}}R">
                                                    </label>
                                                </div>
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

