<input type="hidden" id="hemp_inicio" name="hemp_inicio"
    value="{{old('rep_inicio',\Carbon\Carbon::parse($data->rep_inicio ?? now())->format('d/m/Y'))}}">
<input type="hidden" id="rep_empresa" name="rep_empresa" value="{{$data->emp_id}}">
<div class="form-group row">
    <label for="rep_representante"
        class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Representante</label>
    <div class="col-sm-12 col-lg-4">
        <select name="rep_representante" id="rep_representante" class="form-control select2"
            placeholder="Representante">
            @foreach ($rep->getRepresentantes() as $item)
            <option value="{{$item->repr_id}}">{{$item->repr_nombre}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="rep_tipo"
        class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Tipo</label>
    <div class="col-sm-12 col-lg-4">
        <select name="rep_tipo" id="rep_tipo" class="form-control select2"
            placeholder="Tipo">
            @foreach ($tip->getTipos() as $item)
            <option value="{{$item->trep_id}}">{{$item->trep_nombre}}</option>
            @endforeach
        </select>
    </div>
</div>

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
    <label for="rep_constancia" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Constancia</label>
    <div class="col-sm-12 col-lg-4">
        <input type="text" name="rep_constancia" class="form-control" id="rep_constancia" placeholder="Constancia" required>
    </div>
</div>
