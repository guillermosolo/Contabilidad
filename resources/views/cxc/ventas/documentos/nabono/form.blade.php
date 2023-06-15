<input type="hidden" id="empPath" value="{{url('parametros/terminal')}}">
<input type="hidden" id="notPath" value="{{url('cxc/notas')}}">
<input type="hidden" id="empCod" value="{{old('ven_empresa',$data->ven_empresa??'')}}">
<input type="hidden" id="terCod" value="{{old('ven_terminal',$data->ven_terminal??'')}}">
<input type="hidden" id="cliCod" value="{{url('cliente/documentos')}}">
<input type="hidden" id="cliente" >


<input type="hidden" id="linea" value="0">
<input type="hidden" id="UUID"  value="">
<input type="hidden" id="SERIE"  value="">
<input type="hidden" id="FECHACERT"  value="">
<input type="hidden" id="NUMDOC"  value="" >



<section class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Nota de Crédito</h3>
            </div>
            <div class="card-body">
                <form action="row"></form>
                <div class="form-group row">
                    <label for="ven_empresa"
                        class="col-sm-12 col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Empresa</label>
                    <div class="col-sm-12 col-lg-3 textoAzul">
                        <select name="ven_empresa" id="ven_empresa" class="form-control select2" placeholder="Empresa"
                            required>
                            <option value=""></option>
                            @foreach (auth()->user()->Empresas as $item)
                            <option value="{{$item->emp_id}}"
                                {{old('ven_empresa',$data->ven_empresa ?? '') == $item->emp_id ? 'selected':''}}>
                                {{$item->emp_siglas}}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="ven_terminal"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Terminal</label>
                    <div class="col-sm-12 col-lg-4">
                        <select name="ven_terminal" id="ven_terminal" class="form-control select2"
                            placeholder="Terminal" required>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ven_persona"
                        class="col-sm-12 col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Cliente</label>
                    <div class="col-sm-12 col-lg-6">
                        <select name="ven_persona" id="ven_persona" class="form-control select2" placeholder="Cliente"
                            required onChange="mostrarValor(this.value);">
                            @foreach ($clientes->getClientes() as $item)
                            <option value="{{$item->Persona->per_id}}"
                                {{old('ven_persona',$data->ven_persona ?? '') == $item->Persona->per_id ? 'selected':''}}>
                                {{$item->Persona->per_nit . " - " . $item->Persona->per_nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="form-group row">
                    <label for="abf_referencia"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Factura Afectar</label>
                    <div class="col-sm-12 col-lg-8">
                        <select name="abf_referencia" id="abf_referencia" class="form-control select2"
                            placeholder="Factura">
                        </select>
                    </div>
                </div>

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
                </div>


                <div class="form-group row">
                    <label for="ven_numDoc"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Número
                        Doc.</label>
                    <div class="input-group col-sm-12 col-lg-3">
                        <input type="text" class="form-control float-right" id="ven_numDoc" name="ven_numDoc"
                            placeholder="Número Doc." value="{{old('ven_numDoc', $data->ven_numDoc ?? '')}}"
                            onkeypress='return validaNumericos(event,"D",this.value);'>
                    </div>

                    <label for="ven_serie"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right ">Serie</label>
                    <div class="input-group col-sm-12 col-lg-2">
                        <input type="text" class="form-control float-right" id="ven_serie" name="ven_serie"
                            placeholder="Serie"  value="{{old('ven_serie', $data->ven_serie ?? '')}}">
                    </div>
                </div>

                <div class="form-group row">

                    <label for="ven_tipoCambio"
                        class="col-sm-12 col-sm-12 col-lg-1 control-label text-sm-left text-lg-right ">Tipo
                        de Cambio</label>
                    <div class="col-sm-12 col-lg-2">
                        <input type="double" name="ven_tipoCambio" id="ven_tipoCambio" placeholder="Tipo de Cambio"
                            class="form-control" value="{{old('ven_tipoCambio', $data->ven_tipoCambio ?? '')}}"

                            onkeypress='return validaNumericos(event,"D",this.value);'>
                    </div>


                    <div class="col-sm-12 col-lg-3">
                        <input type="hidden" name="ven_moneda" id="ven_moneda" class="form-control float-right" placeholder="Moneda"
                            required>
                    </div>



                </div>
                <div class="form-group row">
                    <label for="ven_iiud"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">UUID </label>
                    <div class="input-group col-sm-12 col-lg-3">
                        <input type="text" class="form-control float-right" id="ven_iiud" name="ven_iiud"
                            placeholder="Número Certificación"
                            value="{{old('ven_iiud', $data->ven_iiud ?? '')}}">
                    </div>

                    <label for="ven_fechaCert"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Fecha Certif</label>
                    <div id="ven_fechaCert" name="ven_fechaCert" class="input-group col-sm-12 col-lg-2">
                        <div   class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input class="form-control float-right" id="ven_fechaCert" name="ven_fechaCert"
                            value="{{old('ven_fechaCert', $data->ven_fechaCert ?? '')}}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ven_total"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Monto
                    </label>
                    <div class="input-group col-sm-10 col-lg-3">
                        <input type="text" class="form-control float-right" id="ven_total" name="ven_total"
                            placeholder="Total" required value="{{old('ven_total', $data->ven_total ?? '')}}"
                              onkeypress='return validaNumericos(event,"D",this.value);' onkeyup="PasarValor1();">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="ven_descripcion"
                        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido ">Descripcion</label>
                    <div class="input-group col-sm-12 col-lg-10">
                        <input type="text" class="form-control float-right" id="ven_descripcion" name="ven_descripcion"
                            placeholder="Descripción" minlength="25" required
                            value="{{old('ven_descripcion', $data->ven_descripcion ?? '')}}" onkeyup="PasarValor();">
                    </div>
                </div>

                <input   type="hidden" name="uuid" id="uuid">
                <input   type="hidden" name="serie" id="serie">
                <input   type="hidden" name="numdoc" id="numdoc">
                <input   type="hidden" name="fechacert" id="fechacert">



            </div>
        </div>
    </div>
</section>


<div id="flotante" style="display:none;">


    <section class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">







                    </div>
                </div>
            </div>

    </section>
