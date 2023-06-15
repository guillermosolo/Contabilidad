<div class="form-group row">
    <label for="tpp_nombre" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Nombre</label>
    <div class="col-lg-8">
        <input type="text" name="tpp_nombre" class="form-control" id="tpp_nombre" placeholder="Nombre"
            value="{{old('tpp_nombre', $data->tpp_nombre ?? '')}}" required>
    </div>
</div>

<div class="form-group row">
    <label for="tpp_nickname" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Descripción Corta</label>
    <div class="col-lg-2">
        <input type="text" name="tpp_nickname" class="form-control" id="tpp_nickname" placeholder="Nickname"
            value="{{old('tpp_nickname', $data->tpp_nickname ?? '')}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-3 control-label text-right requerido">Clasificación</label>
    <div class="col-lg-8">
        <div class="icheck-midnightblue d-inline">
            <input type="radio" id="accionCarga" name="tpp_clasificacion" value="C" {{old('tpp_clasificacion',$data->tpp_clasificacion ?? 'C')=='C'?"checked":""}}>
            <label for="accionCarga" class="mr-5">Cliente</label>
        </div>
        <div class="icheck-midnightblue d-inline">
            <input type="radio" id="accionAbona" name="tpp_clasificacion" value="P" {{old('tpp_clasificacion',$data->tpp_clasificacion ?? '')=='P'?"checked":""}}>
            <label for="accionAbona">Proveedor</label>
        </div>
    </div>
</div>


