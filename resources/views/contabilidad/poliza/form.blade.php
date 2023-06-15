<input type="hidden" id="empPath" value="{{ url('parametros/terminal') }}">
<input type="hidden" id="polPath" value="{{ url('contabilidad/poliza') }}">
<input type="hidden" id="empCod" value="{{ old('ven_empresa', $data->ven_empresa ?? '') }}">
<input type="hidden" id="linea" value="0">


<div class="form-group row">
    <label for="ven_empresa"
        class="col-sm-12 col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Empresa</label>
    <div class="col-sm-12 col-lg-3 textoAzul">
        <select name="pol_empresa" id="pol_empresa" class="form-control select2" placeholder="Empresa" required>
            <option value=""></option>
            @foreach (auth()->user()->Empresas as $item)
                <option value="{{ $item->emp_id }}"
                    {{ old('pol_empresa', $data->pol_empresa ?? '') == $item->emp_id ? 'selected' : '' }}>
                    {{ $item->emp_siglas }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="pol_descripcion"
        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido ">Descripcion</label>
    <div class="input-group col-sm-12 col-lg-10">
        <input type="text" class="form-control float-right" id="pol_descripcion" name="pol_descripcion"
            placeholder="Descripción" minlength="25" required
            value="{{ old('pol_descripcion', $data->pol_descripcion ?? '') }}">
    </div>
</div>


<div class="form-group row">
    <label for="pol_fecha" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Fecha</label>
    <div class="input-group col-sm-12 col-lg-3">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="far fa-calendar-alt"></i>
            </span>
        </div>
        <input class="form-control float-right" id="pol_fecha" name="pol_fecha" required
            value="{{ old('pol_fecha', $data->pol_fecha ?? '') }}">
    </div>
</div>

<section class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="row" id="formDetalle"></form>
                <div class="form-group row">
                    <label for="dpol_ctaContable"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Cuenta
                        Contable</label>
                    <div class="col-sm-12 col-lg-6">
                        <select name="dpol_ctaContable" id="dpol_ctaContable" class="form-control select2"
                            placeholder="Cuenta Contable" required>
                        </select>
                    </div>

                    <label for="dpol_monto"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Monto</label>
                    <div class="col-sm-12 col-lg-2">
                        <input type="type" name="dpol_monto" id="dpol_monto" placeholder="Monto" class="form-control"
                            onkeypress='return validaNumericos(event,"D",this.value);'>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-lg-1 control-label text-right">Debe/Haber</label>
                    <div class="col-sm-12 col-lg-4">
                        <div class="icheck-midnightblue d-inline">
                            <input type="radio" id="flexRadioDefault1" name="flexRadioDefault" value="D"
                                {{ old('dpol_posicion', $data->dpol_posicion ?? 'D') == 'D' ? 'checked' : '' }}>
                            <label for="flexRadioDefault1">Debe</label>
                        </div>
                        <div class="icheck-midnightblue d-inline">
                            <input type="radio" id="flexRadioDefault2" name="flexRadioDefault" value="H"
                                {{ old('dpol_posicion', $data->dpol_posicion ?? '') == 'H' ? 'checked' : '' }}>
                            <label for="flexRadioDefault2" class="mr-5">Haber</label>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button onclick="agregar_insumo()" type="button"
                        class="btn btn-success float-right">Agregar</button>
                </div>
            </div>
        </div>
    </div>

</section>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <table class="table table-bordered table-hover" id="detalle">
            <tr>
                <th  style="text-align: center;" bgcolor="D5D3D3" width="50%">Cuenta</th>
                <th style="text-align: center;" bgcolor="D5D3D3"  width="15%">Debe</th>
                <th  style="text-align: center;" bgcolor="D5D3D3"  width="15%">Haber</th>
                <th style="text-align: center;" bgcolor="D5D3D3"  width="5%">Acciones</th>
            </tr>

            <tbody id="tblInsumos">

            </tbody>

            <tr>
                <th width="25%">Totales</th>
                <th  width="15%">
                    <input type="text" name="debe" id="debe" disabled>
                </th>
                <th  width="15%">
                    <input type="text" name="haber" id="haber" disabled>
                </th>
                <th width="5%">
                </th>
            </tr>
        </table>
    </div>
