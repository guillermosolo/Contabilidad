@extends("layout.layout")
@section("titulo")
Invoice
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('invoice.mostrar',$data) }}
@endsection


@section('scripts')
<script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
<script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
<script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
<script src="{{asset("assets/pages/scripts/cxc/invoice/crear1.js")}}" type="text/javascript"></script>

<script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
<script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
@endsection




@section('contenido')

<input type="hidden" id="routepath" value="{{url('cxc/ventas/invoice')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline card-dark">
                    <div class="card-header">
                       <!-- <h3 class="card-title">Mostrar Factura: {{$data->ven_id}}<small></small></h3> -->
                        <div class="card-tools">
                            <a href="{{route('invoice')}}" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                                <a href="{{route('invoice.pdf')}}" class="btn btn-outline-danger btn-sm">
                                    Exportar a PDF<i class="far fa-file-pdf pl-1"></i></a>

                                   


                        </div>

                    </div>

                    <form action="{{route('invoice.anular')}}" id="form-general" class="form-horizontal" method="POST"
                        autocomplete="off">
                        <div class="card-body">
                            @method('put')
                            @csrf
                            @include('cxc.ventas.invoice.vistafactura1')
                        </div>
                        <!-- /.card-body -->

                    </form>
@endsection
