@extends("layout.layout")
@section("titulo")
    Reporte de Turnos
@endsection
@section('breadcrumbs')
    {{ Breadcrumbs::render('reporte-barcos.crear')}}
@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-select/css/select.bootstrap4.min.css")}}">

@endsection
@section('scripts')
    <script src="{{asset("assets/pages/scripts/planillas/generacion/eventual/reportebarcos/crear.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
@endsection
@section('contenido')
    @inject('empleado','App\Models\Planilla\Empleado')
    <input type="hidden" id="routepath" value="{{url('planillas/generacion/eventual')}}">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.form-error')
                    @include('includes.mensaje')
                    <div class="card card-outline card-success">
                        <form action="{{route('reporte-barcos.guardar')}}" id="form-general" autocomplete="off" method="POST">
                            @csrf
                            <div class="card-body">
                                @include('planillas.generacion.eventual.reporte-barcos.form')
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-around">
                                    @include('includes.boton-form-crear')
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
