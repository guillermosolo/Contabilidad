@extends("layout.layout")
@section("titulo")
Discapacidad
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('discapacidad.crear') }}
@endsection

@section('scripts')
<script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
@endsection

@section('advertencia')
    No cree o actualice un Discapacidad sin antes haber consultado los manuales del informe del empleador del Ministerio de Trabajo y Previsión Social.
    <a href="https://www.mintrabajo.gob.gt/index.php/del/informe-del-empleador" class="btn btn-outline-warning text-dark"  target="_blank">Manuales</a>
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('admin/discapacidad')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.advertencia')
                @include('includes.form-error')
                @include('includes.mensaje')
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Crear Discapacidad<small></small></h3>
                        <div class="card-tools">
                            <a href="{{route('discapacidad')}}" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                    <form action="{{route('discapacidad.guardar')}}" id="form-general" class="form-horizontal" method="POST"
                        autocomplete="off">
                        <div class="card-body">
                            @csrf
                            @include('admin.discapacidad.form')
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
