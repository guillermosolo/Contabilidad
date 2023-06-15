<input type="hidden" id="empPath" value="{{url('parametros/terminal')}}">
<input type="hidden" id="ctaPath" value="{{url('contabilidad/ctaContable')}}">
<input type="hidden" id="empCod" value="{{old('poim_empresa',$data->poim_empresa??'')}}">
<input type="hidden" id="terCod" value="{{old('poim_terminal',$data->poim_terminal??'')}}">
<input type="hidden" id="ctaCod" value="{{old('poim_tipoGasto',$data->poim_tipoGasto??'')}}">
<input type="hidden" id="linea" value="0">

<section class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label for="poim_empresa"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Empresa</label>
                    <div class="col-sm-12 col-lg-4">
                        <select name="poim_empresa" id="poim_empresa" class="form-control select2" placeholder="Empresa"
                            required>
                            <option value=""></option>
                            @foreach (auth()->user()->Empresas as $item)
                            <option value="{{$item->emp_id}}"
                                {{old('poim_empresa',$data->poim_empresa ?? '') == $item->emp_id ? 'selected':''}}>
                                {{$item->emp_siglas}}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="poim_terminal"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Terminal</label>
                    <div class="col-sm-12 col-lg-4">
                        <select name="poim_terminal" id="poim_terminal" class="form-control select2"
                            placeholder="Terminal" required>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="poim_proveedor"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Nombre del
                        Proveedor</label>
                    <div class="col-sm-12 col-lg-9">
                        <input type="text" name="poim_proveedor" id="poim_proveedor" class="form-control"
                            placeholder="Proveedor" value="{{old('poim_proveedor',$data->poim_proveedor??'')}}"
                            required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="poim_descripcion"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Descripción</label>
                    <div class="col-sm-12 col-lg-9">
                        <input type="text" name="poim_descripcion" id="poim_descripcion" class="form-control"
                            placeholder="Descripción" minlength="25"
                            value="{{old('poim_descripcion',$data->poim_descripcion??'')}}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="poim_orden"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">No. de
                        Orden / Código de Referencia</label>
                    <div class="col-sm-12 col-lg-4">
                        <input type="text" name="poim_orden" id="poim_orden" class="form-control" placeholder="Orden"
                            value="{{old('poim_orden',$data->poim_orden??'')}}" required>
                    </div>

                    <label for="poim_dua"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">No. de DUA / DUCA</label>
                    <div class="col-sm-12 col-lg-4">
                        <input type="text" name="poim_dua" id="poim_dua" class="form-control" placeholder="DUA"
                            value="{{old('poim_dua',$data->poim_dua??'')}}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="poim_fecha"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Fecha</label>
                    <div class="input-group col-sm-12 col-lg-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control float-right" id="poim_fecha" name="poim_fecha" required>
                    </div>

                    <label for="poim_moneda"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Moneda</label>
                    <div class="col-sm-12 col-lg-2">
                        <select name="poim_moneda" id="poim_moneda" class="form-control select2" placeholder="Moneda"
                            required>
                            @foreach ($mon->getMonedas() as $item)
                            <option value="{{$item->mon_id}}" data-simbolo="{{$item->mon_simbolo}}" {{$item->mon_id==2?"Selected":""}}>
                                {{$item->mon_nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="poim_tipoCambio"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Tipo de
                        Cambio</label>
                    <div class="col-sm-12 col-lg-2">
                        <input type="text" name="poim_tipoCambio" id="poim_tipoCambio" class="form-control"
                            placeholder="T.C." value="{{old('poim_tipoCambio',$data->poim_tipoCambio??'')}}"
                            onkeypress='return validaNumericos(event,"D",this.value);' required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-lg-2 control-label text-right requerido">Activo/Gasto</label>
                    <div class="col-lg-4">
                        <div class="icheck-midnightblue d-inline">
                            <input type="radio" id="impActivo" name="GastoActivo" value="A"
                                {{old('impActivo',$data->impActivo ?? '')=='A'?"checked":""}}>
                            <label for="impActivo" class="mr-5">Activo</label>
                        </div>
                        <div class="icheck-midnightblue d-inline">
                            <input type="radio" id="impGasto" name="GastoActivo" value="G"
                                {{old('impGasto',$data->impGasto ?? 'G')=='G'?"checked":""}}>
                            <label for="impGasto">Gasto</label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 col-lg-2">
                        <input type="hidden" name="poim_FOB" id="poim_FOB" class="form-control disabled"
                            placeholder="FOB" required>
                    </div>

                    <div class="col-sm-12 col-lg-2">
                        <input type="hidden" name="poim_flete" id="poim_flete" class="form-control disabled"
                            placeholder="Flete" required>
                    </div>

                    <div class="col-sm-12 col-lg-2">
                        <input type="hidden" name="poim_seguro" id="poim_seguro" class="form-control disabled"
                            placeholder="Seguro" required>
                    </div>

                    <div class="col-sm-12 col-lg-2">
                        <input type="hidden" name="poim_IVA" id="poim_IVA" class="form-control disabled"
                            placeholder="IVA" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-11">
                        <div class="form-group row">
                            <div class="col-sm-12 col-lg-8">
                                <label for="descripcion" class="control-label requerido">Artículo</label>
                                <input type="text" id="descripcion" class="form-control" placeholder="Descripción">
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <label for="tipoGasto" class="control-label requerido">Tipo de Gasto</label>
                                <select id="tipoGasto" class="form-control select2" placeholder="Tipo de Gasto">

                                </select>
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-lg-2">
                                <label for="cantidad" class="control-label requerido">Cantidad</label>
                                <input type="text" id="cantidad" class="form-control" placeholder="Cantidad"
                                    onkeypress='return validaNumericos(event,"D",this.value);'>
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-2">
                                <label for="fob" class="control-label requerido">FOB <span
                                        class="rotMoneda">($)</span></label>
                                <input type="text" id="fob" class="form-control" placeholder="FOB"
                                    onkeypress='return validaNumericos(event,"D",this.value);'>
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-2">
                                <label for="flete" class="control-label requerido">Flete <span
                                        class="rotMoneda">($)</span></label>
                                <input type="text" id="flete" class="form-control" placeholder="Flete"
                                    onkeypress='return validaNumericos(event,"D",this.value);'>
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-2">
                                <label for="seguro" class="control-label requerido">Seguro <span
                                        class="rotMoneda">($)</span></label>
                                <input type="text" id="seguro" class="form-control" placeholder="Seguro"
                                    onkeypress='return validaNumericos(event,"D",this.value);'>
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-2">
                                <label for="iva" class="control-label requerido">IVA <span>(Q)</span></label>
                                <input type="text" id="iva" class="form-control" placeholder="IVA"
                                    onkeypress='return validaNumericos(event,"D",this.value);'>
                                <div class="invalid-feedback">
                                    Este campo es obligatorio.
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-2">
                                <p class="text-danger"><strong>Ingrese los datos según aparecen en la DUA/DUCA.</strong></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <button id="agregar" type="button" class="btn btn-lg btn-outline-success float-right"><i
                                class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-striped table-hover" id="tabla-data">
                        <thead class='thead-dark'>
                            <tr>
                                <th></th>
                                <th>Cantidad</th>
                                <th>Descripción</th>
                                <th>Total</th>
                                <th>Tipo de Gasto</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="detCompra">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
