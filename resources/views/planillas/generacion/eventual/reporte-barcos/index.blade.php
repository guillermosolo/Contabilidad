@extends("layout.layout")
@section("titulo")
    Reporte de Barcos
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('reporte-barcos') }}
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
    <script src="{{asset("assets/pages/scripts/planillas/generacion/eventual/reportebarcos/table.js")}}" type="text/javascript"></script>
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
                            <span class="card-title col-lg-4"><small>Reporte de Barcos</small></span>
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
                                    <a href="{{route('reporte-barcos.crear')}}"
                                       class="btn btn-block btn-success btn-sm my-0 mx-2">
                                        Nuevo Registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                @else
                                    <a href="{{route('reporte-barcos.crear','#')}}"
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
                                            <th>Planilla</th>
                                            <th>Empleado</th>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th>Turnos</th>
                                            <th>Extras</th>
                                            <th>Ordinales</th>
                                            <th>Terminal</th>
                                            <th>Empresa</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($datas as $data)
                                            <tr>
                                                <td>{{$data->retb_id}}</td>
                                                <td>{{$data->retb_planilla}}</td>
                                                <td>{{strtoupper($empleado->getNombreCompleto($data->retb_empleado))}}</td>
                                                <td>{{Carbon\Carbon::parse($data->retb_inicio)->format('d/m/Y')}}</td>
                                                <td>{{Carbon\Carbon::parse($data->retb_fin)->format('d/m/Y')}}</td>
                                                <td>{{$data->retb_turnos}}</td>
                                                <td>{{$data->retb_extras}}</td>
                                                <td>{{$data->retb_ordinales}}</td>
                                                <td>{{$data->Planilla->Empresa->emp_siglas}}</td>
                                                <td>{{$data->Planilla->Terminal->ter_abreviatura}}</td>


                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <!-- /.card-body -->
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
