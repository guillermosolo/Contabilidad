@extends("layout.layout")
@section("titulo")
Factura
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('facturacion.mostrar',$data) }}
@endsection


@section('scripts')
<script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
<script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
<script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
<script src="{{asset("assets/pages/scripts/cxc/factura/crear1.js")}}" type="text/javascript"></script>

<script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
<script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
@endsection




@section('contenido')

<input type="hidden" id="routepath" value="{{url('cxc/ventas/facturacion')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline card-dark">
                    <div class="card-header">
                       <!-- <h3 class="card-title">Mostrar Factura: {{$data->ven_id}}<small></small></h3> -->
                        <div class="card-tools">
                            <a href="{{route('facturacion')}}" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                                <a href="{{route('facturacion.pdf')}}" class="btn btn-outline-danger btn-sm">
                                    Exportar a PDF<i class="far fa-file-pdf pl-1"></i></a>

                                     


                        </div>

                    </div>

                     
                        <div class="card-body">
                            @method('put')
                            @csrf
                            @include('cxc.ventas.facturacion.vistafactura1')
                        </div>
                        <!-- /.card-body -->

                    </form>
@endsection
