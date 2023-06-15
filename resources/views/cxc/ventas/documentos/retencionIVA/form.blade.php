<input type="hidden" id="empPath" value="{{ url('parametros/terminal') }}">
<input type="hidden" id="empCod" value="{{ old('docv_empresa', $data->docv_empresa ?? '') }}">
<input type="hidden" id="terCod" value="{{ old('docv_terminal', $data->docv_terminal ?? '') }}">
<input type="hidden" id="notPath" value="{{ url('cxc/retencion') }}">
<input type="hidden" id="linea" value="0">


<section class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Retenciones</h3>
            </div>
            <div class="card-body">
                <form action="row"></form>
                <div class="form-group row">
                    <label for="docv_empresa"
                        class="col-sm-12 col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Empresa</label>
                    <div class="col-sm-12 col-lg-3 textoAzul">
                        <select name="docv_empresa" id="docv_empresa" class="form-control select2" placeholder="Empresa"
                            required>
                            <option value=""></option>
                            @foreach (auth()->user()->Empresas as $item)
                                <option value="{{ $item->emp_id }}"
                                    {{ old('docv_empresa', $data->docv_empresa ?? '') == $item->emp_id ? 'selected' : '' }}>
                                    {{ $item->emp_siglas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="docv_terminal"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Terminal</label>
                    <div class="col-sm-12 col-lg-4">
                        <select name="docv_terminal" id="docv_terminal" class="form-control select2"
                            placeholder="Terminal" required>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="docv_persona"
                        class="col-sm-12 col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Cliente</label>
                    <div class="col-sm-12 col-lg-6">
                        <select name="docv_persona" id="docv_persona" class="form-control select2" placeholder="Cliente"
                            required>
                            @foreach ($clientes->getClientes() as $item)
                                <option value="{{ $item->Persona->per_id }}"
                                    {{ old('docv_persona', $data->docv_persona ?? '') == $item->Persona->per_id ? 'selected' : '' }}>
                                    {{ $item->Persona->per_nit . ' - ' . $item->Persona->per_nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="form-group row">
                    <label for="docv_fecha"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Fecha</label>
                    <div class="input-group col-sm-12 col-lg-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input class="form-control float-right" id="docv_fecha" name="docv_fecha" required
                            value="{{ old('docv_fecha', $data->docv_fecha ?? '') }}">
                    </div>

                </div>

                <input type="hidden" class="form-control float-right" id="docv_tipo" name="docv_tipo" required
                    value="{{ old('docv_tipo', $data->docv_tipo ?? 'C') }}">

                <div class="form-group row">

                    <label for="docv_numero"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Número de Constancia </label>
                    <div class="input-group col-sm-12 col-lg-3">
                        <input type="text" class="form-control float-right" id="docv_numero" name="docv_numero"
                            placeholder="Número de Constancia " required
                            value="{{ old('docv_numero', $data->docv_numero ?? '') }}">
                    </div>

                </div>




                        <input type="hidden" class="form-control float-right" id="docv_formularioSAT" name="docv_formularioSAT"
                            placeholder="Código Verificación" required
                            value="{{ old('docv_formularioSAT', $data->docv_formularioSAT ?? '2229') }}">





                <div class="form-group row">

                    <div class="input-group col-sm-10 col-lg-3">
                        <input type="hidden" class="form-control float-right" id="docv_monto" name="docv_monto"
                            placeholder="Total"  value="{{ old('docv_monto', $data->docv_monto ?? '') }}"
                            onkeypress='return validaNumericos(event,"D",this.value);'>
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
                    <label for="detr_tiporetencion"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Descripción</label>
                    <div class="col-sm-12 col-lg-8">
                        <select name="detr_tiporetencion" id="detr_tiporetencion" class="form-control select2"
                            placeholder="Descripción">
                            @foreach ($tiporetencion->getTipoRetencion() as $item)
                                <option value="{{ $item->tret_id }}"
                                    {{ old('detr_tiporetencion', $data->detr_tiporetencion ?? '') == $item->tret_id ? 'selected' : '' }}>
                                    {{ $item->tret_descripcion }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="detr_factura"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Factura
                        Afectar</label>
                    <div class="col-sm-12 col-lg-4">
                        <select name="detr_factura" id="detr_factura" class="form-control select2" placeholder="Factura"
                            required>
                        </select>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="detr_retencion"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Monto de Retención</label>
                    <div class="col-sm-12 col-lg-3">
                        <input type="type" name="detr_retencion" id="detr_retencion" placeholder="Monto"
                            class="form-control" onkeypress='return validaNumericos(event,"D",this.value);'>
                    </div>
                </div>

                <div class="col-12">
                    <button onclick="agregar_insumo()" type="button"
                        class="btn btn-success float-right">Agregar</button>
                </div>
            </div>
        </div>

</section>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-bordered table-hover" id="detalle">
            <tr>
                <th width="50%">Descripción</th>
                <th width="50%">Factura</th>
                <th width="15%">Monto</th>
                <th width="15%">Acciones</th>

            </tr>

            <tbody id="tblInsumos">

            </tbody>

            <tr>
                <th width="25%">Totales</th>
                <th width="15%">

                </th>
                <th width="15%">
                    <input type="text" name="retencion" id="retencion" disabled>
                </th>





            </tr>

        </table>

    </div>
