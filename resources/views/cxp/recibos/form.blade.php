<input type="hidden" id="empPath" value="{{url('parametros/terminal')}}">
<input type="hidden" id="ctaPath" value="{{url('contabilidad/ctaContable')}}">
<input type="hidden" id="empCod" value="{{old('rec_empresa',$data->rec_empresa??'')}}">
<input type="hidden" id="terCod" value="{{old('rec_terminal',$data->rec_terminal??'')}}">
<input type="hidden" id="ctaCod" value="{{old('rec_tipoGasto',$data->rec_tipoGasto??'')}}">

<section class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label for="rec_empresa"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Empresa</label>
                    <div class="col-sm-12 col-lg-4">
                        <select name="rec_empresa" id="rec_empresa" class="form-control select2" placeholder="Empresa"
                            required>
                            <option value=""></option>
                            @foreach (auth()->user()->Empresas as $item)
                            <option value="{{$item->emp_id}}"
                                {{old('rec_empresa',$data->rec_empresa ?? '') == $item->emp_id ? 'selected':''}}>
                                {{$item->emp_siglas}}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="rec_terminal"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Terminal</label>
                    <div class="col-sm-12 col-lg-4">
                        <select name="rec_terminal" id="rec_terminal" class="form-control select2"
                            placeholder="Terminal" required>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="rec_nombre"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Nombre del
                        Proveedor</label>
                    <div class="col-sm-12 col-lg-9">
                        <input type="text" name="rec_nombre" id="rec_nombre" class="form-control"
                            placeholder="Proveedor" value="{{old('rec_nombre',$data->rec_nombre??'')}}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="rec_descripcion"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Descripción</label>
                    <div class="col-sm-12 col-lg-9">
                        <input type="text" name="rec_descripcion" id="rec_descripcion" class="form-control"
                            placeholder="Descripción" minlength="25" value="{{old('rec_descripcion',$data->rec_descripcion??'')}}"
                            required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="rec_numDoc" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Número
                        de Documento</label>
                    <div class="col-sm-12 col-lg-3">
                        <input type="text" name="rec_numDoc" id="rec_numDoc" class="form-control"
                            placeholder="Número de Documento" value="{{old('rec_numDoc',$data->rec_numDoc??'')}}">
                    </div>

                    <label for="rec_fecha"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Fecha</label>
                    <div class="input-group col-sm-12 col-lg-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control float-right" id="rec_fecha" name="rec_fecha" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="rec_tipoGasto"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Tipo de
                        Gasto</label>
                    <div class="col-sm-12 col-lg-4">
                        <select id="rec_tipoGasto" name="rec_tipoGasto" class="form-control select2"
                            placeholder="Tipo de Gasto" required>

                        </select>
                    </div>

                    <label for="rec_moneda"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Moneda</label>
                    <div class="col-sm-12 col-lg-2">
                        <select name="rec_moneda" id="rec_moneda" class="form-control select2" placeholder="Moneda"
                            required>
                            @foreach ($mon->getMonedas() as $item)
                            <option value="{{$item->mon_id}}">
                                {{$item->mon_nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="rec_tipoCambio"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido" hidden>Tipo de
                        Cambio</label>
                    <div class="col-sm-12 col-lg-1">
                        <input type="text" name="rec_tipoCambio" id="rec_tipoCambio" class="form-control"
                            placeholder="T.C." value="{{old('rec_tipoCambio',$data->rec_tipoCambio??'1')}}"
                            onkeypress='return validaNumericos(event,"D",this.value);' required hidden>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="rec_monto"
                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Monto</label>
                    <div class="col-sm-12 col-lg-2">
                        <input type="text" name="rec_monto" id="rec_monto" class="form-control" placeholder="Monto"
                            value="{{old('rec_monto',$data->rec_monto??'')}}"
                            onkeypress='return validaNumericos(event,"D",this.value);' required>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
