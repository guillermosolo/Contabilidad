@extends("layout.layout")
@section("titulo")
    Informacion de Reporte de Turnos
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('reporte-turnos.ver',$id) }}
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
    <script src="{{asset("assets/pages/scripts/planillas/reporteturnos/table.js")}}" type="text/javascript"></script>
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
                            <span class="card-title"><small>Informacion de Reporte de Turnos</small></span>
                        </div>
                        <div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="tabla-data" cellspacing="0"
                                           width="100%">
                                        <thead class='thead-dark'>
                                        <tr>
                                            <th>Empleado</th>
                                            <th>Turnos</th>
                                            <th>Extras</th>
                                            <th>Ordinales</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($datas  as $data)
                                            <tr>
                                                <td>{{strtoupper($empleado->getNombreCompleto($data['dett_empleado']))}}</td>
                                                <td>{{$data['dett_turnos']}}</td>
                                                <td>{{$data['dett_extras']}}</td>
                                                <td>{{$data['dett_ordinales']}}</td>
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
