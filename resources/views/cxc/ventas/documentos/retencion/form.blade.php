<input type="hidden" id="empPath" value="{{ url('parametros/terminal') }}">
<input type="hidden" id="empCod" value="{{ old('docv_empresa', $data->docv_empresa ?? '') }}">
<input type="hidden" id="terCod" value="{{ old('docv_terminal', $data->docv_terminal ?? '') }}">
<input type="hidden" id="notPath" value="{{ url('cxc/retencion') }}">
<input type="hidden" id="linea" value="0">
<input type="hidden" id="SERIE"  value="">


<section class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Retenciones ISR</h3>
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

                    <label for="detr_retencion"
                    class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Monto de
                    Retención</label>
                <div class="col-sm-12 col-lg-3">
                    <input type="type" name="detr_retencion" id="detr_retencion" placeholder="Monto"
                        class="form-control" onkeypress='return validaNumericos(event,"D",this.value);' onkeyup="PasarValor();">
                </div>

                    <label for="docv_numero"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Número de Constancia</label>
                    <div class="input-group col-sm-12 col-lg-3">
                        <input type="text" class="form-control float-right" id="docv_numero" name="docv_numero"
                            placeholder="Número de Constancia" required
                            value="{{ old('docv_numero', $data->docv_numero ?? '') }}" onkeyup="PasarValor1();">
                    </div>

                </div>


                <input type="hidden" class="form-control float-right" id="docv_formularioSAT" name="docv_formularioSAT" required
                    value="{{ old('docv_formularioSAT', $data->docv_formularioSAT ?? '1911') }}">



                <div class="form-group row">

                    <div class="input-group col-sm-10 col-lg-3">
                        <input type="hidden" class="form-control float-right" id="docv_monto" name="docv_monto"
                            placeholder="Total" required value="{{ old('docv_monto', $data->docv_monto ?? '') }}"
                            onkeypress='return validaNumericos(event,"D",this.value);' onkeyup="PasarValor1();">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="factura"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Factura
                        Afectar</label>
                    <div class="col-sm-12 col-lg-4">
                        <select name="factura" id="factura" class="form-control select2" placeholder="Factura"
                            required>
                        </select>
                    </div>
                </div>



                <div class="form-group row">
                    <label for="detr_tiporetencion"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Descripción</label>
                    <div class="col-sm-12 col-lg-8">
                        <select name="detr_tiporetencion" id="detr_tiporetencion" class="form-control select2"
                            placeholder="Descripción">
                            @foreach ($tiporetencion->getTipoRetencion() as $item)
                                <option value="{{ $item->tret_id }}"
                                    {{$item->tret_id==20? "selected" : "" }}>
                                    {{ $item->tret_descripcion }} </option>
                            @endforeach
                        </select>
                    </div>
                </div>


<input   type="hidden" name="detr_factura" id="detr_factura">




