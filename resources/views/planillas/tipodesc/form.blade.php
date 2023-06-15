<fieldset class="border p-2 col-sm-12 col-lg-12">
    <legend class="w-auto">Ingrese la informacion requerida</legend>
    <div class="form-group row">
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="tipd_descripcion" class="col-md-12 col-sm-12 col-lg-4 text-sm-left text-lg-right requerido">Descripcion</label>
                <div class="col-md-12 col-lg-7">
                    <input type="text" class="form-control" id="tipd_descripcion" name="tipd_descripcion" maxlength="50"
                           value="{{old('tipd_descripcion',$tipd->tipd_descripcion ?? '' )}}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="tipd_forma" class="col-md-12 col-sm-12 col-lg-3 control-label text-sm-left text-lg-right">Forma</label>
                <div class="col-md-12 col-lg-7">
                    <select class="form-control select2" id="tipd_forma" name="tipd_forma">
                        <option value="F" {{old('tipd_forma',$tipd->tipd_forma ?? null)=='F' ? 'selected':''}}>FIJO</option>
                        <option value="P" {{old('tipd_forma',$tipd->tipd_forma ?? null)=='P' ? 'selected':''}}>PORCENTUAL</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 mb-3">
            <div class="row">
                <label for="tipd_clase" class="col-md-12 col-sm-12 col-lg-4 control-label text-sm-left text-lg-right">Clase</label>
                <div class="col-md-12 col-lg-7">
                    <select class="form-control select2" id="tipd_clase" name="tipd_clase">
                        <option value="B" {{old('tipd_clase',$tipd->tipd_clase ?? null)=='B' ? 'selected':''}}>BONIFICACION</option>
                        <option value="D" {{old('tipd_clase',$tipd->tipd_clase ?? null)=='D' ? 'selected':''}}>DESCUENTO</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</fieldset>
