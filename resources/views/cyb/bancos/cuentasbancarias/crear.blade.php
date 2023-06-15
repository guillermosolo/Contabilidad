@extends("layout.layout")
@section("titulo")
    Cuentas Bancarias
@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
@endsection

@section('scripts')
    <script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cyb/bancos/cuentasbancarias/crear.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
    <script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cxc/nabono\orden.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('cuentasbancarias.crear') }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/bancos/cuentasbancarias')}}">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.form-error')
                    @include('includes.mensaje')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Apertura de Cuenta Bancaria<small></small></h3>
                            <div class="card-tools">
                                <a href="{{route('cuentasbancarias')}}" class="btn btn-block btn-info btn-sm">
                                    Volver al Catálogo<i class="fas fa-arrow-circle-left pl-1"></i></a>
                            </div>
                        </div>

                            <form action="{{route('cuentasbancarias.guardar')}}" class="form-horizontal" method="post" id="form-general" autocomplete="off">
                                    <div class="card-body">
                                            <input type="hidden" id="cuentaContable" value="{{old('ctab_cuentacontable')}}">
                                        <input type="hidden" id="ctaPath" value="{{url('contabilidad/ctaCuentaPorNivel')}}">
                                        <div class="form-group row">
                                            @csrf
                                            <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right" >Número de Cuenta</label>
                                            <div class="col-sm-12 col-lg-10">
                                                <input name="ctab_numero" type="text" class="form-control" id="exampleInputEmail1" maxlengt="25" required value="{{old('ctab_numero')}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Nombre de la Empresa</label>
                                            <div class="col-sm-12 col-lg-10">
                                                <select name="ctab_empresa" class="form-control select2" id="inputempresa" required>
                                                    <option value="">Selecciona empresa</option>
                                                    @foreach (auth()->user()->Empresas as $item)
                                                        <option value="{{$item->emp_id}}"{{old('ctab_empresa')==$item->emp_id ? 'selected':''}}>{{$item->emp_siglas}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Tipo de Cuenta</label>
                                            <div class="col-sm-12 col-lg-4">
                                                <select name="ctab_tipo" class="form-control select2" id="inputtipocuenta" required>
                                                    <option value="">Tipo de cuenta</option>
                                                    @foreach($tipocuentas as $tipocuenta)
                                                        <option value="{{$tipocuenta['tcb_id']}}"{{old('ctab_tipo')==$tipocuenta['tcb_id']?'selected':''}}>{{$tipocuenta['tcb_descripcion']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Banco</label>
                                            <div class="col-sm-12 col-lg-4">
                                                <select name="ctab_banco" class="form-control select2" id="inputbancos" required>
                                                    <option value="">Seleccione Bancos</option>
                                                    @foreach($bancoss as $bancos)
                                                        <option value="{{$bancos['ban_id']}}"{{old('ctab_banco'?'selected':'')}}>{{$bancos['ban_nombre']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Moneda</label>
                                            <div class="col-sm-12 col-lg-4">
                                                <select name="ctab_moneda" class="form-control select2" id="inputmoneda" required>
                                                    @foreach($monedas as $moneda)
                                                        <option value="{{$moneda['mon_id']}}"{{old('ctab_moneda'?'selected':'')}}>{{$moneda['mon_nombre']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Cuenta Contable</label>
                                            <div class="col-sm-12 col-lg-4">
                                                <select name="ctab_cuentacontable" class="form-control select2" id="inputcuentacontable" required>
                                                    <option value="{{old('ctab_cuentacontable')}}">Seleccione cuenta</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Contacto</label>
                                            <div class="col-sm-12 col-lg-4">
                                                <input name="ctab_contacto" type="text" class="form-control" id="inputcontacto" value="{{old('ctab_contacto')}}">
                                            </div>
                                            <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Teléfono</label>
                                            <div class="col-sm-12 col-lg-4">
                                                <input name="ctab_telefono" type="text" class="form-control" id="inputtelefono" value="{{old('ctab_telefono')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer" >
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
