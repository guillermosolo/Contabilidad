@extends("layout.layout")
@section("titulo")
Nivel Académico
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('academico.editar', $data) }}
@endsection

@section('scripts')
<script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
@endsection

@section('advertencia')
    No cree o actualice un país sin antes haber consultado los manuales del informe del empleador del Ministerio de Trabajo y Previsión Social.
    <a href="https://www.mintrabajo.gob.gt/index.php/del/informe-del-empleador" class="btn btn-outline-warning text-dark"  target="_blank">Manuales</a>
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('admin/academico')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.advertencia')
                @include('includes.form-error')
                @include('includes.mensaje')
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Editar Nivel Académico <small>{{$data->aca_descripcion}}</small></h3>
                        <div class="card-tools">
                            <a href="{{route('academico')}}" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                    <form action="{{route('academico.actualizar',['id'=>$data->aca_id])}}" id="form-general" class="form-horizontal" method="POST"
                        autocomplete="off">
                        <div class="card-body">
                            @method('put')
                            @csrf
                            @include('admin.academico.form')
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
