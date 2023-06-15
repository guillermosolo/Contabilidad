@extends("layout.layout")

@section("titulo")
    Listado de Anticipos
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
    {{ Breadcrumbs::render('anticipos') }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/bancos/anticipos/crear')}}">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Anticipos generados<small></small></h3>
                            <div class="card-tools">
                                @can('crear cyb/bancos/anticipos/crear')
                                <a href="{{route('anticipos.crear')}}" class="btn btn-block btn-success btn-sm">
                                    Crear Nuevo Anticipo<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                @else
                                    <a href="{{route('anticipos.crear')}}" class="btn btn-block btn-success btn-sm disabled">
                                        Crear Nuevo Anticpo<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                @endcan

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tabla-data" cellspacing="0" width="100%">
                                    <thead class='thead-dark'>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Número</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Liquidado</th>
                                        <th scope="col">Cheque</th>
                                        <th scope="col">Monto</th>
                                        <th scope="col">Proveedor</th>
                                        <th scope="col">Opciones</th>

                                    </thead>
                                    <tbody>
                                    @foreach($anticipos as $anticipo)
                                            <tr>
                                                <td scope="row">{{$anticipo['ant_id']}}</td>
                                                <td>{{$anticipo['ant_numero']}}</td>
                                                <td>{{$anticipo['ant_fecha']}}</td>
                                                <td>@if($anticipo['ant_liquidado']==0)
                                                No Liquidado
                                                    @else
                                                Liquidado
                                                @endif</td>
                                                <td>{{$anticipo->ChequeAnticipo->che_numero}}</td>
                                                <td>{{Str::money($anticipo->ChequeAnticipo->che_monto,"Q ")}}</td>
                                                <td>@if($anticipo['ant_proveedor']==null)
                                                        No Aplica
                                                        @else
                                                        {{$anticipo->ProveedorAnticipo->Persona->per_nombre}}</td>
                                                @endif
                                                <td>
                                                    @can('crear cyb/bancos/anticipos/crear')
                                                        <div class="form-group row align-content-center">
                                                            <a href="{{route('anticipos.detalle', ['id'=>$anticipo['ant_id']])}}"
                                                               class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                                               title="Agregar detalle de liquidación">
                                                                <i class="fas fa-plus-square"></i></a>
                                                            <a href="{{route('anticipos.listadetalles', ['id'=>$anticipo['ant_id']])}}"
                                                               class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                                               title="Ver detalles de liquidación">
                                                                <i class="far fa-eye"></i></a>
                                                            <a href="{{route('chequepdf', ['tipo'=>$anticipo->ChequeAnticipo->CuentasBancarias->Banco->ban_id,'id'=> $anticipo->ChequeAnticipo->che_id])}}"
                                                               class="btn-accion-tabla mr-4 align-content-center" target="blank"data-toggle="tooltip"
                                                               title="Cheque de Talón">
                                                                <i class="fas fa-print" style="color:seagreen"></i></a>
                                                            <a href="{{route('chequepdf', ['tipo'=>$anticipo->ChequeAnticipo->CuentasBancarias->Banco->ban_id,'id'=> $anticipo->ChequeAnticipo->che_id])}}"
                                                               class="btn-accion-tabla align-content-center " target="blank"data-toggle="tooltip"
                                                               title="Cheque Voucher">
                                                                <i class="fas fa-print" style="color:black"></i></a>
                                                        </div>
                                                    @else
                                                        <div class="form-group row">
                                                        <a href="{{route('anticipos.detalle', ['id'=>$anticipo['ant_id']])}}"
                                                           class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                                           title="Agregar detalle de liquidación">
                                                            <i class="fas fa-plus-square"></i></a>
                                                        <a href="{{route('anticipos.listadetalles', ['id'=>$anticipo['ant_id']])}}"
                                                           class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                                           title="Ver detalles de liquidación">
                                                            <i class="far fa-eye"></i></a>
                                                    </div>
                                                        @endcan
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
