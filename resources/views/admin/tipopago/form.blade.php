<div class="form-group row">
    <label for="tip_nombre" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Nombre</label>
    <div class="col-lg-8">
        <input type="text" name="tip_nombre" class="form-control" id="tip_nombre" placeholder="Nombre"
            value="{{old('tip_nombre', $data->tip_nombre ?? '')}}" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
    </div>
</div>

<div class="form-group row">
    <label for="tip_referencia" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Referencia</label>
    <div class="col-sm-12 col-lg-3">
        <input type="checkbox" name="tip_referencia" id="tip_referencia" value="1"
            {{old('tip_referencia',$data->tip_referencia ?? '1')==1?"checked":""}} data-bootstrap-switch data-off-color="danger"
            data-on-color="success" data-on-text="SI" data-off-text="NO">
    </div>
</div>

<div class="form-group row">
    <label class="col-lg-3 control-label text-right">Documento de Referencia</label>
    <div class="col-lg-8">
        <div class="icheck-midnightblue d-inline">
            <input type="radio" id="accionCarga" name="tip_tabla" value="V" {{old('tip_referencia',$data->tip_referencia??1)==0?"disabled":""}} {{old('tip_tabla',$data->tip_tabla ?? 'V')=='V'?"checked":""}}>
            <label for="accionCarga" class="mr-5">Documentos Varios</label>
        </div>
        <div class="icheck-midnightblue d-inline">
            <input type="radio" id="accionAbona" name="tip_tabla" value="T"  {{old('tip_referencia',$data->tip_referencia??1)==0?"disabled":""}} {{old('tip_tabla',$data->tip_tabla ?? '')=='T'?"checked":""}}>
            <label for="accionAbona">Cheques/Transferencias</label>
        </div>
    </div>
</div>


