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
    {{ Breadcrumbs::render('liquidacion') }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/cajas/responsables')}}">
    @inject('empleado','App\Models\Planilla\Empleado')
    @inject('detalle','App\Models\cyb\DetalleLiquidacionCC')
    <section class="content">
            <div class="container-fluid">
                    <div class="row">
                            <div class="col-lg-12">
                                    @include('includes.mensaje')
                                    @include('includes.form-error')
                                    <div class="card card-outline card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Liquidaciones de Cajas Chicas<small></small></h3>
                                            <div class="card-tools">
                                                @can('crear cyb/cajas/liquidaciones')
                                                    <a href="{{route('liquidacion.crear')}}" class="btn btn-block btn-success btn-sm">
                                                        Nueva Liquidación<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                                @else
                                                    <a href="" class="btn btn-block btn-success btn-sm disabled">
                                                        Nueva Liquidadión<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                                @endcan
                                            </div>

                                        </div>
                                            <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-hover" id="tabla-data">
                                                                <thead class='thead-dark'>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">Descripción</th>
                                                                    <th scope="col">Fecha de Inicio</th>
                                                                    <th scope="col">Caja Chica</th>
                                                                    <th scope="col">Estado</th>
                                                                    <th scope="col">Total Autorizado</th>
                                                                    <th scope="col">Total Completo</th>
                                                                    <th scope="col">Opciones</th>



                                                                </thead>
                                                                <tbody>
                                                                @foreach($liquidacion as $liquid)
                                                                    <tr>
                                                                        <td scope="row">{{$liquid['lcc_id']}}</td>
                                                                        <td>{{$liquid['lcc_descripcion']}}</td>
                                                                        <td>{{$liquid['lcc_fecha']}}</td>
                                                                        <td>{{$liquid->Cajas->cch_nombre}}</td>
                                                                        <td>@if($liquid['lcc_pendiente'] == 0) Pendiente - Activa
                                                                            @else Saldado
                                                                                @endif
                                                                            </td>
                                                                        <td>{{Str::money($detalle->totalDetallesCajas($liquid['lcc_id']),"Q ")}}</td>
                                                                        <td>{{Str::money($detalle->DetallesCompletos($liquid['lcc_id']),"Q ")}}</td>
                                                                        <td>
                                                                            @can('crear cyb/cajas/liquidaciones')
                                                                                <div class="form-group row">
                                                                                    <a href="{{route('detalle.crear', ['id'=>$liquid['lcc_id']])}}"
                                                                                       class="btn-accion-tabla mr-4 @if($liquid['lcc_pendiente']==1) disabled @endif" data-toggle="tooltip"
                                                                                       title="Agregar detalle de liquidación">
                                                                                        <i class="fas fa-plus-square"></i></a>
                                                                                    @can('eliminar cyb/cajas/liquidaciones')
                                                                                    <a href="{{route('liquidacion.eliminar', ['id'=>$liquid['lcc_id']])}}"
                                                                                       class="btn-accion-tabla eliminar-registro" data-toggle="tooltip"
                                                                                       title="Eliminar este registro">
                                                                                        @else
                                                                                            <a href="{{route('liquidacion.eliminar', ['id'=>$liquid['lcc_id']])}}"
                                                                                               class="btn-accion-tabla eliminar-registro disabled" data-toggle="tooltip"
                                                                                               title="Eliminar este registro">
                                                                                                @endcan
                                                                                        <i class="text-danger far fa-trash-alt"></i></a>&nbsp&nbsp&nbsp&nbsp&nbsp
                                                                                    <a href="{{route('detalle.lista', ['id'=>$liquid['lcc_id']])}}"
                                                                                       class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                                                                       title="Ver detalles de liquidación">
                                                                                        <i class="far fa-eye"></i></a>
                                                                                </div>
                                                                            @else
                                                                                <div class="form-group row">
                                                                                    <a href=""
                                                                                       class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                                                                       title="Agregar detalle de liquidación">
                                                                                        <i class="fas fa-plus-square"></i></a>
                                                                                <a href=""
                                                                                   class="btn-accion-tabla eliminar-registro disabled" data-toggle="tooltip"
                                                                                   title="Editar este registro">
                                                                                    <i class="text-danger far fa-trash-alt"></i></a>
                                                                            @endcan</td>
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

