@extends("layout.layout")
@section("titulo")
        Prestacion Laboral

@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
@endsection

@section('breadcrumbs')
        {{ Breadcrumbs::render('prestacion-laboral') }}
@endsection

@section('scripts')
    <script src="{{asset("assets/pages/scripts/planillas/prestaciones/crear.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
@endsection


@section('contenido')

        <input type="hidden" id="routepath" value="{{url('planillas/prestaciones-laboral')}}">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.form-error')
                    @include('includes.mensaje')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <span class="card-title"><small>Prestacion Laboral</small></span>
                        </div>
                        <form action="{{route('prestacion-laboral.guardar')}}" id="form-general" class="form-horizontal"
                              autocomplete="off"
                              method="POST">
                            @csrf

                            <div class="card-body">
                                @include('planillas.prestacion-laboral.form')
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="d-flex justify-content-around">
                                    <button type="reset" class="btn btn-lg btn-outline-secondary">Limpiar</button>
                                    <button type="submit" class="btn btn-lg btn-outline-success float-right">Calcular</button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
