<input type="hidden" id="empPath" value="{{ url('parametros/terminal') }}">
<input type="hidden" id="empCod" value="{{ old('ordf_empresa', $data->ordf_empresa ?? '') }}">
<input type="hidden" id="terCod" value="{{ old('ordf_terminal', $data->ordf_terminal ?? '') }}">
<input type="hidden" id="prodPath" value="{{ url('productos/descripcion') }}">
<input type="hidden" name="nomCliente" id="nomCliente">

<input type="hidden" id="linea" value="0">

<section class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Detalle Orden de Facturación</h3>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="ordf_cliente"
                        class="col-sm-12 col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Cliente</label>
                    <div class="col-sm-12 col-lg-6">
                        <select name="ordf_cliente" id="ordf_cliente" class="form-control select2" placeholder="Cliente"
                            required>
                            @foreach ($clientes->getClientes() as $item)
                                <option value="{{ $item->Persona->per_id }}"
                                    {{ old('ordf_cliente', $data->ordf_cliente ?? '') == $item->Persona->per_id ? 'selected' : '' }}>
                                    {{ $item->Persona->per_nit . ' - ' . $item->Persona->per_nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="form-grup col-md4">
                    <div class="form-group row">
                        <label for="ordf_empresa"
                            class="col-sm-12 col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Empresa</label>
                        <div class="col-sm-12 col-lg-4">
                            <select name="ordf_empresa" id="ordf_empresa" class="form-control select2"
                                placeholder="Empresa" required>
                                <option value=""></option>
                                @foreach (auth()->user()->Empresas as $item)
                                    <option value="{{ $item->emp_id }}"
                                        {{ old('ordf_empresa', $data->ordf_empresa ?? '') == $item->emp_id ? 'selected' : '' }}>
                                        {{ $item->emp_siglas }}</option>
                                @endforeach
                            </select>
                        </div>

                        <label for="ordf_terminal"
                            class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Terminal</label>
                        <div class="col-sm-12 col-lg-4">
                            <select name="ordf_terminal" id="ordf_terminal" class="form-control select2"
                                placeholder="Terminal" required value="{{ $data->ordf_terminal}}">
                            </select>
                        </div>
                    </div>

                </div>
                <div class="form-grup col-md4">
                    <div class="form-group row">
                        <label for="ordf_buque"
                            class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Buque</label>
                        <div class="col-sm-12 col-lg-2">
                            <input type="text" name="ordf_buque" class="form-control" id="ordf_buque"
                                placeholder="Buque" value="{{ old('ordf_buque', $data->ordf_buque ?? '') }}"
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>

                        <label for="ordf_viaje"
                            class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Viaje</label>
                        <div class="col-sm-12 col-lg-2">
                            <input type="text" name="ordf_viaje" class="form-control" id="ordf_viaje"
                                placeholder="Viaje" value="{{ old('ordf_viaje', $data->ordf_viaje ?? '') }}"
                                onkeyup="javascript:this.value=this.value.toUpperCase();">
                        </div>
                        <label for="ordf_eta"
                            class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">ETA</label>
                        <div class="input-group col-sm-12 col-lg-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input class="form-control float-right" id="ordf_eta" name="ordf_eta"
                                value="{{ old('ordf_eta', $data->ordf_eta ?? '') }}">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ordf_moneda"
                        class="col-sm-12 col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Moneda</label>
                    <div class="col-sm-12 col-lg-2">
                        <select name="ordf_moneda" id="ordf_moneda" class="form-control select2" placeholder="Moneda"
                            required>
                            @foreach ($moneda->getMonedas() as $item)
                                <option value="{{ $item->mon_id }}" data-simbolo="{{ $item->mon_simbolo }}"
                                    {{ $item->mon_id == 2 ? 'Selected' : '' }}>
                                    {{ $item->mon_nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="ordf_tipoCambio"
                        class="col-sm-12 col-sm-12 col-lg-2 control-label text-sm-left text-lg-right ">Tipo
                        de Cambio</label>
                    <div class="col-sm-12 col-lg-2">
                        <input type="text" name="ordf_tipoCambio" id="ordf_tipoCambio" placeholder="Tipo de Cambio"
                            class="form-control" value="{{ old('ordf_tipoCambio', $data->ordf_tipoCambio ?? '') }}"
                            onkeypress='return validaNumericos(event,"D",this.value);'>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ordf_descripcion"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido ">Descripcion</label>
                    <div class="input-group col-sm-12 col-lg-10">
                        <input type="text" class="form-control float-right" id="ordf_descripcion" name="ordf_descripcion"
                            placeholder="Descripción" minlength="25" required onkeyup="PasarValor();"
                            value="{{old('ordf_descripcion', $data->ordf_descripcion ?? '')}}">
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<section class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="row" id="formDetalle"></form>
                <div class="form-group row">
                    <label for="dof_producto"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Servicio</label>
                    <div class="col-sm-12 col-lg-10">
                        <select name="dof_producto" id="dof_producto" class="form-control select2"
                            placeholder="Producto" required>

                        </select>
                    </div>

                </div>

                <div class="form-group row">
                    <label for="dof_cantidad"
                        class="col-sm-10 col-lg-1 control-label text-sm-left text-lg-right requerido requerido">Contenedor</label>
                    <div class="col-sm-12 col-lg-2">
                        <input id="dof_cantidad" type="number" min="1" pattern="^[0-9]+" name="dof_cantidad"
                            placeholder="Cantidad" class="monto"
                            onkeypress='return validaNumericos(event,"D",this.value);'>
                    </div>

                    <label for="dof_tarifa"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Tarifa</label>
                    <div class="col-sm-12 col-lg-2">
                        <input type="type" name="dof_tarifa" id="dof_tarifa" placeholder="Tarifa" class="form-control"
                            onkeypress='return validaNumericos(event,"D",this.value);'>
                    </div>
                </div>

                <div class="col-12">
                    <button onclick="agregar_insumo()" type="button"
                        class="btn btn-success float-right">Agregar</button>
                </div>
            </div>


            <div class="input-group col-sm-10 col-lg-2">
                <input type="hidden" class="form-control float-right" name="ordf_siva" id="ordf_siva"
                    value="{{ old('ordf_siva', $data->ordf_siva ?? '') }}"'>
                    <input type="hidden" class="form-control float-right" name="ordf_iva" id="ordf_iva"
                          value="{{ old('ordf_iva', $data->ordf_iva ?? '') }}"'>
            </div>

            <div class="form-group row">

                <div class="input-group col-sm-10 col-lg-2">
                    <input type="hidden" class="form-control float-right" id="ordf_total" name="ordf_total"
                        placeholder="Total" required value="{{ old('ordf_total', $data->ordf_total ?? '') }}"
                        onkeypress='return validaNumericos(event,"D",this.value);'>
                </div>
            </div>


            <input type="hidden" class="form-control float-right" id="ordf_correlativoInt" name="ordf_correlativoInt"
                 value="{{ $data->ordf_correlativoInt}}">


        </div>

</section>

<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table class="table table-bordered table-hover" id="detalle">
                <tr>
                    <th style="text-align: center" width="50%">Nombre de Servicio</th>
                    <th style="text-align: center" width="5%">Cantidad</th>
                    <th style="text-align: center" width="5%">Tarifa</th>
                    <th style="text-align: center" width="5">Sub total sin IVA<span
                        class="rotMoneda">($)</span></th>
                    <th style="text-align: center" width="5%">IVA<span
                        class="rotMoneda">($)</span></th>
                    <th  style="text-align: center" width="5%">Total <span
                        class="rotMoneda">($)</span></th>
                    <th  style="text-align: center" width="5%">Total Quetzales</th>
                    <th style="text-align: center" width="5%">Acciones</th>
                </tr>

                <tbody id="tblInsumos">

                </tbody>

                <tr>
                    <th width="50%">Totales</th>
                    <th width="1%">
                        <input style="width : 60px;" type="text" name="totalcontenedores" id="totalcontenedores" disabled>
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
