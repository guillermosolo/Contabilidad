@extends("layout.layout")
@section("titulo")
    Descuentos de Eventuales
@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('descuento-eventual.crear') }}
@endsection

@section('scripts')
    <script src="{{asset("assets/pages/scripts/planillas/generacion/eventual/descuento/crear.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
@endsection

@section('contenido')

    <input type="hidden" id="routepath" value="{{url('planillas/generacion/eventual')}}">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.form-error')
                    @include('includes.mensaje')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title"><small>Descuentos de Eventuales</small></h3>
                            <div class="card-tools">
                                <a href="{{route('descuento-eventual')}}" class="btn btn-block btn-info btn-sm">Volver a
                                    Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                            </div>
                        </div>
                        <form action="{{route('descuento-eventual.guardar')}}" id="form-general" class="form-horizontal" autocomplete="off"
                              method="POST">
                            @csrf
                            <div class="card-body">
                                @include('planillas.generacion.eventual.descuentos.form')
                            </div>
                            <!-- /.card-body -->
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
