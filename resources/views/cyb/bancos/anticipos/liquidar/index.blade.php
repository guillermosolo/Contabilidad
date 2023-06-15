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
    <script src="{{asset("assets/pages/scripts/cyb/bancos/autorizacion/antLiquidar.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/pages/scripts/cyb/fechasAbajo.js")}}" type="text/javascript"></script>


@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('liquidar') }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/bancos/anticipos/crear')}}">
    @inject('detalle','App\Models\cyb\DetalleAnticipo')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Liquidación de Anticipos<small></small></h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('anticipopdf')}}" id="form-general" class="form-horizontal" method="get">
                                <div class="form-group row">
                                    @csrf
                                    <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-left requerido">Imprimir Desde</label>
                                    <div class="input-group col-sm-12 col-lg-2">
                                        <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputfechareferencia">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                        </div>
                                        <input type="search" class="form-control float-right" id="inputfecha" name="search" required>
                                    </div>
                                    <div class="card-tools">
                                        <button type="submit "class="btn btn-outline-danger">Imprimir Anticipos<i class="far fa-file-pdf pl-1"></i></button>
                                    </div>

                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tabla-data" cellspacing="0" width="100%">
                                    <input type="hidden" id="autPath" value="{{url('cyb/bancos/anticipo/liquidar/anticipo')}}">

                                    <thead class='thead-dark'>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Número</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Cheque</th>
                                        <th scope="col">Proveedor</th>
                                        <th scope="col">Monto</th>
                                        <th scope="col">Total de Detalles </th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Revisión</th>
                                        <th scope="col">Liquidado</th>
                                    </thead>
                                    <tbody>
                                    @foreach($anticipos as $anticipo)
                                        <tr>
                                            <td scope="row">{{$anticipo['ant_id']}}</td>
                                            <td>{{$anticipo['ant_numero']}}</td>
                                            <td>{{$anticipo['ant_fecha']}}</td>
                                            <td>{{$anticipo->ChequeAnticipo->che_numero}}</td>
                                            <td>@if($anticipo['ant_proveedor']==null)
                                                    No Aplica
                                                @else
                                                    {{$anticipo->ProveedorAnticipo->Persona->per_nombre}}
                                                @endif
                                            </td>
                                            <td>{{Str::money($anticipo->ChequeAnticipo->che_monto,"Q ")}}</td>
                                            <td>{{$detalle->totalDetallesAnticipo($anticipo['ant_id'])}}</td>
                                            <td id="{{$anticipo['ant_id']}}anticipo">
                                                @if($anticipo['ant_liquidado']==0)
                                                    No Liquidado
                                                @else
                                                    Liquidado
                                                @endif</td>
                                            <td>
                                                @can('crear cyb/bancos/anticipos/liquidar')
                                                        <a href="{{route('liquidar.anticipos', ['id'=>$anticipo['ant_id']])}}"
                                                           class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                                           title="Detalles de Anticipo">
                                                            <i class="far fa-eye"></i></a>
                                                @else
                                                    <a href="{{route('liquidar.anticipos', ['id'=>$anticipo['ant_id']])}}"
                                                       class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                                       title="Detalles de Anticipo">
                                                        <i class="far fa-eye"></i></a>
                                                @endcan
                                            </td>
                                            @can('actualizar cyb/bancos/anticipos/liquidar')
                                            <td align="center">
                                                <div class="icheck-midnightblue d-inline">
                                                    <input type="checkbox" id="{{$anticipo['ant_id']}}A" value="0" @if($anticipo['ant_liquidado']==1) checked @endif onclick="antLiquidar({{$anticipo['ant_id']}})">
                                                    <label for="{{$anticipo['ant_id']}}A">
                                                    </label>
                                                </div>
                                            </td>
                                                @else
                                                <td align="center">
                                                    <div class="icheck-midnightblue d-inline">
                                                        <input type="checkbox" id="" disabled value="0" @if($anticipo['ant_liquidado']==1) checked @endif>
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
