<input type="hidden" id="moviPath" value="{{url('contabilidad/cuentabancaria')}}">
<input type="hidden" id="moviCod" value="{{old('empresa',$data->CuentaContable->Empresa->emp_id??'')}}">

<div class="form-group row">
    <label for="empresa"
        class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Empresa</label>
    <div class="col-sm-12 col-lg-3">
        <select name="empresa" id="empresa" class="form-control select2" placeholder="Seleccione Empresa" required>
           <option></option>
            @foreach ($emp->getEmpresasActivas() as $item)
            <option value="{{$item->emp_id}}"
                {{old('empresa',$data->CuentaContable->Empresa->emp_id ?? '')==$item->emp_id ? 'selected':''}}>
                {{$item->emp_siglas}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="movb_descripcion" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Nombre</label>
    <div class="col-lg-8">
        <input type="text" name="movb_descripcion" class="form-control" id="movb_descripcion" placeholder="Nombre"
            value="{{old('movb_descripcion', $data->movb_descripcion ?? '')}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>

<div class="form-group row">
    <label for="movb_cuentacontable"
        class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Cuenta Contable</label>
    <div class="col-sm-12 col-lg-8">
        <select name="movb_cuentacontable" id="movb_cuentacontable" class="form-control select2" placeholder="Cuenta Contable" required>
        </select>
    </div>
</div>

