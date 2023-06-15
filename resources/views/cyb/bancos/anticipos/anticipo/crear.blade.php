@extends("layout.layout")
@section("titulo")
Anticipos
@endsection

@section('styles')
<link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet"
    type="text/css" />
<link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
@endsection

@section('scripts')
<script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
<script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
<script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
<script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
<script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
<script src="{{asset("assets/pages/scripts/cyb/cajas/anticipo/crear.js")}}" type="text/javascript"></script>
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('anticipos.crear') }}
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('cyb/bancos/anticipos/crear')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.form-error')
                @include('includes.mensaje')
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Generar un Anticipo<small></small></h3>
                        <div class="card-tools">
                            <a href="{{route('anticipos')}}" class="btn btn-block btn-info btn-sm">
                                Volver al Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                        <form action="{{route('anticipos.guardar')}}" class="form-horizontal" method="post" id="form-general">
                            <div class="card-body">
                            <input type="hidden" id="empPath" value="{{url('parametros/terminal/cuentabancaria')}}">
                            <input type="hidden" id="codigocuenta" value="{{old('che_cuentabancaria')}}">
                            <input type="hidden" id="codigoterminal" value="{{old('che_terminal')}}">

                                <div class="form-group row">
                                    @csrf
                                    <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Cuenta Bancaria a Acreditar</label>
                                    <div class="col-sm-12 col-lg-4">
                                        <select name="che_cuentabancaria" class="form-control select2"
                                            id="inputcuentabancaria" required>
                                            <option value="">Seleccione una cuenta</option>
                                            @foreach($cuentasbancariass as $cuentasbancarias)
                                            <option value="{{$cuentasbancarias->ctab_id}}"
                                                {{old('che_cuentabancaria')==$cuentasbancarias->ctab_id ? 'selected':''}}>
                                                {{$cuentasbancarias->ctab_numero}} -
                                                {{$cuentasbancarias->Empresa->emp_siglas}} -
                                                {{$cuentasbancarias->Banco->ban_siglas}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label for="prod_terminal"
                                        class="col-md-12 col-sm-12 col-lg-2 text-sm-left text-lg-right requerido">Terminal</label>
                                    <div class="col-sm-12 col-lg-4">
                                        <select name="che_terminal" id="inputterminal" class="form-control select2"
                                            placeholder="Terminal" required>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                        <label for="act_fechaAlta"
                                            class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Fecha</label>
                                        <div class="input-group col-sm-12 col-lg-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control float-right" id="inputfechaanticipo"
                                                name="che_fecha" value="{{old('ant_fecha')}}" required>
                                        </div>
                                        <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Numero de Cheque</label>
                                        <div class="col-sm-12 col-lg-4">
                                            <input name="che_numero" type="text" value="{{old('che_numero')}}" class="form-control" id="inputcheque" required>
                                        </div>
                                </div>

                                <div class="form-group row">
                                    <label for="per_nit"
                                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Proveedores</label>
                                    <div class="col-sm-12 col-lg-4">
                                        <select name="che_beneficiario" class="form-control select2" id="inputbeneficiario">
                                            <option value="0">No aplica</option>
                                            @foreach($proveedores as $proveedor)
                                            <option value="{{$proveedor['pro_id']}}"
                                                {{old('che_beneficiario')==$proveedor['pro_id'] ? 'selected':''}}>
                                                {{$proveedor['pro_id']}} - {{$proveedor->Persona->per_nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label for="per_nit"
                                        class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Monto</label>
                                    <div class="col-sm-12 col-lg-4">
                                        <input name="che_monto" type="text" class="form-control"
                                            value="{{old('che_monto')}}" id="inputmonto" required>
                                    </div>
                                </div>
                                <div class="form-group row" id="beneficiario">
                                    <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Beneficiario</label>
                                    <div class="col-sm-12 col-lg-4">
                                        <input name="beneficiario" type="text" class="form-control" id="inputcheque">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Descripción</label>
                                    <div class="col-sm-12 col-lg-10">
                                        <textarea name="che_descripcion" class="form-control" id="inputdescripcion" rows="3"
                                            required
                                            placeholder="Ingrese una descripción...">{{old('che_descripcion')}}</textarea>
                                    </div>
                                </div>
                            </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-4 text-center">
                                            @include('includes.boton-form-crear')
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>

@endsection
