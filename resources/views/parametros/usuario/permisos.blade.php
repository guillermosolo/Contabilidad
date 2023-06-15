@extends("layout.layout")
@section("titulo")
Rol
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('usuario.asignarPermisos',$data) }}
@endsection

@section('scripts')
<script src="{{asset("assets/pages/scripts/parametros/usuario/permisos.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('parametros/usuario')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.form-error')
                @include('includes.mensaje')
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Asignar Permisos al usuario <small>{{$data->usu_nombre}}</small></h3>
                        <div class="card-tools">
                            <a href="{{route('usuario')}}" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                    <form action="{{route('rol.asignarPermisos',['id'=>$data->id])}}" id="form-general" class="form-horizontal" method="POST"
                        autocomplete="off">
                        <div class="card-body">
                            @csrf
                            @include('parametros.usuario.form2')
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-4"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
