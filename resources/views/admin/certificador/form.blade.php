<div class="form-group row">
    <label for="cer_nombre" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Nombre</label>
    <div class="col-lg-8">
        <input type="text" name="cer_nombre" class="form-control" id="cer_nombre" placeholder="Nombre"
            value="{{old('cer_nombre', $data->cer_nombre ?? '')}}"
            onkeyup="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>

<div class="form-group row">
    <label for="cer_direccion" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right">Dirección</label>
    <div class="col-lg-8">
        <input type="text" name="cer_direccion" class="form-control" id="cer_direccion" placeholder="Dirección"
            value="{{old('cer_direccion', $data->cer_direccion ?? '')}}">
    </div>
</div>

<div class="form-group row">
    <label for="cer_telefono"
        class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right">Teléfono</label>
    <div class="input-group col-sm-12 col-lg-3">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-phone"></i></span>
        </div>
        <input type="text" class="form-control" id="cer_telefono" name="cer_telefono"
            data-inputmask='"mask": "(999) 9999-9999"' value="{{old('cer_telefono', $data->cer_telefono ?? '')}}"
            data-mask onkeypress='return validaNumericos(event,"P")'>
    </div>
</div>

<div class="form-group row">
    <label for="cer_contacto" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right">Contacto</label>
    <div class="col-lg-8">
        <input type="text" name="cer_contacto" class="form-control" id="cer_contacto" placeholder="Contacto"
            value="{{old('cer_contacto', $data->cer_contacto ?? '')}}">
    </div>
</div>


