<input type="hidden" id="empPath" value="{{ url('parametros/terminal') }}">
<input type="hidden" id="empCod" value="{{ old('ordf_empresa', $data->ordf_empresa ?? '') }}">
<input type="hidden" id="terCod" value="{{ old('ordf_terminal', $data->ordf_terminal ?? '') }}">

<section class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detalle Orden de Facturación</h3>
            </div>

            <div class="card-body">
                <form action="row"></form>
                <table class="table" style="width:100%">
                    <table style="width:100%">
                        <tr>
                            <th>Cliente</th>
                            <td>{{ $data->Cliente->per_nombre }}</td>
                        </tr>
                        <tr>
                            <th>NIT </th>
                            <td> {{ $data->Cliente->per_nit }}</td>
                        </tr>

                        <tr>
                            <th>Empresa</th>
                            <td>{{ $data->Empresa->emp_siglas }}</td>
                        </tr>
                        <tr>
                            <th>Terminal</th>
                            <td>{{ $data->Terminal->ter_nombre }}</td>
                        </tr>

                        <tr>
                            <th>Correlativo Interno</th>
                            <td>{{ $data->Correlativo->corr_correlativo }}</td>
                        </tr>

                        <tr>
                            <th>ETA</th>
                            <td>{{ \Carbon\Carbon::parse($data->ordf_eta)->format('d/m/Y') }}</td>
                        </tr>

                        <tr>
                            <th>Buque</th>
                            <td>{{ $data->ordf_buque }}</td>
                        </tr>

                        <tr>
                            <th>Viaje</th>
                            <td>{{ $data->ordf_viaje }}</td>
                        </tr>

                        <tr>
                            <th>Moneda</th>
                            <td>{{ $data->Moneda->mon_nombre }}</td>
                        </tr>

                        <tr>
                            <th>Tipo de Cambio</th>
                            <td>{{ Str::decimal($data->ordf_tipoCambio) }}</td>
                        </tr>
                        <tr>
                            <th>Descripción</th>
                            <td>{{ $data->ordf_descripcion }}</td>
                        </tr>
                        <tr>
                            <th>Total Orden de Facturación</th>
                            <td>{{ Str::decimal($data->ordf_total) }}</td>
                        </tr>


                    </table>
                </table>





            </div>
        </div>
    </div>
</section>



<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table">
            <thead>

                <th colspan="8" class="text-center">Detalle Servicios</th>
                </tr>

                <th>Servicio</th>
                <th>Cantidad</th>
                <th>Tarifa</th>
                <th>Sub total sin IVA</th>
                <th>IVA</th>
                <th>Total</th>
                <th>Total</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($data->detalleOrdenFacturacion as $linea)
                <tr>
                    <td>
                        @if ($linea->dof_producto)
                            <span>{{ $linea->Productos->prod_desc_lg }}</span>
                        @endif
                    </td>
                    <td>{{ Str::decimal($linea->dof_cantidad) }}</td>
                    <td>{{ Str::decimal($linea->dof_tarifa) }}</td>
                    <td>{{ Str::decimal($linea->dof_tarifa * $linea->dof_cantidad) }}</td>
                    <td>{{ Str::decimal($linea->dof_tarifa * $linea->dof_cantidad * 0.12) }}</td>
                    <td>{{ Str::decimal($linea->dof_tarifa * $linea->dof_cantidad + $linea->dof_tarifa * $linea->dof_cantidad * 0.12) }}
                    </td>
                    <td>{{ Str::decimal(($linea->dof_tarifa * $linea->dof_cantidad + $linea->dof_tarifa * $linea->dof_cantidad * 0.12) * $data->ordf_tipoCambio) }}
                    </td>
                    <td>
                    </td>
                </tr>



                @endforeach
            </tbody>
        </table>
    </div>
</div>



<input type="hidden" class="form-control float-right" id="ordf_anulada" name="ordf_anulada"
value="{{ $data->ordf_anulada }}">

<div class="form-group row">
    <div class="col-sm-12 col-lg-10">
        @can('crear cxp/facturas')
        @if($data->ordf_factura =='')
        @if($data->ordf_anulada ==1)
            <p><a href="javascript:mostrar();" type="button" class="btn btn-success">Generar Factura </a></p>
        @else
            <p><a href="javascript:mostrar();" type="button" class="btn btn-success disabled">Generar Factura </a></p>
        @endcan
        @endif
        @endif
    </div>
    <div class="col-sm-5 col-lg-2">
        @if($data->ordf_anulada ==1)
        @if($data->ordf_factura =='')
        <a href="{{ route('ordenfacturacion.anulacion', ['id' => $data->ordf_id]) }}" type="button"
             id="boton" class="btn btn-danger"> Anular Orden de Facturación</a>
        @else
        <a href="{{ route('ordenfacturacion.anulacion', ['id' => $data->ordf_id]) }}" type="button"
            id="boton" class="btn btn-danger disabled"> Anular Orden de Facturación</a>
        @endif
        @endif

    </div>

</div>










<div id="flotante" style="display:none;">


    <div class="form-group row">
        <label for="ven_fechaCert" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Fecha</label>
        <div class="input-group col-sm-12 col-lg-4">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                </span>
            </div>
            <input class="form-control float-right" id="ven_fechaCert" name="ven_fechaCert"
                value="{{ old('ven_fechaCert', $data->ven_fechaCert ?? '') }}">
        </div>

    </div>

    <div class="form-group row">


        <input type="hidden" class="form-control float-right" id="ordf_buque" name="ordf_buque"
            value="{{ $data->ordf_buque }}">

        <input type="hidden" class="form-control float-right" id="ordf_viaje" name="ordf_viaje"
            value="{{ $data->ordf_viaje }}">

        <input type="hidden" class="form-control float-right" id="ordf_eta" name="ordf_eta"
            value="{{ $data->ordf_eta }}">


        <input type="hidden" class="form-control float-right" id="ven_empresa" name="ven_empresa"
            value="{{ $data->ordf_empresa }}{{ old('ven_empresa', $data->ven_empresa ?? '') }}">

        <input type="hidden" class="form-control float-right" id="ven_fecha" name="ven_fecha"
            value="{{ $data->ordf_fecha }}{{ old('ven_fecha', \Carbon\Carbon::parse($data->ven_fecha) ?? '') }}">

        <input type="hidden" class="form-control float-right" id="ven_descripcion" name="ven_descripcion"
            value="{{ $data->ordf_descripcion }}{{ old('ven_descripcion', $data->ven_descripcion ?? '') }}">

        <input type="hidden" class="form-control float-right" id="ordf_eta" name="ordf_eta"
            value="{{ $data->ordf_eta }}">



        <input type="hidden" class="form-control float-right" id="ven_id" name="ven_id"
            value="{{ $data->ordf_id }}{{ old('ven_id', $data->ven_id ?? '') }}">

        <input type="hidden" class="form-control float-right" id="ven_terminal" name="ven_terminal"
            value="{{ $data->ordf_terminal }}{{ old('ven_terminal', $data->ven_terminal ?? '') }}">

        <input type="hidden" class="form-control float-right" id="ven_moneda" name="ven_moneda"
            value="{{ $data->ordf_moneda }}{{ old('ven_moneda', $data->ven_moneda ?? '') }}">

        <input type="hidden" class="form-control float-right" id="ven_tipoCambio" name="ven_tipoCambio"
            value="{{ $data->ordf_tipoCambio }}{{ old('ven_tipoCambio', $data->ven_tipoCambio ?? '') }}">

        <input type="hidden" class="form-control float-right" id="ven_total" name="ven_total"
            value="{{ $data->ordf_total }}{{ old('ven_total', $data->ven_total ?? '') }}">

        <input type="hidden" class="form-control float-right" id="ven_iva" name="ven_iva"
            value="{{ $data->ordf_total - $data->ordf_total / 1.12 }}{{ old('ven_iva', $data->ven_iva ?? '') }}">


        <input type="hidden" class="form-control float-right" id="ven_persona" name="ven_persona"
            value="{{ $data->ordf_cliente }}{{ old('ven_persona', $data->ven_persona ?? '') }}">


        <input type="hidden" class="form-control float-right" id="ven_iiud" name="ven_iiud"
            value="{{ old('ven_iiud', $data->ven_iiud ?? '') }}">

        <input type="hidden" class="form-control float-right" id="ven_numDoc" name="ven_numDoc"
            value="{{ old('ven_numDoc', $data->ven_numDoc ?? '') }}">

        <input type="hidden" class="form-control float-right" id="ven_serie" name="ven_serie"
            value="{{ old('ven_serie', $data->ven_serie ?? '') }}">

        <input type="hidden" class="form-control float-right" id="ven_enlacefactura" name="ven_enlacefactura"
            value="{{ old('ven_enlacefactura', $data->ven_enlacefactura ?? '') }}">

        <input type="hidden" class="form-control float-right" id="detv_descuento" name="detv_descuento"
            value="{{ old('detv_descuento', $data->detv_descuento ?? '') }}">

        <tr>
            @foreach ($data->detalleOrdenFacturacion as $linea)
        <tr>
            <td>
                @if ($linea->dof_producto)
                    <input type="hidden" class="form-control float-right" id="detv_producto[]" name="detv_producto[]"
                        value="{{ $linea->dof_producto }}{{ old('detv_producto[]', $data->detv_producto ?? '') }}">

                @endif
            </td>
            <td> <input type="hidden" class="form-control float-right" id="detv_cantidad[]" name="detv_cantidad[]"
                    value="{{ $linea->dof_cantidad }}{{ old('detv_cantidad[]', $data->detv_cantidad ?? '') }}">
            </td>
            <td><input type="hidden" class="form-control float-right" id="detv_precioU[]" name="detv_precioU[]"
                    value="{{ $linea->dof_tarifa }}{{ old('detv_precioU[]', $data->detv_precioU ?? '') }}"></td>
        </tr>

        <td><input type="hidden" class="form-control float-right" id="iva[]" name="iva[]"
                value="{{ $linea->dof_tarifa * $linea->dof_cantidad * 0.12 }}{{ old('iva', $data->iva ?? '') }}">
        </td>

        <td><input type="hidden" class="form-control float-right" id="ivac[]" name="ivac[]"
                value="{{ $linea->dof_tarifa * $linea->dof_cantidad - ($linea->dof_tarifa * $linea->dof_cantidad) / 1.12 }}{{ old('ivac', $data->ivac ?? '') }}">
        </td>

        <td><input type="hidden" class="form-control float-right" id="totalq[]" name="totalq[]"
                value="{{ ($linea->dof_tarifa * $linea->dof_cantidad + $linea->dof_tarifa * $linea->dof_cantidad * 0.12) * $data->ordf_tipoCambio }}{{ old('totalq', $data->totalq ?? '') }}">
        </td>





        @endforeach





    </div>





    <div class="row">
        <div class="col-lg-6">
            <button type="submit" onclick="store()" class="btn btn-lg btn-outline-success float-right">Guardar</button>
        </div>
    </div>
</div>
</section>
