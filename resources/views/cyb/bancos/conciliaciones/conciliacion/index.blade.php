@extends("layout.layout")

@section("titulo")
    Conciliaciones
@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
@endsection

@section('scripts')
    <script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
    <script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cyb/bancos/cuentasbancarias/table.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/pages/scripts/cyb/fechasAbajo.js")}}" type="text/javascript"></script>
@endsection

@section("scriptPlugins")
    <script src="{{asset("assets/plugins/datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}"></script>
@endsection


@section('breadcrumbs')
    {{ Breadcrumbs::render('conciliaciones') }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/bancos/conciliaciones')}}">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Conciliaciones Generadas<small></small></h3>
                            <div class="card-tools">
                                @can('crear cyb/bancos/conciliaciones')
                                <a href="{{route('conciliaciones.crear')}}" class="btn btn-block btn-success btn-sm">
                                    Nueva Conciliación<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                @else
                                    <a href="{{route('conciliaciones.crear')}}" class="btn btn-block btn-success btn-sm disabled">
                                        Nueva Conciliación<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                @endcan

                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('liquidpdf')}}" id="form-general" class="form-horizontal" method="get">
                                <div class="form-group row">
                                    @csrf
                                    <label for="per_nit" class="col-sm-12 col-lg-2 control-label ext-sm-right text-lg-right requerido">Imprimir Desde</label>
                                    <div class="input-group col-sm-12 col-lg-2">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputfechareferencia">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                        </div>
                                        <input type="search" class="form-control float-right" id="inputfecha" name="search" required>
                                    </div>
                                    <label for="per_nit" class="col-sm-12 col-lg-1 control-label text-sm-right text-lg-right requerido">Hasta</label>
                                    <div class="input-group col-sm-12 col-lg-2">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputfechareferencia">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                        </div>
                                        <input type="search" class="form-control float-right" id="inputfecha2" name="search2" required>
                                    </div>
                                    <div class="card-tools">
                                        <button type="submit "class="btn btn-outline-danger">Imprimir Conciliados<i class="far fa-file-pdf pl-1"></i></button>
                                    </div>
                                </div>
                            </form>
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
                                        <th scope="col">Estadode Conciliación</th>
                                    </thead>
                                    <tbody>
                                    @foreach($transacciones as $transaccion)
                                        <tr>
                                            <td>{{$transaccion['trab_id']}}</td>
                                            <td>{{$transaccion->CuentadeBanco->ctab_numero}}</td>
                                            <td>{{$transaccion['trab_fecha']}}</td>
                                            <td>{{$transaccion['trab_documento']}}</td>
                                            <td>@if($transaccion['trab_tipo']=='MD')
                                                    Movimiento de Débito
                                            @elseif($transaccion['trab_tipo']=='MC')
                                                Movimiento de Credito
                                                @elseif($transaccion['trab_tipo']=='CH')
                                                    Cheque
                                                @elseif($transaccion['trab_tipo']=='TR')
                                                    Transferencia a Relacionados
                                                @elseif($transaccion['trab_tipo']=='TI')
                                                    Transferencia Interna
                                                @elseif($transaccion['trab_tipo']=='TA')
                                                    Transferencia a Terceros
                                                @elseif($transaccion['trab_tipo']=='TD')
                                                    Transferencia de Terceros
                                                @elseif($transaccion['trab_tipo']=='DE')
                                                    Depósitos de Terceros
                                            @endif
                                            </td>
                                            <td>{{$transaccion['trab_descripcion']}}</td>
                                            <td>{{$transaccion['trab_monto']}}</td>
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
