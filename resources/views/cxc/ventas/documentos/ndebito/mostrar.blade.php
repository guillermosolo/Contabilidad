@extends("layout.layout")
@section("titulo")
Nota de Débito
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('nabono.mostrar',$data) }}
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('cxc/ventas/documentos/nabono')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Mostrar Nota Débito: {{$data->ven_id}}<small></small></h3>
                        <div class="card-tools">
                            <a href="{{route('nabono')}}" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                    <div class="card-body row">
                        <div class="col-lg-8">

                            <table class="table" style="width:100%">
                                <table style="width:100%">
                                    <tr>
                                        <th>Cliente </th>
                                        <td>{{$data->Cliente->per_nombre}}</td>
                                    </tr>
                                    <tr>
                                        <th>Nit </th>
                                        <td> {{$data->Cliente->per_nit}}</td>
                                    </tr>

                                    <tr>
                                        <th>Empresa</th>
                                        <td>{{$data->Empresa->emp_siglas}}</td>
                                    </tr>
                                    <tr>
                                        <th>Terminal</th>
                                        <td>{{$data->Terminal->ter_nombre}}</td>
                                    </tr>

                                    <tr>
                                        <th>Correlativo Interno</th>
                                        <td>{{$data->Correlativo->corr_correlativo}}</td>
                                    </tr>

                                    <tr>
                                        <th>Fecha</th>
                                        <td>{{\Carbon\Carbon::parse($data->ven_fecha)->format('d/m/Y')}}</td>
                                    </tr>
                                    <tr>
                                        <th>Fecha de Certificación Electrónica</th>
                                        <td>{{\Carbon\Carbon::parse($data->ven_fechaCert)->format('d/m/Y')}}</td>
                                    </tr>

                                    <tr>
                                        <th>No. de Documento</th>
                                        <td>{{$data->ven_numDoc}}</td>
                                    </tr>
                                    <tr>
                                        <th>Serie</th>
                                        <td>{{$data->ven_serie}}</td>
                                    </tr>
                                    <tr>
                                        <th>Descripción</th>
                                        <td>{{$data->ven_descripcion}}</td>
                                    </tr>

                                    <tr>
                                        <th>Total de Factura</th>
                                        <td>{{$data->ven_total}}</td>
                                    </tr>
                                    <tr>
                                        <th>Autorización Electrónica</th>
                                        <td>{{$data->ven_iiud}}</td>
                                    </tr>

                                    <tr>
                                        <th>Moneda</th>
                                        <td>{{$data->Moneda->mon_nombre}}</td>
                                    </tr>

                                    <tr>
                                        <th>Tipo de Cambio</th>
                                        <td>{{$data->ven_tipoCambio}}</td>
                                    </tr>

                                    <tr>
                                        <th>Total Nota de Débito</th>
                                        <td>{{$data->ven_total}}</td>
                                    </tr>
                                </table>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                            <table class="table">
                                <thead>
                                    <th colspan="8" class="text-center">Detalle Nota de Débito</th>
                                </thead>
                                <tbody>

                                    <td> <b>Total Nota de Débito: </b> {{$data->ven_total}}</td>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
