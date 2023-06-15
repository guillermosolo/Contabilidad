@extends("layout.layout")
@section("titulo")
Rol
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('rol.asignarPermisos',$data) }}
@endsection

@section('scripts')
<script src="{{asset("assets/pages/scripts/parametros/rol/rol.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('parametros/rol')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.form-error')
                @include('includes.mensaje')
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Asignar Permisos al Rol <big>
                        <big><strong>{{$data->name}}</strong></big></big></h3>
                        <div class="card-tools">
                            <a href="{{route('rol')}}" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                    <form action="{{route('rol.asignarPermisos',['id'=>$data->id])}}" id="form-general" class="form-horizontal" method="POST"
                        autocomplete="off">
                        <div class="card-body">
                            @csrf
                            @include('parametros.rol.form2')
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
