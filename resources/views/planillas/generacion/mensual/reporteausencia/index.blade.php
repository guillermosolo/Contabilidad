@extends("layout.layout")
@section("titulo")
    Reporte de Ausencias
@endsection

@section('breadcrumbs')
        {{ Breadcrumbs::render('reporte-ausencia') }}
@endsection
@section("styles")
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">

@endsection
@section("scriptPlugins")
    <script src="{{asset("assets/plugins/datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}"></script>
@endsection

@section("scripts")
    <script src="{{asset("assets/pages/scripts/planillas/generacion/mensual/reporteausencia/table.js")}}"
            type="text/javascript"></script>
@endsection


@section('contenido')
    @inject('empleado','App\Models\Planilla\Empleado')
    <input type="hidden" id="routepath" value="{{url('planillas/generacion/mensual')}}">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <span class="card-title"><small>Reporte de Ausencias</small></span>
                            <div class="row d-flex justify-content-lg-end justify-content-sm-center">
                                <div class="bd-highlight p-2">
                                    <a class="btn btn-block btn-success btn-sm my-0 mx-2  @can('crear planillas/generacion/mensual') @else disabled @endcan"
                                       id="crear" href="{{route('reporte-ausencia.crear')}}">Crear Reporte <i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="tabla-data" cellspacing="0"
                                           width="100%">
                                        <thead class='thead-dark'>
                                        <tr>
                                            <th>#</th>
                                            <th>Empleado</th>
                                            <th>Inicio</th>
                                            <th>Fin</th>
                                            <th>Observaciones</th>
                                            <th>Empresa</th>
                                            <th>Terminal</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($datas as $data)
                                            <tr>
                                                <td>{{$data->rea_id}}</td>
                                                <td>{{strtoupper($empleado->getNombreCompleto($data->rea_empleado))}}</td>
                                                <td>{{$data->rea_inicio}}</td>
                                                <td>{{$data->rea_fin}}</td>
                                                <td>{{$data->rea_observaciones}}</td>
                                                <td>{{$data->Empleado->Empresa->emp_siglas}}</td>
                                                <td>{{$data->Empleado->Terminal->ter_abreviatura}}</td>
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
        </div>

    </section>
@endsection
