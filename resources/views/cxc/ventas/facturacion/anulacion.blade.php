<div class="form-group row">
    <label for="ven_anulada" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Anular</label>
    <div class="col-sm-12 col-lg-3">
        <input type="checkbox" name="ven_anulada" id="ven_anulada" value="0"
            {{old('ven_anulada',$data->ven_a ?? '2')==2?"checked":""}} data-bootstrap-switch data-off-color="danger"
            data-on-color="success" data-on-text="SI" data-off-text="NO">
    </div>
</div>

<input type="hidden" class="form-control float-right" id="ven_persona" name="ven_persona"
 value="{{ $data->ven_persona}}">

<input type="hidden" class="form-control float-right" id="nit" name="nit"
 value="{{$data->Cliente->per_nit}}">

<input type="hidden" class="form-control float-right" id="iiud" name="iiud"
 value="{{$data->ven_iiud}}">

<input type="hidden" class="form-control float-right" id="fecha" name="fecha"
 value="{{\Carbon\Carbon::parse($data->ven_fecha)->format('d/m/Y')}}">

<input type="hidden" class="form-control float-right" id="fechacert" name="fechacert"
 value="{{\Carbon\Carbon::parse($data->ven_fechaCert)->format('d/m/Y')}}">




