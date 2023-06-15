@extends("layout.layout")
@section("titulo")
    Planilla {{($tipo=='M'?'Mensual':'Eventual')}}
@endsection
@section('breadcrumbs')
    @if($tipo==='M')
        {{ Breadcrumbs::render('planillas-mensual') }}
    @else
        {{ Breadcrumbs::render('planillas-eventual') }}
    @endif
@endsection
@section('breadcrumbs')

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
    <script src="{{asset("assets/pages/scripts/planillas/generacion/table.js")}}" type="text/javascript"></script>
@endsection


@section('contenido')
    @inject('empleado','App\Models\Planilla\Empleado')

    <input type="hidden" id="routepath"
           value="{{url($tipo=='D'?'planillas/generacion/mensual':'planillas/generacion/eventual')}}">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <span
                                class="card-title"><small>Planillas {{($tipo=='M'?'Mensual':'Eventual')}}</small></span>
                            <div class="row d-flex justify-content-lg-end justify-content-sm-center">
                                @if($tipo=='E')
                                    <div class="bd-highlight p-2">
                                        <a href="{{route('control-seguridad')}}"
                                           class="btn btn-block btn-success btn-sm my-0 mx-2  @can('crear planillas/generacion/'.$tipo=='M'?'mensual':'eventual') @else disabled @endcan"
                                           id="crear">
                                            Control Seguridad<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                    </div>
                                    <div class="bd-highlight p-2">
                                        <a href="{{route('reporte-turnos')}}"
                                           class="btn btn-block btn-success btn-sm my-0 mx-2  @can('crear planillas/generacion/'.$tipo=='M'?'mensual':'eventual') @else disabled @endcan"
                                           id="crear">
                                            Reporte de Turnos<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                    </div>
                                    <div class="bd-highlight p-2">
                                        <a href="{{route('reporte-turnos.validar-crear')}}"
                                           class="btn btn-block btn-success btn-sm my-0 mx-2  @can('crear planillas/generacion/'.$tipo=='M'?'mensual':'eventual') @else disabled @endcan"
                                           id="crear">
                                            Validación de Reportes<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                    </div>
                                @endif
                                <div class="bd-highlight p-2">
                                    <a href="{{route($tipo=='M'?'planillas-mensual.crear':'planillas-eventual.crear')}}"
                                       class="btn btn-block btn-success btn-sm my-0 mx-2  @can('crear planillas/generacion/'.$tipo=='M'?'mensual':'eventual') @else disabled @endcan"
                                       id="crear">
                                        Generar Planilla<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="card-body">
                                @include('planillas.generacion.table')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
