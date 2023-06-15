<input type="hidden" id="empPath" value="{{url('parametros/terminal')}}">
<input type="hidden" id="empCod" value="{{old('act_empresa',$data->act_empresa??'')}}">
<input type="hidden" id="terCod" value="{{old('act_terminal',$data->act_terminal??'')}}">
<input type="hidden" id="depCod" value="{{old('act_cuentaDep',$data->act_cuentaDep??'')}}">
<input type="hidden" id="acuCod" value="{{old('act_cuentaDepAcum',$data->act_cuentaDepAcum??'')}}">
<input type="hidden" id="ctaPath" value="{{url('contabilidad/ctaDepreciacion')}}">
<input type="hidden" id="ctaPathAcum" value="{{url('contabilidad/ctaDepAcum')}}">

<div class="form-group row">
    <label for="act_empresa"
        class="col-sm-12 col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Empresa</label>
    <div class="col-sm-12 col-lg-3">
        <select name="act_empresa" id="act_empresa" class="form-control select2" placeholder="Empresa" required>
            <option value=""></option>
            @foreach (auth()->user()->Empresas as $item)
            <option value="{{$item->emp_id}}"
                {{old('act_empresa',$data->act_empresa ?? '')==$item->emp_id ? 'selected':''}}>
                {{$item->emp_siglas}}</option>
            @endforeach
        </select>
    </div>
    <label for="act_terminal"
        class="col-sm-12 col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Terminal</label>
    <div class="col-sm-12 col-lg-3">
        <select name="act_terminal" id="act_terminal" class="form-control select2" placeholder="Terminal" required>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="act_descripcion"
        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Descripción</label>
    <div class="col-lg-8">
        <input type="text" name="act_descripcion" class="form-control" id="act_descripcion" placeholder="Descripcion"
            value="{{old('act_descripcion', $data->act_descripcion ?? '')}}" required>
    </div>
</div>

<div class="form-group row">
    <label for="act_categoria "
        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Categoría</label>
    <div class="col-sm-12 col-lg-4">
        <select name="act_categoria" id="act_categoria" class="form-control select2" placeholder="Categoria">
            @foreach ($cat->getCategoria('D') as $item)
            <option value="{{$item->cat_id}}" data-porcentaje="{{$item->cat_porcentaje}}"
                {{old('act_categoria', $data->act_categoria ?? '')==$item->cat_id ? 'selected':''}}>
                {{$item->cat_descripcion}}
            </option>
            @endforeach
        </select>
    </div>

    <label for="act_correlativo"
        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Correlativo</label>
    <div class="col-lg-3">
        <input type="text" name="act_correlativo" class="form-control" id="act_correlativo" placeholder="Correlativo"
            value="{{old('act_correlativo', $data->act_correlativo ?? '')}}" required>
    </div>
</div>

<div class="form-group row">
    <label for="act_serie" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Serie</label>
    <div class="col-lg-3">
        <input type="text" name="act_serie" class="form-control" id="act_serie" placeholder="Serie"
            value="{{old('act_serie', $data->act_serie ?? '')}}" required>
    </div>

    <label for="act_fechaAlta" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Fecha de
        Alta</label>
    <div class="input-group col-sm-12 col-lg-3">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="far fa-calendar-alt"></i>
            </span>
        </div>
        <input type="date" class="form-control float-right" id="act_fechaAlta" name="act_fechaAlta"
            value="{{old('act_fechaAlta', $data->act_fechaAlta ?? '')}}" required>
    </div>
</div>

<div class="form-group row">
    <label for="act_valor" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Valor sin IVA</label>
    <div class="col-lg-3">
        <input type="text" name="act_valor" class="form-control" id="act_valor" placeholder="Valor"
            value="{{old('act_valor', $data->act_valor ?? '')}}" required  onkeypress='return validaNumericos(event,"D",this.value);'>
    </div>
    <label for="act_status" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Status
        Activo</label>
    <div class="col-sm-12 col-lg-3">
        <select name="act_status" id="act_status" class="form-control select2" placeholder="Status Activo">
            @foreach ($status->getStatusActivos() as $item)
            <option value="{{$item->sta_id}}" data-baja="{{$item->sta_baja}}"
                {{old('act_status', $data->act_status ?? '')==$item->sta_id? 'selected':''}}>
                {{$item->sta_descripcion}}
            </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="act_cuentaDep" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Cuenta
        Depreciación</label>
    <div class="col-sm-12 col-lg-8">
        <select name="act_cuentaDep" id="act_cuentaDep" class="form-control select2" placeholder="Cuenta Depreciación" required>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="act_cuentaDepAcum" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Cuenta
        Depreciación Acumulada</label>
    <div class="col-sm-12 col-lg-8">
        <select name="act_cuentaDepAcum" id="act_cuentaDepAcum" class="form-control select2"
            placeholder="Cuenta Depreciable Acumulada" required>

        </select>
    </div>
</div>

<div class="form-group row">
    <label for="act_inicial" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right ">Depreciación Inicial</label>
    <div class="col-lg-2">
        <input type="text" name="act_inicial" class="form-control" id="act_inicial" placeholder="Valor Inicial"
            value="{{old('act_inicial', $data->act_inicial ?? '0')}}" onkeypress='return validaNumericos(event,"D",this.value);'>
    </div>

    <label for="act_porcentaje" class="col-lg-3 control-label text-right requerido">Porcentaje</label>
    <div class="col-lg-3">
        <input data-suffix="%" type="number" step="any" min="0" max="100" data-decimals= "2" name="act_porcentaje" class="form-control" id="act_porcentaje" placeholder="Porcentaje"
            value="{{old('act_porcentaje', ($data->act_porcentaje ?? 0)*100)}}">
    </div>
</div>

<div class="form-group row">
    <label for="act_fechaBaja" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right ">Fecha de
        baja</label>
    <div class="input-group col-sm-12 col-lg-3">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="far fa-calendar-alt"></i>
            </span>
        </div>
        <input type="date" class="form-control float-right" id="act_fechaBaja" name="act_fechaBaja"
            value="{{old('act_fechaBaja', $data->act_fechaBaja ?? '')}}">
    </div>
    <div class="col-sm-none col-lg-1"></div>
    <div class="input-group col-sm-12 col-lg-2">
        <div class="icheck-midnightblue d-block">
            <input type="checkbox" id="act_propio" name="act_propio" value="1"
                {{old('act_propio',$data->act_propio ?? '0')==1?"checked":""}}>
            <label for="act_propio" class="mr-5">Activo de Terceros</label>
        </div>
    </div>
    <div class="input-group col-sm-12 col-lg-2">
        <div class="icheck-midnightblue d-block">
            <input type="checkbox" id="act_depreciar" name="act_depreciar" value="1"
                {{old('act_depreciar',$act_depreciar ?? '1')==1?"checked":""}}>
            <label for="act_depreciar" class="mr-5">Depreciar Activo</label>
        </div>
    </div>
</div>
