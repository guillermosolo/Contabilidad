



<p>Esta seguro de anular Invoice</p>


<div class="form-group row">
    <label for="ter_activo" class="col-sm-12 col-lg-3 control-label text-sm-left text-lg-right">Anular Invoice</label>
    <div class="col-sm-12 col-lg-3">
        <input type="checkbox" name="ter_activo" id="ter_activo" value="1"
            {{old('ter_activo',$data->ter_activo ?? '2')==1?"checked":""}} data-bootstrap-switch data-off-color="danger"
            data-on-color="success" data-on-text="SI" data-off-text="NO">
    </div>
</div>










