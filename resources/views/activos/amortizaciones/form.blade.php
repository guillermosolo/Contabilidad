<input type="hidden" id="empPath" value="{{url('parametros/terminal')}}">
<input type="hidden" id="empCod" value="{{old('cam_empresa',$data->cam_empresa??'')}}">
<input type="hidden" id="terCod" value="{{old('cam_terminal',$data->cam_terminal??'')}}">
<input type="hidden" id="ctaPath" value="{{url('contabilidad/ctaAmortizacion')}}">
<input type="hidden" id="ctaPathAcum" value="{{url('contabilidad/ctaAmortAcum')}}">

<div class="form-group row">
    <label for="cam_empresa"
        class="col-sm-12 col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Empresa</label>
    <div class="col-sm-12 col-lg-3">
        <select name="cam_empresa" id="cam_empresa" class="form-control select2" placeholder="Empresa">
            <option value=""></option>
            @foreach (auth()->user()->Empresas as $item)
            <option value="{{$item->emp_id}}"
                {{old('cam_empresa',$data->cam_empresa ?? '')==$item->emp_id ? 'selected':''}}>
                {{$item->emp_siglas}}</option>
            @endforeach
        </select>
    </div>
    <label for="cam_terminal"
        class="col-sm-12 col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Terminal</label>
    <div class="col-sm-12 col-lg-3">
        <select name="cam_terminal" id="cam_terminal" class="form-control select2" placeholder="Terminal">
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="cam_descripcion"
        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Descripción</label>
    <div class="col-lg-8">
        <input type="text" name="cam_descripcion" class="form-control" id="cam_descripcion" placeholder="Descripcion"
            value="{{old('cam_descripcion', $data->cam_descripcion ?? '')}}" required>
    </div>
</div>

<div class="form-group row">
    <label for="cam_categoria "
        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Categoría</label>
    <div class="col-sm-12 col-lg-4">
        <select name="cam_categoria" id="cam_categoria" class="form-control select2" placeholder="Categoria">
            @foreach ($cat->getCategoria('A') as $item)
            <option value="{{$item->cat_id}}" data-porcentaje="{{$item->cat_porcentaje}}"
                {{old('cam_categoria', $data->cam_categoria ?? '')==$item->cat_id ? 'selected':''}}>
                {{$item->cat_descripcion}}
            </option>
            @endforeach
        </select>
    </div>

    <label for="cam_porcentaje" class="col-lg-1 control-label text-right requerido">Porcentaje</label>
    <div class="col-lg-3">
        <input data-suffix="%" type="number" step="any" min="0" max="100" data-decimals= "2" name="cam_porcentaje" class="form-control" id="cam_porcentaje" placeholder="Porcentaje"
            value="{{old('cam_porcentaje', ($data->cam_porcentaje ?? 0)*100)}}">
    </div>
</div>

<div class="form-group row">
    <label for="cam_inicial" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right ">Valor Inicial</label>
    <div class="col-lg-2">
        <input type="text" name="cam_inicial" class="form-control" id="cam_inicial" placeholder="Valor Inicial"
            value="{{old('cam_inicial', $data->cam_inicial ?? '0')}}" onkeypress='return validaNumericos(event,"D",this.value);'>
    </div>

        <label for="cam_monto" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Monto</label>
        <div class="col-lg-3">
            <input type="text" name="cam_monto" class="form-control" id="cam_monto" placeholder="Valor"
                value="{{old('cam_monto', $data->cam_monto ?? '')}}" required  onkeypress='return validaNumericos(event,"D",this.value);'>
        </div>
    </div>

    <div class="form-group row">
        <label for="cam_fecha" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Fecha de
            Inicio</label>
        <div class="input-group col-sm-12 col-lg-3">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="far fa-calendar-alt"></i>
                </span>
            </div>
            <input type="date" class="form-control float-right" id="cam_fecha" name="cam_fecha"
                value="{{old('cam_fecha', $data->cam_fecha ?? '')}}" required>
        </div>
</div>

<div class="form-group row">
    <label for="cam_amort" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Cuenta
        Amortización</label>
    <div class="col-sm-12 col-lg-8">
        <select name="cam_amort" id="cam_amort" class="form-control select2" placeholder="Cuenta Amortización" required>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="cam_amortAcum" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Cuenta
        Amortización Acumulada</label>
    <div class="col-sm-12 col-lg-8">
        <select name="cam_amortAcum" id="cam_amortAcum" class="form-control select2"
            placeholder="Cuenta Amortización Acumulada" required>

        </select>
    </div>
</div>
