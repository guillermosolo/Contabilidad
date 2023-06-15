@extends("layout.layout")

@section("titulo")
    Transferencias de Terceros
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
    <script src="{{asset("assets/pages/scripts/cxc/nabono/crear1.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
    <script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cxc/nabono\orden.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cyb/bancos/cuentasbancarias/table.js")}}" type="text/javascript"></script>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('chequedeter') }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/bancos/transferencias/de-terceros')}}">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Lista de transferencias<small></small></h3>
                            <div class="card-tools">
                                @can('crear cyb/bancos/transferencias/de-terceros')
                                    <a href="{{route('chequedeter.crear')}}" class="btn btn-block btn-success btn-sm">
                                        Nueva Transferencia<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                @else
                                    <a href="{{route('chequedeter.crear')}}" class="btn btn-block btn-success btn-sm disabled">
                                        Nueva Transferencia<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                @endcan
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
                                        <th scope="col">Documento Referencial</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Monto</th>
                                        <th scope="col">Tipo de Transacción</th>
                                    </thead>
                                    <tbody>
                                        @foreach($deterceros as $terceros)
                                            <tr>
                                                <td scope="row">{{$terceros['trab_id']}}</td>
                                                <td>{{$terceros->CuentadeBanco->ctab_numero}}</td>
                                                <td>{{$terceros['trab_fecha']}}</td>
                                                <td>{{$terceros['trab_documento']}}</td>
                                                <td>{{$terceros['trab_descripcion']}}</td>
                                                <td>{{Str::money($terceros['trab_monto'],"Q ")}}</td>
                                                <td>@if($terceros->trab_conciliado ==0)
                                                        No&nbspConciliado
                                                    @else Conciliado
                                                    @endif</td>
                                                <td>@if($terceros->trab_tipo=='DE')
                                                       Depósito
                                                    @else
                                                       Tranferencia
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
