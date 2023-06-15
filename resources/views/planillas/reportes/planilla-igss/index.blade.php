@extends("layout.layout")
@section("titulo")
    Reporte Planilla IGSS
@endsection
@section('breadcrumbs')

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
    <input type="hidden" id="routepath"
           value="{{url('planillas/reportes/planilla-igss')}}">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <span class="card-title"><small>Reporte Planilla IGGS</small></span>
                            <div class="row d-flex justify-content-lg-end justify-content-sm-center">
                                <div class="bd-highlight p-2">
                      
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
