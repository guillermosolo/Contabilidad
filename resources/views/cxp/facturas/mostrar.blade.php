@extends("layout.layout")
@section("titulo")
Compras y Servicios
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('facturas.mostrar',$data) }}
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('cxp/facturas')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Mostrar Factura:
                            {{$data->com_serie ." " .$data->com_numDoc}}<small></small></h3>
                        <div class="card-tools">
                            <a href="javascript:history.back()"  class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                    <div class="card-body row">
                        <div class="col-lg-7">
                            <div class="row">
                                <label for="" class="col-lg-3 text-sm-left text-lg-right">NIT del Proveedor</label>
                                <p class="col-lg-2">{{Str::nit($data->Persona->per_nit)}}</p>

                                <label for="" class="col-lg-3 text-sm-left text-lg-right">Nombre del Proveedor</label>
                                <p class="col-lg-4">{{$data->Persona->per_nombre}}</p>

                            </div>

                            <div class="row">
                                <label for="" class="col-lg-3 text-sm-left text-lg-right">Serie del Documento</label>
                                <p class="col-lg-2">{{$data->com_serie}}</p>

                                <label for="" class="col-lg-3 text-sm-left text-lg-right">Número del Documento</label>
                                <p class="col-lg-3">{{$data->com_numDoc}}</p>
                            </div>

                            <div class="row">
                                <label for="" class="col-lg-3 text-sm-left text-lg-right">Descripción</label>
                                <p class="col-lg-9">{{$data->com_descripcion}}</p>
                            </div>

                            <div class="row">
                                <label for="" class="col-lg-3 text-sm-left text-lg-right">Tipo de consumo</label>
                                <p class="col-lg-2">{{$data->TipoCompra->tipc_descripcion}}</p>

                                <label for="" class="col-lg-3 text-sm-left text-lg-right">Mes a Reportar</label>
                                @if($data->com_mesReportar!=0)
                                <p class="col-lg-4">{{Str::nombreMes($data->com_mesReportar)}}</p>
                                @else
                                <p class="col-lg-4">NO SE REPORTÓ (GASTO)</p>
                                @endif
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
                                <p class="col-lg-2">{{\Carbon\Carbon::parse($data->com_fecha)->format('d/m/Y')}}</p>

                                <p class="col-lg-1 text-sm-left">
                                    <h5><strong>{{$data->com_peqcontribuyente?"PEQUEÑO CONTRIBUYENTE":""}}</strong></h5>
                                </p>
                            </div>
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
                                                <td>{{Str::money($abonos->pap_monto,"Q ")}}</td>
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
                                        <th>Precio Unitario</th>
                                        <th>Total</th>
                                        <th>Cuenta Contable</th>
                                        <th>Observaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->detalleCompras as $linea)
                                    <tr>
                                        <td>{{Str::decimal($linea->detc_cantidad)}}</td>
                                        <td>{{$linea->detc_descripcion}}</td>
                                        <td>{{Str::money($linea->detc_precioU,"Q ")}}</td>
                                        <td>{{Str::money($linea->detc_cantidad * $linea->detc_precioU,"Q ")}}</td>
                                        <td>{{$linea->TipoGasto->cta_codigo . "-" .$linea->TipoGasto->cta_descripcion}}
                                        </td>
                                        <td>
                                            @if($linea->detc_tipoComb)
                                            <span>{{$linea->Combustible->tco_nombre . " (IDP: " . Str::money($linea->Combustible->tco_idp * $linea->detc_cantidad,"Q ") . ")"}}</span>
                                            @endif
                                            @if($linea->detc_huesped)
                                            <span>Huesped:
                                                {{$linea->detc_huesped . " (IOH: " . Str::money($linea->detc_turismo,"Q ") . ")"}}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td><strong>Total:</strong></td>
                                        <td>{{Str::money($data->com_monto,"Q ")}}</td>
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
