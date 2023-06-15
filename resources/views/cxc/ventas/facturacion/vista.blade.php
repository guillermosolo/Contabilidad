@extends("layout.layout")
@section("titulo")
Facturación
@endsection

@section('styles')
<link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
@endsection

@section('scripts')
<script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
<script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
<script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
<script src="{{asset("assets/pages/scripts/cxc/factura/crear1.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/pages/scripts/cxc/factura/orden1.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/pages/scripts/cxc/factura/ocultar.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/pages/scripts/cxc/factura/nuevo.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
<script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
@endsection

 @section('breadcrumbs')
{{ Breadcrumbs::render('facturacion.crear') }}
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('cxc/ventas/facturacion')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.form-error')
                @include('includes.mensaje')
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title"><small></small></h3>
                        <div class="card-tools">
                            <a href="{{route('facturacion')}}" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                        <div class="card-body">
                            <object data="{{session('urlf')}}" type="application/pdf" width="100%" height="800px"></object>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
