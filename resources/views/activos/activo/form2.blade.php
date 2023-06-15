<input type="hidden" id="adi_activo" name ="adi_activo" value="{{$data->act_id}}">

<div class="form-group row">
    <label for="adi_propiedad"
        class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Propiedad</label>
    <div class="col-sm-12 col-lg-4">
        <select name="adi_propiedad" id="adi_propiedad" class="form-control select2" placeholder="Categoria">
            @foreach ($prop->getPropiedades() as $item)
            <option value="{{$item->prop_id}}">
                {{$item->prop_nombre}}
            </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="adi_valor" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Valor</label>
    <div class="col-lg-6">
        <input type="text" name="adi_valor" class="form-control" id="adi_valor" placeholder="Valor" required>
    </div>
</div>


