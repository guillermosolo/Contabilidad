@extends("layout.layout")
@section("titulo")
    {{$tipo=='D'?'Descuentos':'Bonificaciones'}}
@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
@endsection

@section('breadcrumbs')
    @if($tipo==='D')
        {{ Breadcrumbs::render('descuento.crear') }}
    @else
        {{ Breadcrumbs::render('bonificacion.crear') }}
    @endif
@endsection

@section('scripts')
    <script src="{{asset("assets/pages/scripts/planillas/descbono/crear.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
@endsection

@section('contenido')
    @inject('tipodesc','App\Models\Planilla\TiposDesc')

    @if($tipo==='D')
        <input type="hidden" id="routepath" value="{{url('planillas/descuentos')}}">
    @else
        <input type="hidden" id="routepath" value="{{url('planillas/bonificaciones')}}">
    @endif
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.form-error')
                    @include('includes.mensaje')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title"><small>{{$tipo=='D'?'Descuentos':'Bonificaciones'}}</small></h3>
                            <div class="card-tools">
                                <a href="{{route($tipo=='D'?'descuento':'bonificacion')}}" class="btn btn-block btn-info btn-sm">Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                            </div>
                        </div>
                        <form action="{{route($tipo=='D'?'descuento.guardar':'bonificacion.guardar')}}" id="form-general" class="form-horizontal"
                              autocomplete="off"
                              method="POST">
                            @csrf

                            <div class="card-body">
                                @include('planillas.descbono.form')
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
