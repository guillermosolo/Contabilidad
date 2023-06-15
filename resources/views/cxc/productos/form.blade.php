<input type="hidden" id="empPath" value="{{ url('parametros/terminal') }}">
<input type="hidden" id="ctaPath" value="{{ url('contabilidad/ctaContable') }}">
<input type="hidden" id="empCod" value="{{ old('prod_empresa', $data->prod_empresa ?? '') }}">
<input type="hidden" id="terCod" value="{{ old('prod_terminal', $data->prod_terminal ?? '') }}">
<input type="hidden" id="produPath" value="{{ url('productos/abuelo') }}">
<input type="hidden" id="productoPath" value="{{ url('productos/padre') }}">



<div class="form-group row">
    <label for="prod_empresa"
        class="col-sm-12 col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Empresa</label>
    <div class="col-sm-12 col-lg-2">
        <select name="prod_empresa" id="prod_empresa" class="form-control select2" placeholder="Empresa" required>
            <option value=""></option>
            @foreach (auth()->user()->Empresas as $item)
                <option value="{{ $item->emp_id }}"
                    {{ old('prod_empresa', $data->prod_empresa ?? '') == $item->emp_id ? 'selected' : '' }}>
                    {{ $item->emp_siglas }}</option>
            @endforeach
        </select>
    </div>
    <label for="prod_terminal"
        class="col-sm-12 col-lg-4 control-label text-sm-left text-lg-right requerido">Terminal</label>
    <div class="col-sm-12 col-lg-2">
        <select name="prod_terminal" id="prod_terminal" class="form-control select2" placeholder="Terminal" required>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="prod_padre1"
        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Categoría</label>
    <div class="col-sm-12 col-lg-4">
        <select name="prod_padre1" id="prod_padre1" class="form-control select2" placeholder="Categoría" required>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="prod_padre"
        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Sub Categoría</label>
    <div class="col-sm-12 col-lg-4">
        <select name="prod_padre" id="prod_padre" class="form-control select2" placeholder="Categoría" required>

        </select>
    </div>
</div>

<div class="form-group row">
    <label for="prod_cuentacontable"
        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Cuenta Contable</label>
    <div class="col-sm-12 col-lg-4">
        <select name="prod_cuentacontable" id="prod_cuentacontable" class="form-control select2" placeholder="Categoría"
            required>
        </select>
    </div>
</div>


<div class="form-group row">
    <label for="prod_desc_3lg" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Descripción
        Larga</label>
    <div class="col-lg-8">
        <input type="text" name="prod_desc_lg" class="form-control" id="prod_desc_lg" placeholder="Descripcion Larga"
            value="{{ old('prod_desc_lg', $data->prod_desc_lg ?? '') }}" required>
    </div>
</div>


<div class="form-group row">
    <label for="prod_desc_ct" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Descripción
        Corta</label>
    <div class="col-lg-8">
        <input type="textsd" name="prod_desc_ct" class="form-control" id="prod_desc_ct"
            placeholder="Descripcion Corta" value="{{ old('prod_desc-ct', $data->prod_desc_ct ?? '') }}">
    </div>
</div>


<div class="form-group row">
    <label for="prod_codigo" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Código
        Producto</label>
    <div class="col-lg-2">
        <input type="text" name="prod_codigo" class="form-control" id="prod_codigo" placeholder="Código"
        disabled value="{{ old('prod_codigo', $data->prod_codigo ?? '') }}">
    </div>
</div>

<div class="form-group row">
    <label for="prod_tipo"
        class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido">Bien/Servicio</label>
    <div class="col-lg-2">
        <select class="form-control" name="prod_tipo" id="prod_tipo"
       >
        <option value="B ">BIEN </option>
        <option value="S">SERVICIO  </option>

    </select>

    </div>
</div>
