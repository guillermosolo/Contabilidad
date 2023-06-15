<input type="hidden" name="nuevo" value="{{empty($persona->per_nit)}}">
<input type="hidden" name="pro_persona" value="{{old('pro_persona',$persona->per_id??'')}}">
<div class="row">
    <div class="col-lg-1"></div>
    <fieldset class="border p-2 col-sm-12 col-lg-10">
        <legend class="w-auto">Datos de Proveedor</legend>
        <div class="form-group row">
            <label for="pro_tipoProveedor"
                class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Tipo de Proveedor</label>
            <div class="col-sm-12 col-lg-4">
                <select name="pro_tipoProveedor" id="pro_tipoProveedor" class="form-control select2"
                    placeholder="Tipo de Proveedor">
                    @foreach ($tipo->getTiposProveedor() as $item)
                    <option value="{{$item->tpp_id}}"
                        {{old('pro_tipoProveedor',$data->pro_tipoProveedor ?? '')==$item->tpp_id ? 'selected':''}}>
                        {{$item->tpp_nombre}}</option>
                    @endforeach
                </select>
            </div>

            <label for="pro_credito" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Días
                de Crédito</label>
            <div class="col-lg-3">
                <input type="number" step="any" min=0 data-decimals=0 name="pro_credito" class="form-control"
                    id="pro_credito" placeholder="0" value="{{old('pro_credito', $data->pro_credito ?? '0')}}">
            </div>
        </div>
    </fieldset>
</div>

<div class="row">
    <div class="col-lg-1"></div>
    <fieldset class="border p-2 col-sm-12 col-lg-10">
        <legend class="w-auto">Datos de Persona</legend>
        @if(!empty($persona->per_nit))
        <div class="form-group row">
            <div class="col-sm-10"></div>
            <div class="col-sm-2">
                <div class="icheck-midnightblue d-inline">
                    <input type="checkbox"  id="editar" name="editar" value="1">
                    <label for="editar">Editar Datos
                    </label>
                    </div>
            </div>
        </div>
        @endif
        <div class="form-group row">
            <label for="per_nit"
                class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">NIT</label>
            <div class="col-sm-12 col-lg-4">
                <input type="text" name="per_nit" class="form-control disabled" id="per_nit" placeholder="NIT"
                    value="{{old('per_nit', $persona->per_nit ?? $persona["nit"])}}"
                    onkeypress='return validaNumericos(event,"N");'
                    onkeyup="javascript:this.value=this.value.toUpperCase();" required>
            </div>

            <label for="per_cui" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">CUI</label>
            <div class="col-sm-12 col-lg-4">
                <input type="text" name="per_cui" class="form-control editable" id="per_cui" placeholder="CUI"
                    value="{{old('per_cui', $persona->per_cui ?? '')}}" onkeypress='return validaNumericos(event,"P");' {{!empty($persona->per_nit)?"disabled":""}}>
            </div>
        </div>
        <div class="form-group row">
            <label for="per_nombre"
                class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Nombre</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control editable" id="per_nombre" name="per_nombre" placeholder="Nombre"
                    value="{{old('per_nombre',$persona->per_nombre??'')}}" required {{!empty($persona->per_nit)?"disabled":""}}>
            </div>
        </div>

        <div class="form-group row">
            <label for="per_direccion"
                class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Dirección</label>
            <div class="col-sm-12 col-lg-9">
                <input type="text" class="form-control editable" id="per_direccion" name="per_direccion" placeholder="Dirección"
                    value="{{old('per_direccion',$persona->per_direccion??'')}}" required {{!empty($persona->per_nit)?"disabled":""}}>
            </div>
        </div>

        <div class="form-group row">
                <label for="per_telefono"
                    class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Teléfono</label>
                <div class="input-group col-sm-12 col-lg-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" class="form-control editable" id="per_telefono" name="per_telefono"
                        data-inputmask='"mask": "(999) 9999-9999"'
                        value="{{old('per_telefono', $persona->per_telefono ?? '')}}" data-mask
                        onkeypress='return validaNumericos(event,"P")' {{!empty($persona->per_nit)?"disabled":""}}>
                </div>

            <label for="per_contacto"
                class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Contacto</label>
            <div class="col-sm-12 col-lg-6">
                <input type="text" class="form-control editable" id="per_contacto" name="per_contacto" placeholder="Contacto"
                    value="{{old('per_contacto',$persona->per_contacto??'')}}" {{!empty($persona->per_nit)?"disabled":""}}>
            </div>
        </div>

        <div class="form-group row">
            <label for="per_email" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Correo
                Electrónico</label>
            <div class="input-group col-sm-12 col-lg-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-at"></i>
                    </span>
                </div>
                <input type="email" name="per_email" id="per_email" class="form-control editable"
                    placeholder="Correo Electrónico" value="{{old('per_email',$persona->per_email ?? '')}}" {{!empty($persona->per_nit)?"disabled":""}}>
            </div>

            <label for="per_email" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Tipo de
                Contribuyente</label>
            <div class="col-sm-12 col-lg-4">
                <select name="per_tipoContribuyente" id="per_tipoContribuyente" class="form-control select2 editable"
                    placeholder="Tipo de Contribuyente" {{!empty($persona->per_nit)?"disabled":""}}>
                    @foreach ($tipoC->getTiposContribuyente() as $item)
                    <option value="{{$item->tpc_id}}"
                        {{old('per_tipoContribuyente',$persona->per_tipoContribuyente ?? '')==$item->tpc_id ? 'selected':''}}>
                        {{$item->tpc_nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </fieldset>
</div>
