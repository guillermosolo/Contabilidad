@extends("layout.layout")
@section("titulo")
    Cuentas Bancarias
@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
    <style>
        select[readonly] ~ .select2.select2-container .selection [role="combobox"] {
            background: repeating-linear-gradient(135deg, #dadada, #dadada 10px, rgba(255, 255, 255, 0.66) 10px, rgba(255, 255, 255, 0.66) 20px) !important;
            box-shadow: inset 0 0 0px 1px #77859133;
        }
    </style>
@endsection

@section('scripts')
    <script src="{{asset("assets/pages/scripts/cyb/bancos/cuentasbancarias/crear.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
    <script src="{{asset("assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js")}}"></script>
    <script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
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
                        </div><br>

                        <form action="{{route('cuentasbancarias.actualizar', ['id'=>$cuentasbancariass->ctab_id])}}" class="form-horizontal" method="post" id="form-general" autocomplete="off" >
                            <div class="form-group row">
                                <div class="card-body">
                                    <input type="hidden" id="cuentaContable" value="{{old('ctab_cuentacontable', $cuentasbancariass->ctab_cuentacontable)}}">
                                    <input type="hidden" id="ctaPath" value="{{url('contabilidad/ctaCuentaPorNivel')}}">
                                    <input type="hidden" id="empresa" value="{{$cuentasbancariass->ctab_empresa}}">
                                    <div class="form-group row">
                                        @csrf
                                        @method('PUT')
                                        <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Número de Cuenta</label>
                                        <div class="col-sm-12 col-lg-10">
                                            <input name="ctab_numero" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" maxlengt="25"
                                                   required value="{{$cuentasbancariass->ctab_numero}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Nombre de la Empresa</label>
                                        <div class="col-sm-12 col-lg-10">
                                            <input name="ctab_empresa" type="text" class="form-control" value="{{$cuentasbancariass->ctab_empresa}}" hidden readonly>
                                            <input type="text" class="form-control" value="{{$cuentasbancariass->Empresa->emp_siglas}}" readonly>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Tipo de Cuenta</label>
                                        <div class="col-sm-12 col-lg-4">
                                            <input name="ctab_tipo" type="text" class="form-control" value="{{$cuentasbancariass->ctab_tipo}}" hidden readonly>
                                            <input type="text" class="form-control" value="{{$cuentasbancariass->Tipo->tcb_descripcion}}" readonly>

                                        </div>

                                        <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Banco</label>
                                        <div class="col-sm-12 col-lg-4">
                                                <input name="ctab_banco" type="text" class="form-control" value="{{$cuentasbancariass->ctab_banco}}" hidden readonly>
                                                <input type="text" class="form-control" value="{{$cuentasbancariass->Banco->ban_siglas}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Moneda</label>
                                        <div class="col-sm-12 col-lg-4">
                                            <input name="ctab_moneda" type="text" class="form-control" value="{{$cuentasbancariass->ctab_moneda}}" hidden readonly>
                                            <input type="text" class="form-control" value="{{$cuentasbancariass->Moneda->mon_nombre}}" readonly>
                                        </div>
                                        <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Cuenta Contable</label>
                                        <div class="col-sm-12 col-lg-4">
                                            <input name="ctab_cuentacontable" type="text" class="form-control" value="{{$cuentasbancariass->ctab_cuentacontable}}" hidden readonly>
                                            <input type="text" class="form-control" value="{{$cuentasbancariass->Contable->cta_descripcion}}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Contacto</label>
                                        <div class="col-sm-12 col-lg-4">
                                            <input name="ctab_contacto" type="text" class="form-control" id="inputcontacto" value="{{$cuentasbancariass->ctab_contacto}}">
                                        </div>
                                        <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Teléfono</label>
                                        <div class="col-sm-12 col-lg-4">
                                            <input name="ctab_telefono" type="text" class="form-control" id="inputtelefono" value="{{$cuentasbancariass->ctab_telefono}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" >
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4 text-center">
                                        @include('includes.boton-form-editar')
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
