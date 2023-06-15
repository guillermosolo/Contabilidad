@extends("layout.layout")
@section("titulo")
Pólizas de Importación
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('importacion.mostrar',$data) }}
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('cxp/importacion')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Mostrar Póliza de Importación:
                            {{"DUA: " .$data->poim_dua ." Orden: " .$data->poim_orden}}<small></small></h3>
                        <div class="card-tools">
                            <a href="javascript:history.back()" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                    <div class="card-body row">
                        <div class="col-lg-7">
                            <div class="row">
                                <label for="" class="col-lg-3 text-sm-left text-lg-right">Nombre del Proveedor</label>
                                <p class="col-lg-4">{{$data->poim_proveedor}}</p>

                            </div>

                            <div class="row">
                                <label for="" class="col-lg-3 text-sm-left text-lg-right">DUA</label>
                                <p class="col-lg-2">{{$data->poim_dua}}</p>

                                <label for="" class="col-lg-3 text-sm-left text-lg-right">Número del Orden</label>
                                <p class="col-lg-3">{{$data->poim_orden}}</p>
                            </div>

                            <div class="row">
                                <label for="" class="col-lg-3 text-sm-left text-lg-right">Descripción</label>
                                <p class="col-lg-9">{{$data->poim_descripcion}}</p>
                            </div>

                            <div class="row">
                                <label for="" class="col-lg-3 text-sm-left text-lg-right">Empresa</label>
                                <p class="col-lg-8">{{$data->Empresa->emp_nombre}}</p>
                            </div>
                            <div class="row">
                                <label for="" class="col-lg-3 text-sm-left text-lg-right">Terminal</label>
                                <p class="col-lg-8">{{$data->Terminal->ter_nombre}}</p>
                            </div>
                            <div class="row">
                                <label for="" class="col-lg-3 text-sm-left text-lg-right">Correlativo Interno</label>
                                <p class="col-lg-4">{{$data->Correlativo->corr_correlativo}}</p>

                                <label for="" class="col-lg-1 text-sm-left text-lg-right">Fecha</label>
                                <p class="col-lg-2">{{\Carbon\Carbon::parse($data->poim_fecha)->format('d/m/Y')}}</p>

                            </div>
                            @if($data->poim_moneda!=1)
                            <div class="row">
                                <label for="" class="col-lg-3 text-sm-left text-lg-right">Tipo de Cambio</label>
                                <p class="col-lg-4">{{Str::money($data->poim_tipoCambio,"Q ")}}</p>
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-5">
                            <div class="card card-outline card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Abonos</h3>
                                </div>
                                <div class="card-body row">
                                    <table class="table" id="tabla-abono">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Fecha</th>
                                                <th>Descripción</th>
                                                <th>Monto</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pagos as $abonos)
                                            <tr>
                                                <td>{{$abonos->pap_fecha}}</td>
                                                <td>{{$abonos->TipoPago->tip_nombre . " " . $abonos->Referencia()->docv_numero}}</td>
                                                <td>{{Str::money($abonos->pap_monto,$data->Moneda->mon_simbolo . ". ")}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-striped table-hover" id="tabla-data">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Cantidad</th>
                                        <th>Descripción</th>
                                        <th class="text-right">FOB</th>
                                        <th class="text-right">Flete</th>
                                        <th class="text-right">Seguro</th>
                                        <th class="text-right">IVA</th>
                                        <th class="text-right">Total (FOB,Flete,Seguro)</th>
                                        <th>Cuenta Contable</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->detallePoliza as $linea)
                                    <tr>
                                        <td>{{Str::decimal($linea->detp_cantidad)}}</td>
                                        <td>{{$linea->detp_descripcion}}</td>
                                        <td class="text-right">{{Str::money($linea->detp_fob,$data->Moneda->mon_simbolo . " ")}}</td>
                                        <td class="text-right">{{Str::money($linea->detp_flete,$data->Moneda->mon_simbolo . " ")}}</td>
                                        <td class="text-right">{{Str::money($linea->detp_seguro,$data->Moneda->mon_simbolo . " ")}}</td>
                                        <td class="text-right">{{Str::money($linea->detp_IVA,"Q ")}}</td>
                                        <td class="text-right">{{Str::money($linea->detp_fob + $linea->detp_flete + $linea->detp_seguro,$data->Moneda->mon_simbolo . " ")}}</td>
                                        <td>{{$linea->TipoGasto->cta_codigo . "-" .$linea->TipoGasto->cta_descripcion}}
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td><strong>Total:</strong></td>
                                        <td class="text-right">{{Str::money($data->poim_FOB,$data->Moneda->mon_simbolo . " ")}}</td>
                                        <td class="text-right">{{Str::money($data->poim_flete,$data->Moneda->mon_simbolo . " ")}}</td>
                                        <td class="text-right">{{Str::money($data->poim_seguro,$data->Moneda->mon_simbolo . " ")}}</td>
                                        <td class="text-right">{{Str::money($data->poim_IVA,"Q ")}}</td>
                                        <td class="text-right">{{Str::money($data->poim_FOB + $data->poim_flete + $data->poim_seguro,$data->Moneda->mon_simbolo . " ")}}</td>
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
