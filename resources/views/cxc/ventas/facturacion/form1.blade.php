<input type="hidden" id="empPath" value="{{ url('parametros/terminal') }}">
<input type="hidden" id="empCod" value="{{ old('ven_empresa', $data->ven_empresa ?? '') }}">
<input type="hidden" id="terCod" value="{{ old('ven_terminal', $data->ven_terminal ?? '') }}">
<input type="hidden" id="prodPath" value="{{ url('productos/descripcion') }}">
<input type="hidden" id="BIENOSERVICIO" value="">


<input type="hidden" name="nomCliente" id="nomCliente">
<input type="hidden" id="linea" value="0">

<section class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Facturación</h3>
            </div>
            <div class="card-body">
                <form action="row"></form>
                <div class="form-group row">
                    <label for="ven_empresa"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Empresa</label>
                    <div class="col-sm-12 col-lg-3 textoAzul">
                        <select name="ven_empresa" id="ven_empresa" class="form-control select2" placeholder="Empresa"
                            required>
                            <option value=""></option>
                            @foreach (auth()->user()->Empresas as $item)
                                <option value="{{ $item->emp_id }}"
                                    {{ old('ven_empresa', $data->ven_empresa ?? '') == $item->emp_id ? 'selected' : '' }}>
                                    {{ $item->emp_siglas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="ven_terminal"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Terminal</label>
                    <div class="col-sm-12 col-lg-3">
                        <select name="ven_terminal" id="ven_terminal" class="form-control select2"
                            placeholder="Terminal" required>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ven_persona"
                        class="col-sm-12 col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Cliente</label>
                    <div class="col-sm-12 col-lg-8">
                        <select name="ven_persona" id="ven_persona" class="form-control select2" placeholder="Cliente"
                            required>
                            @foreach ($clientes->getClientes() as $item)
                                <option value="{{ $item->Persona->per_id }}"
                                    {{ old('ven_persona', $data->ven_persona ?? '') == $item->Persona->per_id ? 'selected' : '' }}>
                                    {{ $item->Persona->per_nit . ' - ' . $item->Persona->per_nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-12 col-lg-1">
                        <a class="btn btn-lg btn-outline-dark" id="cliente" href="{{ route('clientes.crear', '#') }}"
                            data-toggle="tooltip" title="Agregar nuevo cliente">
                            <i class="fas fa-user-tie"></i></a>
                    </div>

                </div>

                <div class="form-group row">
                    <label for="ven_fecha"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Fecha</label>
                    <div class="input-group col-sm-12 col-lg-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input class="form-control float-right" id="ven_fecha" name="ven_fecha" required
                            value="{{ old('ven_fecha', $data->ven_fecha ?? '') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ven_numDoc" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right ">Número
                        Documento</label>
                    <div class="input-group col-sm-12 col-lg-3">
                        <input type="text" class="form-control float-right" id="ven_numDoc" name="ven_numDoc"
                            placeholder="NUMDOC" value="{{ old('ven_numDoc', $data->ven_numDoc ?? '') }}">
                    </div>

                    <label for="ven_serie"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right  ">Serie</label>
                    <div class="input-group col-sm-12 col-lg-3">
                        <input type="text" class="form-control float-right" id="ven_serie" name="ven_serie"
                            placeholder="SERIE" value="{{ old('ven_serie', $data->ven_serie ?? '') }}">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="ven_iiud"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Autorización
                    </label>
                    <div class="input-group col-sm-12 col-lg-3">
                        <input type="text" class="form-control float-right" id="ven_iiud" name="ven_iiud"
                            placeholder="UUID" onchange="fel()" value="{{ old('ven_iiud', $data->ven_iiud ?? '') }}">
                    </div>

                    <label for="ven_fechaCert" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Fecha
                        Certificación</label>
                    <div class="input-group col-sm-12 col-lg-2">
                        <div for="ven_fechaCert" class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input class="form-control float-right" id="ven_fechaCert" name="ven_fechaCert"
                            PLACEHOLDER="FECHACERT" value="{{ old('ven_fechaCert', $data->ven_fechaCert ?? '') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ven_moneda"
                        class="col-sm-12 col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Moneda</label>
                    <div class="col-sm-12 col-lg-2">
                        <select name="ven_moneda" id="ven_moneda" class="form-control select2" placeholder="Moneda"
                            required>
                            @foreach ($moneda->getMonedas() as $item)
                                <option value="{{ $item->mon_id }}" data-simbolo="{{ $item->mon_simbolo }}"
                                    {{ $item->mon_id == 2 ? 'Selected' : '' }}>
                                    {{ $item->mon_nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="ven_tipoCambio"
                        class="col-sm-12 col-sm-12 col-lg-3 control-label text-sm-left text-lg-right ">Tipo
                        de Cambio</label>
                    <div class="col-sm-12 col-lg-2">
                        <input type="text" name="ven_tipoCambio" id="ven_tipoCambio" placeholder="Tipo de Cambio"
                            class="form-control" value="{{ old('ven_tipoCambio', $data->ven_tipoCambio ?? '') }}"
                            onkeypress='return validaNumericos(event,"D",this.value);'>
                    </div>
                </div>

                <div class="form-group row">
                    <!-- <label for="detv_descuento"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Descuento </label>
                    <div class="input-group col-sm-10 col-lg-2">
                        <input type="text" class="form-control float-right" id="detv_descuento" name="detv_descuento"
                            placeholder="Descuento" value="{{ old('detv_descuento', $data->detv_descuento ?? '') }}"
                            onkeypress='return validaNumericos(event,"D",this.value);'>
                    </div>  -->
                    <div class="input-group col-sm-10 col-lg-2">
                        <input type="hidden" class="form-control float-right" id="ven_total" name="ven_total"
                            placeholder="Total" value="{{ old('ven_total', $data->ven_total ?? '') }}"
                            onkeypress='return validaNumericos(event,"D",this.value);'>
                    </div>

                </div>





                <div class="form-group row">
                    <label for="ven_referencia1"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Doc. Referencia</label>
                    <div class="input-group col-sm-12 col-lg-1">

                        <select class="form-control" name="sel_quantity" id="sel_quantity"
                            onChange="mostrarValor(this.value);">
                            <option value=" ">   </option>
                            <option value="P.O:">P.O:  </option>
                            <option value="Statement:">Statement:  </option>
                        </select>
                    </div>
                    <div class="input-group col-sm-12 col-lg-4">
                        <input type="text" class="form-control float-right" id="ven_referencia" name="ven_referencia"
                        value=" " placeholder="Doc. de Referencia"
                            value="{{ old('ven_referencia', $data->ven_referencia ?? '') }}">


                    </div>




                    <label for="ven_enlacefactura"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Enlace Factura </label>
                    <div class="input-group col-sm-10 col-lg-3">
                        <input type="text" class="form-control float-right" id="ven_enlacefactura"
                            name="ven_enlacefactura" placeholder="Enlace Factura"
                            value="{{ old('ven_enlacefactura', $data->ven_enlacefactura ?? '') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ven_descripcion"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido ">Descripción</label>
                    <div class="input-group col-sm-12 col-lg-10">
                        <textarea rows="3" cols="10" class="form-control float-right" id="ven_descripcion"
                            name="ven_descripcion" placeholder="Descripción" minlength="25" required
                            value="{{ old('ven_descripcion', $data->ven_descripcion ?? '') }}">
                        </textarea>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="ven_contenedores"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right ">Observaciones</label>
                    <div class="input-group col-sm-12 col-lg-10">
                        <textarea rows="5" cols="10" class="form-control float-right" id="ven_contenedores"
                            name="ven_contenedores">
                        </textarea>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<div class="d-flex center">
    <p><a href="javascript:mostrar();" type="button" class="btn btn-success">Agregar Detalle </a></p>
</div>
<div id="flotante" style="display:none;">

    <div id="close">
        <p><a href="javascript:cerrar();" type="button" class="btn btn-danger"> Cerrar Detalle </a></p>
    </div>

    <section class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="row" id="formDetalle"></form>
                    <div class="form-group row">
                        <label for="detv_producto"
                            class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Producto</label>

                        <div class="col-sm-12 col-lg-8">
                            <select name="detv_producto" id="detv_producto" class="form-control select2"
                                placeholder="Producto" required>

                            </select>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="detv_cantidad"
                            class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido requerido">Cantidad</label>
                        <div class="col-sm-12 col-lg-2">
                            <input id="detv_cantidad" type="text" name="detv_cantidad" placeholder="Cantidad"
                                class="form-control" onkeypress='return validaNumericos(event,"D",this.value);'
                                onkeyup="PasarValor();">

                        </div>


                        <label for="detv_precioU"
                            class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Tarifa Sin
                            IVA</label>
                        <div class="col-sm-12 col-lg-2">
                            <input type="text" name="detv_precioU" id="detv_precioU" placeholder="Tarifa"
                                class="form-control" onkeypress='return validaNumericos(event,"D",this.value);'>

                        </div>

                        <div class="col-12">
                            <button onclick="agregar_insumo()" type="button"
                                class="btn btn-success float-right">Agregar</button>
                        </div>

                    </div>
                </div>

                <div class="input-group col-sm-10 col-lg-2">
                    <input type="hidden" class="form-control float-right" name="ven_siva" id="ven_siva"
                        value="{{ old('ven_siva', $data->ven_siva ?? '') }}"'>
                        <input type="hidden" class="form-control float-right" name="ven_iva" id="ven_iva"
                              value="{{ old('ven_iva', $data->ven_iva ?? '') }}"'>
                </div>


            </div>

    </section>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table table-bordered table-hover" id="detalle">
                <tr>
                    <th style="text-align: center" width="50%">Nombre de Servicio</th>
                    <th style="text-align: center" width="5%">Cantidad</th>
                    <th style="text-align: center" width="5%">Tarifa</th>
                    <th style="text-align: center" width="5">Sub total sin IVA<span class="rotMoneda">($)</span>
                    </th>
                    <th style="text-align: center" width="5%">IVA<span class="rotMoneda">($)</span></th>
                    <th style="text-align: center" width="5%">Total <span class="rotMoneda">($)</span></th>
                    <th style="text-align: center" width="5%">Total Quetzales</th>
                    <th style="text-align: center" width="5%">Acciones</th>
                </tr>

                <tbody id="tblInsumos">

                </tbody>

                <tr>
                    <th width="50%">Totales</th>
                    <th width="1%">
                        <input style="width : 60px;" type="text" name="totalcontenedores" id="totalcontenedores"
                            disabled>
                    </th>
                    <th width="1%">
                    </th>

                    <th width="5%">
                        <input style="width : 80px;" type="text" name="civa" id="civa" disabled>
                    </th>
                    <th width="5%">

                        <input style="width : 80px;" type="text" name="totaliva" id="totaliva" disabled>
                    </th>
                    <th width="5%">
                        <input style="width : 80px;" type="text" name="totaldolar" id="totaldolar" disabled>
                    </th>
                    <th width="5%">
                        <input style="width : 80px;" type="text" name="totalquetzal" id="totalquetzal" disabled>
                    </th>
                </tr>

            </table>

        </div>
