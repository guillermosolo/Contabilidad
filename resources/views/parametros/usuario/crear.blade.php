@extends("layout.layout")
@section("titulo")
Usuario
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('usuario.crear') }}
@endsection

@section('scripts')
<script src="{{asset("assets/pages/scripts/parametros/usuario/crear.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/pages/scripts/parametros/usuario/contraseña.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/pages/scripts/parametros/usuario/validacionc.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
retbct('empl','App\Models\Planilla\Empleado')
<input type="hidden" id="routepath" value="{{url('parametros/usuario')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.form-error')
                @include('includes.mensaje')
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Crear Usuario<small></small></h3>
                        <div class="card-tools">
                            <a href="{{route('usuario')}}" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                    <form action="{{route('usuario.guardar')}}" id="form-general" class="form-horizontal" method="POST"
                        autocomplete="off">
                        <div class="card-body">
                            @csrf
                            @include('parametros.usuario.form')
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
