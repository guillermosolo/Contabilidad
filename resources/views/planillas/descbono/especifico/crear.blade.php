@extends("layout.layout")
@section("titulo")
    {{$tipo=='D'?'Descuentos':'Bonificaciones'}}
@endsection

@section('breadcrumbs')
    @if($tipo==='D')
        {{ Breadcrumbs::render('descuento.crear') }}
    @else
        {{ Breadcrumbs::render('bonificacion.crear') }}
    @endif
@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-select/css/select.bootstrap4.min.css")}}">

@endsection
@section('scripts')
    <script src="{{asset("assets/pages/scripts/planillas/descbono/especifico/table.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
@endsection
@section("scriptPlugins")
    <script src="{{asset("assets/plugins/datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-select/js/dataTables.select.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-select/js/select.bootstrap4.min.js")}}"></script>
@endsection
@section('contenido')
    @inject('empleado','App\Models\Planilla\Empleado')
    <input type="hidden" id="routepath" value="{{url($tipo=='D'?'planillas/descuentos':'planillas/bonificaciones')}}">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.form-error')
                    @include('includes.mensaje')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <span class="card-title"><small>{{$tipo=='D'?'Descuentos':'Bonificaciones'}}</small></span>
                            <div class="card-tools">
                                <a href="{{route($tipo=='D'?'descuento':'bonificacion')}}"
                                   class="btn btn-block btn-info btn-sm">Volver a Listado<i
                                        class="fas fa-arrow-circle-left pl-1"></i></a>
                            </div>
                        </div>
                        <form action="{{route($tipo=='D'?'descuentoE.guardar':'bonificacionE.guardar')}}" id="form-general" class="form-horizontal"
                              method="POST">
                            @csrf
                            <input type="text" name="empleados" value="" id="empleados" hidden>
                            <div class="card-body">
                                @include('planillas.descbono.especifico.table')

                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4 text-center">
                                        @include('includes.boton-form-crear')
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
