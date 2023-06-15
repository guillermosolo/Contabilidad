@extends("layout.layout")

@section("titulo")
    Débitos
@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
@endsection

@section("titulo")
    Listado de Débitos
@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
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
    {{ Breadcrumbs::render('debito') }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/bancos/debitos')}}">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Lista de Transferencias<small></small></h3>
                            <div class="card-tools">
                                @can('crear cyb/bancos/debitos')
                                    <a href="{{route('debito.crear')}}" class="btn btn-block btn-success btn-sm">
                                        Generar Débito<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                @else
                                    <a href="" class="btn btn-block btn-success btn-sm disabled">
                                        Generar Débito<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                @endcan
                            </div>
                        </div>
                        <br>
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
                                        <th scope="col">Estado&nbspde Conciliación</th>
                                    </thead>
                                    <tbody>
                                    @foreach($transacciones as $transaccion)
                                        <tr>
                                            <td>{{$transaccion['trab_id']}}</td>
                                            <td>{{$transaccion->CuentadeBanco->ctab_numero}}</td>
                                            <td>{{$transaccion['trab_fecha']}}</td>
                                            <td>{{$transaccion['trab_documento']}}</td>
                                            <td>@if($transaccion['trab_tipo']=='MD')
                                            Movimiento</td>
                                            @endif
                                            <td>{{$transaccion['trab_descripcion']}}</td>
                                            <td>{{Str::money($transaccion['trab_monto'],"Q ")}}</td>
                                            <td>@if($transaccion['trab_conciliado']==0)
                                            No conciliado
                                            @else
                                                    Conciliado
                                            @endif
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
