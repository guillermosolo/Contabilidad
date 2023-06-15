@extends("layout.layout")
@section("titulo")
    Detalles de Conciliación
@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
@endsection

@section('scripts')
    <script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
    <script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cxc/nabono\orden.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cyb/bancos/conciliaciones/validar.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js")}}"></script>
    <script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cyb/bancos/cuentasbancarias/table.js")}}" type="text/javascript"></script>
@endsection

@section("scriptPlugins")
    <script src="{{asset("assets/plugins/datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}"></script>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('conciliaciones.crear') }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/bancos/debitos')}}">
    <input type="hidden" id="authPath" value="{{url('cyb/bancos/autorizacion/autorizar')}}">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Transacciones<small></small></h3>
                            <div class="card-tools">
                                <a href="{{route('conciliaciones')}}" class="btn btn-block btn-info btn-sm">
                                    Volver a Conciliaciónes<i class="fas fa-arrow-circle-left pl-1"></i></a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tabla-data">
                                    <thead class='thead-dark'>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Cuenta Bancaria</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Documento</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Monto</th>
                                        <th scope="col">Estado de Conciliación</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($transacciones as $transaccion)
                                        <tr>
                                            <td>{{$transaccion->trab_id}}</td>
                                            <td>{{$transaccion->cuenta_bancaria}}</td>
                                            <td>{{$transaccion->fecha}}</td>
                                            <td>{{$transaccion->referencia}}</td>
                                            <td>@if($transaccion->trab_tipo=='MD')
                                                    Movimiento de Débito
                                                @elseif($transaccion->trab_tipo=='MC')
                                                    Movimiento de Credito
                                                @elseif($transaccion->trab_tipo=='CH')
                                                    Cheque
                                                @elseif($transaccion->trab_tipo=='TR')
                                                    Transferencia a Relacionados
                                                @elseif($transaccion->trab_tipo=='TI')
                                                    Transferencia Interna
                                                @elseif($transaccion->trab_tipo=='TA')
                                                    Transferencia a Terceros
                                                @elseif($transaccion->trab_tipo=='CA')
                                                    Cheque a Terceros
                                                @elseif($transaccion->trab_tipo=='TD')
                                                    Transferencia de Terceros
                                                @elseif($transaccion->trab_tipo=='DE')
                                                    Depósitos de Terceros
                                                @elseif($transaccion->trab_tipo=='DR')
                                                    Transferencia De Relacionados
                                                @endif
                                            </td>
                                            <td>{{$transaccion->concepto}}</td>
                                            <td>{{Str::money($transaccion->monto, "Q ")}}</td>
                                            <td id="{{$transaccion->trab_id}}status">@if($transaccion->dcon_conciliado==0)
                                                    No conciliado
                                                @else
                                                    Conciliado
                                                @endif</td>
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
