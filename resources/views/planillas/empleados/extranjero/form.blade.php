<fieldset class="border p-2 col-sm-12 col-lg-12">
    <legend class="w-auto">Datos del Empleo</legend>
    <div class="form-group row">
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="trex_ocupacion" class="col-md-12 col-sm-12 col-lg-3 text-sm-left text-lg-right requerido">Ocupacion</label>
                <div class="col-md-12 col-lg-9">
                    <input type="text" class="form-control" id="trex_ocupacion" name="trex_ocupacion" maxlength="4"
                           value="{{old('trex_ocupacion')}}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="trex_pais"
                       class="col-md-12 col-sm-12 col-lg-2 text-sm-left text-lg-right requerido">Pais</label>
                <div class="col-md-12 col-lg-8">
                    <select class="form-control select2" id="trex_pais" name="trex_pais" required>
                        @foreach ($pais->getPaises() as $item)
                            <option
                                value="{{$item->pai_id}}"{{old('trex_pais')==$item->pai_id ? 'selected':''}}>
                                {{$item->pai_descripcion}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 mb-3">
            <div class="row">
                <label for="trex_motivo" class="col-md-12 col-sm-12 col-lg-1 text-sm-left text-lg-right requerido">Motivo</label>
                <div class="col-md-12 col-lg-10">
                    <input type="text" class="form-control" id="trex_motivo" name="trex_motivo" maxlength="50"
                           value="{{old('trex_motivo')}}" required>
                </div>
            </div>
        </div>
        <input type="text" hidden name="more_ext" id="more_ext">
    </div>
</fieldset>

