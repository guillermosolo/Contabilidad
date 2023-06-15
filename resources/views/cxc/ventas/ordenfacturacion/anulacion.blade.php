<div class="form-group row">
    <label for="ordf_anulada" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right requerido">Anular</label>
    <div class="col-sm-12 col-lg-3">
        <input type="checkbox" name="ordf_anulada" id="ordf_anulada" value="0"
            {{old('ordf_anulada',$data->ordf_anulada ?? '2')==2?"checked":""}} data-bootstrap-switch data-off-color="danger"
            data-on-color="success" data-on-text="SI" data-off-text="NO">
    </div>
</div>



<input type="hidden" class="form-control float-right" id="ordf_cliente" name="ordf_cliente"
 value="{{$data->ordf_cliente}}">

<input type="hidden" class="form-control float-right" id="ordf_buque" name="ordf_buque"
 value="{{$data->ordf_buque}}">

 <input type="hidden" class="form-control float-right" id="ordf_viaje" name="ordf_viaje"
 value="{{$data->ordf_viaje}}">

 <input type="hidden" class="form-control float-right" id="ordf_descripcion" name="ordf_descripcion"
 value="{{$data->ordf_descripcion}}">


 <input type="hidden" class="form-control float-right" id="ordf_total" name="ordf_total"
 value="{{$data->ordf_total}}">

 <input type="hidden" class="form-control float-right" id="ordf_moneda" name="ordf_moneda"
 value="{{$data->ordf_moneda}}">

 <input type="hidden" class="form-control float-right" id="ordf_tipoCambio" name="ordf_tipoCambio"
 value="{{$data->ordf_tipoCambio}}">

 <input type="hidden" class="form-control float-right" id="ordf_empresa" name="ordf_empresa"
 value="{{$data->ordf_empresa}}">

 <input type="hidden" class="form-control float-right" id="ordf_terminal" name="ordf_terminal"
 value="{{$data->ordf_terminal}}">

 <input type="hidden" class="form-control float-right" id="ordf_correlativoInt" name="ordf_correlativoInt"
 value="{{$data->ordf_correlativoInt}}"


<input type="hidden" class="form-control float-right" id="ordf_eta" name="ordf_eta"
 value="{{\Carbon\Carbon::parse($data->ordf_eta)->format('d/m/Y')}}">



