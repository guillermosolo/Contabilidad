@extends("layout.layout")
@section("titulo")
Tipo Combustible
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('tipocombustible.crear') }}
@endsection

@section('scripts')
<script src="{{asset("assets/pages/scripts/admin/tipocombustible/crear.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('admin/tipocombustible')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.form-error')
                @include('includes.mensaje')
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Crear Tipo Combustible<small></small></h3>
                        <div class="card-tools">
                            <a href="{{route('tipocombustible')}}" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                    <form action="{{route('tipocombustible.guardar')}}" id="form-general" class="form-horizontal" method="POST"
                        autocomplete="off">
                        <div class="card-body">
                            @csrf
                            @include('admin.tipocombustible.form')
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
