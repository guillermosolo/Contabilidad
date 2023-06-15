@extends("layout.layout")

@section("titulo")
    Transferencias a Terceros
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
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('chequeater') }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/bancos/transferencias/a-terceros')}}">

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
                                @can('crear cyb/bancos/transferencias/a-terceros')
                                    <a href="{{route('chequeater.crear','#')}}" class="btn btn-block btn-success btn-sm">
                                        Nueva Transferencia<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                @else
                                    <a href="{{route('chequeater.crear','#')}}" class="btn btn-block btn-success btn-sm disabled">
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
                                        <th scope="col">Cuentas&nbspBancarias</th>
                                        <th scope="col">Número&nbspReferencial</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Beneficiario</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Negociable</th>
                                        <th scope="col">Tipo&nbspde&nbspTransacción</th>
                                        <th scope="col">Cambio</th>
                                        <th scope="col">Imprimir&nbspCheque</th>
                                    </thead>
                                    <tbody>
                                    @foreach($aterceros as $terceros)
                                        <tr>
                                            <td scope="row">{{$terceros['che_id']}}</td>
                                            <td>{{$terceros->CuentasBancarias->ctab_numero}}</td>
                                            <td>{{$terceros['che_numero']}}</td>
                                            <td>{{$terceros['che_fecha']}}</td>
                                            <td>{{Str::money($terceros['che_monto'],"Q ")}}</td>
                                            <td>{{$terceros['che_beneficiario']}}</td>
                                            <td>{{$terceros['che_descripcion']}}</td>
                                            <td>@if($terceros->che_negociable ==0)
                                            No&nbspnegociable
                                                @else Negociable
                                            @endif</td>
                                            <td>@if($terceros->che_tipo=='CH')
                                                    Cheque
                                                @else
                                                    Transferencia Bancaria
                                                @endif
                                            </td>
                                            <td>{{Str::money($terceros['che_tc'],"Q ")}}</td>
                                            <td>
                                                @if($terceros->che_tipo=='CA')
                                                    @can('ver cyb/bancos/transferencias/a-terceros')
                                                        <a href="{{route('chequepdf', ['tipo'=>$terceros->CuentasBancarias->ctab_banco,'id'=> $terceros['che_id']])}}"
                                                           class="btn-accion-tabla mr-4 align-content-center" data-toggle="tooltip" target="blank"
                                                           title="Imprimir Cheque">
                                                            <i class="fas fa-print"></i></a>
                                                    @else
                                                        <a href=""
                                                           class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                                           title="Imprimir Cheque">
                                                            <i class="fas fa-print"></i></a>
                                                    @endcan
                                                @else
                                                    <a class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                                       title="El Registro no es un Cheque">
                                                        <i class="fas fa-ban"></i></a>
                                                @endif
                                                    @can('eliminar cyb/bancos/transferencias/a-terceros')
                                                        <a href="{{route('eliminarTranferencias', ['id'=>$terceros->che_id])}}"
                                                           class="btn-accion-tabla eliminar-registro" data-toggle="tooltip"
                                                           title="Eliminar este registro" hidden>
                                                            <i class="text-danger far fa-trash-alt"></i></a>
                                                    @else
                                                        <a href=""
                                                           class="btn-accion-tabla eliminar-registro" data-toggle="tooltip"
                                                           title="Eliminar este registro" hidden>
                                                            <i class="text-danger far fa-trash-alt"></i></a>
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

