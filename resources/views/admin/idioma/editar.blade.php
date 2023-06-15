@extends("layout.layout")
@section("titulo")
Idioma
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('idioma.editar', $data) }}
@endsection

@section('scripts')
<script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
@endsection

@section('advertencia')
    No cree o actualice un Idioma sin antes haber consultado los manuales del informe del empleador del Ministerio de Trabajo y Previsión Social.
    <a href="https://www.mintrabajo.gob.gt/index.php/del/informe-del-empleador" class="btn btn-outline-warning text-dark"  target="_blank">Manuales</a>
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('admin/idioma')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.advertencia')
                @include('includes.form-error')
                @include('includes.mensaje')
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Editar Idioma <small>{{$data->idi_descripcion}}</small></h3>
                        <div class="card-tools">
                            <a href="{{route('idioma')}}" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                    <form action="{{route('idioma.actualizar',['id'=>$data->idi_id])}}" id="form-general" class="form-horizontal" method="POST"
                        autocomplete="off">
                        <div class="card-body">
                            @method('put')
                            @csrf
                            @include('admin.idioma.form')
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
