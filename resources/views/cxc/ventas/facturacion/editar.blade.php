@extends("layout.layout")
@section("titulo")
Factura
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('facturacion', $data) }}
@endsection

@section('scripts')
<script src="{{asset("assets/pages/scripts/admin/crear.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')

<input type="hidden" id="routepath" value="{{url('cxc/ventas/facturacion')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.form-error')
                @include('includes.mensaje')
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">QR Factura <small>{{$data->ven_id}}</small></h3>
                        <div class="card-tools">
                            <a href="{{route('facturacion')}}" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>

                        </div>
                    </div>

                        <div class="card-body">
                            @method('put')
                            @csrf
                            @include('cxc.ventas.facturacion.qr')
                        </div>
                        <!-- /.card-body -->

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
