<input type="hidden" name="rep_empresa" id="rep_empresa" value="{{$data->rep_empresa}}">
<input type="hidden" name="rep_representante" id="rep_representante" value="{{$data->rep_representante}}">
<input type="hidden" name="rep_tipo" id="rep_tipo" value="{{$data->rep_tipo}}">
<input type="hidden" id="hemp_inicio" name="hemp_inicio"
    value="{{old('rep_inicio',\Carbon\Carbon::parse($data->rep_inicio ?? now())->format('d/m/Y'))}}">
<input type="hidden" id="hemp_fin" name="hemp_fin"
    value="{{old('rep_fin',\Carbon\Carbon::parse($data->rep_fin??null)->format('d/m/Y'))}}">
<input type="hidden" id="fecnull" name="fecnull" value="{{is_null($data->rep_fin)}}">
<input type="hidden" id="rep_constanciaold" name="rep_constanciaold" value="{{$data->rep_constancia}}">

<div class="form-group row">
    <label for="rep_inicio" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Inicio</label>
    <div class="input-group col-sm-12 col-lg-3">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="far fa-calendar-alt"></i>
            </span>
        </div>
        <input type="text" class="form-control float-right" id="rep_inicio" name="rep_inicio" required>
    </div>
</div>

<div class="form-group row">
    <label for="rep_fin" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right">Fin</label>
    <div class="input-group col-sm-12 col-lg-3">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="far fa-calendar-alt"></i>
            </span>
        </div>
        <input type="text" class="form-control float-right {{is_null($data->rep_fin)? 'disabled':''}}" id="rep_fin"
            name="rep_fin">
    </div>
    <div class="icheck-midnightblue d-inline">
        <input type="checkbox" id="habilita" name="habilita" value="1" {{$data->rep_tipo==2? 'disabled':''}}
            {{is_null($data->rep_fin)? '':'checked'}}> <label for="habilita">registrar fin</label>
    </div>
</div>

<div class="form-group row">
    <label for="rep_constancia" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Constancia</label>
    <div class="col-sm-12 col-lg-4">
        <input type="text" name="rep_constancia" class="form-control" id="rep_constancia" placeholder="Constancia" value="{{$data->rep_constancia}}" required>
    </div>
</div>
