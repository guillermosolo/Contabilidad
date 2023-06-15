@extends("layout.layout")
@section("titulo")
    Reporte de Turnos
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('reporte-turnos') }}
@endsection
@section("styles")
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">


@endsection
@section("scriptPlugins")
    <script src="{{asset("assets/plugins/datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
@endsection

@section("scripts")
    <script src="{{asset("assets/pages/scripts/planillas/generacion/eventual/reporteturnos/table.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
    @inject('empleado','App\Models\Planilla\Empleado')

    <input type="hidden" id="routepath" value="{{url('planillas/generacion/eventual')}}">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <span class="card-title col-lg-4"><small>Reporte de Turnos</small></span>
                            <form class="col-lg-4 my-lg-0 my-sm-3" method="GET" style="display: inline-block">
                                <div class="input-group col-12">
                                    <input value="{{$date}}"
                                           type="text" class="form-control" name="date" id="date">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit" id="myBtn"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                            <div class="col-lg-2 card-tools">
                                @can('crear planillas/generacion/eventual')
                                    <a href="{{route('reporte-turnos.crear')}}"
                                       class="btn btn-block btn-success btn-sm my-0 mx-2">
                                        Nuevo Registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                @else
                                    <a href="{{route('reporte-turnos.crear')}}"
                                       class="btn btn-block btn-success btn-sm disabled">
                                        Nuevo Registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                @endcan
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tabla-data" cellspacing="0"
                                       width="100%">
                                    <thead class='thead-dark'>
                                    <tr>
                                        <th>No.</th>
                                        <th>Fecha</th>
                                        <th>Buque</th>
                                        <th>Turno</th>
                                        <th>Bodegas</th>
                                        <th>Inicio</th>
                                        <th>Fin</th>
                                        <th>Produccion</th>
                                        <th>Terminal</th>
                                        <th>Empresa</th>
                                        <th>Acciones</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>{{$data->rept_id}}</td>
                                            <td>{{Carbon\Carbon::parse($data->rept_fecha)->format('d/m/Y')}}</td>
                                            <td>{{$data->rept_nombreBuque}}</td>
                                            <td>{{$data->rept_turno}}</td>
                                            <td>{{$data->rept_bodegas}}</td>
                                            <td>{{Carbon\Carbon::parse($data->rept_inicio)->format('H:i:s')}}</td>
                                            <td>{{Carbon\Carbon::parse($data->rept_fin)->format('H:i:s')}}</td>
                                            <td>{{$data->rept_produccion}}</td>
                                            <td>{{$data->Planilla->Empresa->emp_siglas}}</td>
                                            <td>{{$data->Planilla->Terminal->ter_abreviatura}}</td>
                                            <td>
                                                @can('crear planillas/generacion/eventual')
                                                    <a href="{{route('reporte-turnos.ver',['id'=> $data->rept_id])}}"
                                                       class="btn-accion-tabla" data-toggle="tooltip"
                                                       title="Ver reporte de turno">
                                                        <i class="far fa-eye"></i></a>
                                                @else
                                                    <a href="{{route('reporte-turnos.ver',['id'=> $data->rept_id])}}"
                                                       class="btn-accion-tabla disabled" data-toggle="tooltip"
                                                       title="Ver reporte de turno">
                                                        <i class="far fa-eye"></i></a>
                                                @endcan
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
