@extends("layout.layout")
@section("titulo")
    Transferencias de Terceros
@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
@endsection

@section('scripts')
    <script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
    <script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cyb/bancos/transferencias/deterceros/crear2.js")}}" type="text/javascript"></script>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('chequedeter.crear') }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/bancos/transferencias/de-terceros')}}">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.form-error')
                    @include('includes.mensaje')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Completar Formulario<small></small></h3>
                            <div class="card-tools">
                                <a href="{{route('chequedeter')}}" class="btn btn-block btn-info btn-sm">
                                    Regresar a la Lista<i class="fas fa-arrow-circle-left pl-1"></i></a>
                            </div>
                        </div>

                        <form action="{{route('chequedeter.guardar')}}" class="form-horizontal" method="post" id="form-general" method="post" autocomplete="off">
                            <input type="hidden" id="empPath" value="{{url('parametros/terminal/cuentabancaria')}}">
                            <input type="hidden" id="codigocuenta" value="{{old('che_cuentabancaria')}}">
                            <input type="hidden" id="codigoterminal" value="{{old('che_terminal')}}">

                                <div class="card-body">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Cuenta Bancaria a Acreditar</label>
                                        <div class="col-sm-12 col-lg-4">
                                            <select name="trab_cuentabancaria" class="form-control select2" id="inputcuentabancariacre" required>
                                                <option value="1">Seleccione una cuenta</option>
                                                @foreach($cuentasbancariass as $cuentasbancarias)
                                                    <option value="{{$cuentasbancarias->ctab_id}}">{{$cuentasbancarias->ctab_numero}} - {{$cuentasbancarias->Empresa->emp_siglas}} - {{$cuentasbancarias->Banco->ban_siglas}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="act_fechaAlta" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Fecha de Referencia</label>
                                        <div class="input-group col-sm-12 col-lg-4">
                                            <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputfechareferencia">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                            </div>
                                            <input type="text" class="form-control float-right" id="inputfecha" name="trab_fecha"
                                                   value="{{old('trab_fecha')}}" required>
                                        </div>
                                        <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Numero de Documento</label>
                                        <div class="col-sm-12 col-lg-4">
                                            <input name="trab_documento" type="text" class="form-control" id="monto" maxlengt="25" required value="{{old('trab_documento')}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido" requerido>Monto</label>
                                        <div class="col-sm-12 col-lg-4">
                                            <input name="trab_monto" type="text" class="form-control" id="inputnumeroreferencia" aria-describedby="emailHelp" maxlengt="25" required value="{{old('trab_monto')}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido" >Descripción</label>
                                        <div class="col-sm-12 col-lg-10">
                                            <textarea name="trab_descripcion"class="form-control" id="inputdescripcion" rows="3" required placeholder="Ingrese una descripción..." >{{old('trab_descripcion')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Tipo</label>
                                        <div class="col-sm-12 col-lg-4">
                                            <select name="trab_tipo" class="form-control select2" id="tipodeterceros" required>
                                                <option value=>Seleccione tipo</option>
                                                    <option value="DE">Depósito</option>
                                                    <option value="TD">Transferencia</option>
                                            </select>
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


