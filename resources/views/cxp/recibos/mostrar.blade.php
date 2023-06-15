@extends("layout.layout")
@section("titulo")
Recibos
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('recibos.mostrar',$data) }}
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('cxp/recibos')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Mostrar Recibo:
                            {{$data->rec_numDoc??'S/N'}}<small></small></h3>
                        <div class="card-tools">
                            <a href="javascript:history.back()" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                    <div class="card-body row">
                        <div class="col-lg-7">
                            <div class="row">
                                <label for="" class="col-lg-3 text-sm-left text-lg-right">Nombre del Proveedor</label>
                                <p class="col-lg-4">{{$data->rec_nombre}}</p>

                            </div>

                            <div class="row">
                                <label for="" class="col-lg-3 text-sm-left text-lg-right">Número de Recibo</label>
                                <p class="col-lg-2">{{$data->rec_numDoc??'S/N'}}</p>
                            </div>

                            <div class="row">
                                <label for="" class="col-lg-3 text-sm-left text-lg-right">Descripción</label>
                                <p class="col-lg-9">{{$data->rec_descripcion}}</p>
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
                                <p class="col-lg-2">{{\Carbon\Carbon::parse($data->rec_fecha)->format('d/m/Y')}}</p>

                            </div>
                            <div class="row">
                                <label for="" class="col-lg-3 text-sm-left text-lg-right">Monto</label>
                                <p class="col-lg-4">{{Str::money($data->rec_monto,$data->Moneda->mon_simbolo . " ")}}
                                </p>
                                @if($data->rec_moneda!=1)
                                    <label for="" class="col-lg-3 text-sm-left text-lg-right">Tipo de Cambio</label>
                                    <p class="col-lg-4">{{Str::money($data->rec_tipoCambio,"Q ")}}</p>
                                @endif
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
                                            @isset($pagos)
                                            @foreach ($pagos as $abonos)
                                            <tr>
                                                <td>{{$abonos->pap_fecha}}</td>
                                                <td>{{$abonos->TipoPago->tip_nombre . " " . $abonos->Referencia()->docv_numero}}
                                                </td>
                                                <td>{{Str::money($abonos->pap_monto,"Q ")}}</td>
                                            </tr>
                                            @endforeach
                                            @endisset
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
</section>
@endsection
