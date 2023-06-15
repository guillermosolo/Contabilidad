@extends("layout.layout")
@section("titulo")
Activos
@endsection

@section('styles')
<link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('activos.editar', $data) }}
@endsection

@section('scripts')
<script src="{{asset("assets/pages/scripts/activos/activos/crear.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
<script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
<script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
<script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
<script src="{{asset("assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js")}}"></script>
<script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
@endsection

@section('contenido')
@inject('cat', 'App\Models\Admin\Categoria')
@inject('detalles', 'App\Models\Contabilidad\CuentaContable')
@inject('detalles1', 'App\Models\Contabilidad\CuentaContable')
@inject('empresas','App\Models\Parametros\Empresa')
@inject('terminal','App\Models\Parametros\Terminal')
@inject('status' , 'App\Models\Admin\StatusActivos')
<input type="hidden" id="routepath" value="{{url('activos/activo')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.form-error')
                @include('includes.mensaje')
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Modificar Activos<small></small></h3>
                        <div class="card-tools">
                            <a href="{{route('activos')}}" class="btn btn-block btn-info btn-sm">
                                Volver a Activos<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                    <form action="{{route('activos.actualizar',['id'=>$data->act_id])}}" id="form-general" class="form-horizontal" method="POST"
                        autocomplete="off">
                        <div class="card-body">
                            @method('put')
                            @csrf
                            @include('activos.activo.form')
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4 text-center">
                                    @include('includes.boton-form-editar')
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
