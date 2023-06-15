@extends("layout.layout")
@section("titulo")
Productos
@endsection

@section('styles')
<link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
@endsection



@section('scripts')
 <script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
<script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
<script src="{{asset("assets/pages/scripts/cxc/orden.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/pages/scripts/cxc/productos/crear1.js")}}" type="text/javascript"></script>
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('productos.crear') }}
@endsection

@section('contenido')

@inject('producto', 'App\Models\Contabilidad\CuentaContable')
@inject('prod', 'App\Models\Cxc\Productos' )



<input type="hidden" id="routepath" value="{{url('cxc/productos')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.form-error')
                @include('includes.mensaje')
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Crear Productos<small></small></h3>
                        <div class="card-tools">
                            <a href="{{route('productos')}}" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                    <form action="{{route('productos.guardar')}}" id="form-general" class="form-horizontal" method="POST"
                        autocomplete="off">
                        <div class="card-body">
                            @csrf
                            @include('cxc.productos.form')
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

