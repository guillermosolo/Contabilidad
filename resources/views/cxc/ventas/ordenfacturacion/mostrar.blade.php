@extends("layout.layout")
@section("titulo")
Orden de Facturacióneee
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('ordenfacturacion.mostrar',$data) }}
@endsection

@section('styles')
<link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet"
    type="text/css" />
<link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
@endsection

@section('scripts')
<script src="{{asset("assets/pages/scripts/cxc/ordenfacturacion/crear1.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/pages/scripts/cxc/ordenfacturacion/orden1.js")}}" type="text/javascript"></script>

<script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
<script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
<script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
<script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
<script src="{{asset("assets/pages/scripts/cxc/ordenfacturacion/ocultar.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('cxc/ventas/ordenfacturacion')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Mostrar Orden de Facturación: {{$data->ordf_id}}<small></small></h3>
                        <div class="card-tools">
                            <a href="{{route('ordenfacturacion')}}" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                    <div class="card-body row">
                        <div class="col-lg-8">

                            <table class="table" style="width:100%">
                                <table style="width:100%">
                                    <tr>
                                        <th>Cliente</th>
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
                                        <th>Eta</th>
                                        <td>{{\Carbon\Carbon::parse($data->ordf_eta)->format('d/m/Y')}}</td>
                                    </tr>

                                    <tr>
                                        <th>Buque</th>
                                        <td>{{$data->ordf_buque}}</td>
                                    </tr>

                                    <tr>
                                        <th>Viaje</th>
                                        <td>{{$data->ordf_viaje}}</td>
                                    </tr>

                                    <tr>
                                        <th>Moneda</th>
                                        <td>{{$data->Moneda->mon_nombre}}</td>
                                    </tr>

                                    <tr>
                                        <th>Tipo de Cambio</th>
                                        <td>{{Str::decimal($data->ordf_tipoCambio)}}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Orden de Facturación</th>
                                        <td>{{Str::decimal($data->ordf_total)}}</td>
                                    </tr>

                                </table>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                            <table class="table">
                                <thead>

                                    <th colspan="8" class="text-center">Detalle Servicios</th>
                                    <tr>
                                        <th>Servicio</th>
                                        <th>Cantidad de Contenedores</th>
                                        <th>Tarifa</th>
                                        <th>Sub total sin IVA</th>
                                        <th>Iva</th>
                                        <th>Total</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($data->detalleOrdenFacturacion as $linea)
                                    <tr>
                                        <td>
                                            @if($linea->dof_producto)
                                            <span>{{$linea->Productos->prod_desc_lg}}</span>
                                            @endif </td>
                                        <td>{{Str::decimal($linea->dof_cantidad)}}</td>
                                        <td>{{Str::money($linea->dof_tarifa,"Q ")}}</td>
                                        <td>{{Str::money($linea->dof_tarifa* $linea->dof_cantidad,"Q ")}}</td>
                                        <td>{{Str::money($linea->dof_tarifa* $linea->dof_cantidad*0.12,"Q ")}}</td>
                                        <td>{{Str::money(($linea->dof_tarifa* $linea->dof_cantidad) +
                                        ($linea->dof_tarifa* $linea->dof_cantidad*0.12),"Q ")}}</td>
                                        <td>{{Str::money((($linea->dof_tarifa* $linea->dof_cantidad) +
                                         ($linea->dof_tarifa* $linea->dof_cantidad*0.12))*($data->ordf_tipoCambio),"Q ")}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="d-flex justify-content-center">
        <p><a href="javascript:mostrar();" type="button" class="btn btn-success">Generar Facturae </a></p>
    </div>
    <div id="flotante" style="display:none;">
        <div class="form-group row">
            <label for="ven_fecha"
                class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Fecha</label>
            <div class="input-group col-sm-12 col-lg-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                </div>
                <input class="form-control float-right" id="ven_fecha" name="ven_fecha" required
                    value="{{old('ven_fecha', $data->ven_fecha ?? '')}}">
            </div>

            <label for="ven_numDoc" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Número
                Doc.</label>
            <div class="input-group col-sm-12 col-lg-3">
                <input type="text" class="form-control float-right" id="ven_numDoc" name="ven_numDoc"
                    placeholder="Número Doc." required value="{{old('ven_numDoc', $data->ven_numDoc ?? '')}}"
                    onkeypress='return validaNumericos(event,"D",this.value);'>
            </div>

            <label for="ven_serie"
                class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido ">Serie</label>
            <div class="input-group col-sm-12 col-lg-3">
                <input type="text" class="form-control float-right" id="ven_serie" name="ven_serie" placeholder="Serie"
                    required value="{{old('ven_serie', $data->ven_serie ?? '')}}">
            </div>

        </div>

        <div class="form-group row">
            <label for="ven_descripcion"
                class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido ">Descripcion</label>
            <div class="input-group col-sm-12 col-lg-10">
                <input type="text" class="form-control float-right" id="ven_descripcion" name="ven_descripcion"
                    placeholder="Descripción" required minlength="25"
                    value="{{old('ven_descripcion', $data->ven_descripcion ?? '')}}">
            </div>
        </div>

        <div class="form-group row">
            <label for="ven_total"
                class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido ">Total</label>
            <div class="input-group col-sm-8 col-lg-4">
                <input type="text" class="form-control float-right" id="ven_total" name="ven_total" placeholder="Total"
                    required value="{{Str::decimal($data->ordf_total)}}{{old('ven_total', $data->ven_total ?? '')}}"
                    onkeypress='return validaNumericos(event,"D",this.value);'>
            </div>
        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4 text-center">
                    @include('includes.boton-form-crear')
                </div>
            </div>
    </div>

        <div class="col-lg-2 text-center">
            <button type="submit" id="submit"
                class="btn btn-lg btn-outline-success float-right">Guardar</button>
        </div>

</section>
@endsection



