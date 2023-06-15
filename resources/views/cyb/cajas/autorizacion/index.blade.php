@extends("layout.layout")

@section("titulo")
    Autorizaciones
@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet"
          type="text/css"/>
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
    <script src="{{asset("assets/pages/scripts/cyb/bancos/cuentasbancarias/table.js")}}"
            type="text/javascript"></script>
    <script src="{{asset("assets/pages/scripts/cyb/bancos/autorizacion/autorizar.js")}}"
            type="text/javascript"></script>
    <script src="{{asset("assets/pages/scripts/cyb/fechasAbajo.js")}}" type="text/javascript"></script>

@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('autorizar') }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/bancos/autorizacion')}}">
    @inject('detalle','App\Models\cyb\DetalleLiquidacionCC')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Autorizar Cajas Chicas<small></small></h3>
                            <div class="card-tools">
                                @can('ver cyb/cajas/responsables')
                                    <a href="{{route('cajachica')}}" class="btn btn-block btn-success btn-sm">
                                        Ver Cajas Chicas<i class="fas fa-arrow-circle-left pl-1"></i></a>
                                @else
                                    <a href="{{route('cajachica')}}" class="btn btn-block btn-success btn-sm disabled">
                                        Ver Cajas Chicas<i class="fas fa-arrow-circle-left pl-1"></i></a>
                                @endcan
                            </div>
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="autPath" value="{{url('cyb/bancos/autorizacion/liquidacion')}}">

                            <form action="{{route('cajaspdf')}}" id="form-general" class="form-horizontal" method="get">
                                <div class="form-group row">
                                    @csrf
                                    <label for="per_nit"
                                           class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-left requerido">Imprimir
                                        Desde</label>
                                    <div class="input-group col-sm-12 col-lg-3">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputfechareferencia">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                        </div>
                                        <input type="text" class="form-control fa-align-left" id="inputfecha"
                                               name="search" required>
                                    </div>
                                    <div class="card-tools">
                                        <button type="submit " class="btn btn-outline-danger">Imprimir Pendientes<i
                                                class="far fa-file-pdf pl-1"></i></button>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tabla-data">
                                    <thead class='thead-dark'>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Fecha de Inicio</th>
                                        <th scope="col">Caja Chica</th>
                                        <th scope="col">Estado</th>
                                        &nbsp
                                        <th scope="col">Total Detalles Liquidados</th>
                                        <th scope="col">Total Completos</th>
                                        <th scope="col">Revisión</th>
                                        <th scope="col">Autorizado</th>
                                    </thead>
                                    <tbody>
                                        @foreach($liquidacion as $liquid)
                                            <tr>
                                                <td scope="row">{{$liquid['lcc_id']}}</td>
                                                <td>{{$liquid['lcc_descripcion']}}</td>
                                                <td>{{$liquid['lcc_fecha']}}</td>
                                                <td>{{$liquid->Cajas->cch_nombre}}</td>
                                                <td id="{{$liquid['lcc_id']}}liquid">@if($liquid['lcc_pendiente'] == 0)
                                                        Pendiente - Activa
                                                    @else Liquidada - Terminada
                                                    @endif
                                                </td>
                                                <td>{{Str::money($detalle->totalDetallesCajas($liquid['lcc_id']),"Q ")}}</td>
                                                <td>{{Str::money($detalle->DetallesCompletos($liquid['lcc_id']),"Q ")}}</td>
                                                <td>
                                                    @can('actualizar cyb/bancos/autorizacion')
                                                        <a href="{{route('autorizar.detalles', ['id'=>$liquid['lcc_id']])}}"
                                                           class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                                           title="Ver detalles de Liquidación">
                                                            <i class="far fa-eye"></i></a>
                                                    @else
                                                        <a href=""
                                                           class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                                           title="Ver detalles de Liquidación">
                                                            <i class="far fa-eye"></i></a>
                                                    @endcan</td>
                                                @can('actualizar cyb/bancos/autorizacion')
                                                    <td align="center">
                                                        <div class="icheck-midnightblue d-inline">
                                                            <input type="checkbox" id="{{$liquid['lcc_id']}}checkbox"
                                                                   value="0" @if($liquid['lcc_pendiente']==1) checked
                                                                   @endif onclick="liquidar({{$liquid['lcc_id']}})">
                                                            <label for="{{$liquid['lcc_id']}}checkbox">
                                                            </label>
                                                        </div>
                                                    </td>
                                                @else
                                                    <td align="center">
                                                        <div class="icheck-midnightblue d-inline disabled">
                                                            <input type="checkbox" id="" value="0"
                                                                   @if($liquid['lcc_pendiente']==1) checked @endif">
                                                            <label for="">
                                                            </label>
                                                        </div>
                                                    </td>
                                                @endcan
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

