@extends("layout.layout")
@section("titulo")
Nota de Abono
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('nabono.editar', $data) }}
@endsection



@section('scripts')
<script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('cxc/ventas/documentos/nabono')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.form-error')
                @include('includes.mensaje')
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Código QR y Enlace de Nota de Abono <small>{{$data->ven_id}}</small></h3>
                        <div class="card-tools">
                            <a href="{{route('nabono')}}" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                    <form action="{{route('nabono.actualizar',['id'=>$data->ven_id])}}" id="form-general" class="form-horizontal" method="POST"
                        autocomplete="off">
                        <div class="card-body">
                            @method('put')
                            @csrf
                            @include('cxc.ventas.documentos.nabono.qr')
                        </div>
                        <!-- /.card-body -->
                         
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection


