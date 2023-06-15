@extends("layout.layout")
@section("titulo")
Retenciones de IVA
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('retencionIVA.mostrar',$data) }}
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('cxc/ventas/documentos/retencionIVA')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Mostrar Retención: {{$data->docv_id}}<small></small></h3>
                        <div class="card-tools">
                            <a href="{{route('retencionIVA')}}" class="btn btn-block btn-info btn-sm">
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
                                        <td>{{\Carbon\Carbon::parse($data->docv_fecha)->format('d/m/Y')}}</td>
                                    </tr>

                                    <tr>
                                        <th>No. de Documento</th>
                                        <td>{{$data->docv_numero}}</td>
                                    </tr>
                                    <tr>
                                        <th>Formulario Sat</th>
                                        <td>{{$data->docv_formularioSAT}}</td>
                                    </tr>


                                    <tr>
                                        <th>Total de Retención</th>
                                        <td>Q. {{Str::decimal($data->docv_monto)}}</td>
                                    </tr>

                                </table>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                            <table class="table">
                                <thead>
                                    <th colspan="8" class="text-center">Detalle de Retención</th>
                                </thead>
                                <tbody>

                                    <tr>
                                        <th>Factura</th>
                                       <th>Retención</th>
                                       <th>Monto</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($data->detalleRetencion as $linea)
                                    <tr>
                                        <td>
                                            @if($linea->detr_factura)
                                            <span>{{$linea->Factura->ven_serie}}-{{$linea->Factura->ven_numDoc}}-{{\Carbon\Carbon::parse($linea->Factura->ven_fecha)->format('d/m/Y')}}</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($linea->detr_tiporetencion)
                                            <span>{{$linea->Retencion->tret_descripcion}}</span>
                                            @endif
                                        </td>


                                        <td>Q.    {{Str::decimal($linea->detr_retencion)}}</td>

                                    </tr>

                                    @endforeach
                                </tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
</div>
</div>


</section>
@endsection
