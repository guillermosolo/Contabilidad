@extends("layout.layout")
@section("titulo")
    Transferencias a Terceros
@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
    <style>
        select[readonly] ~ .select2.select2-container .selection [role="combobox"] {
            background: repeating-linear-gradient(135deg, #dadada, #dadada 10px, rgba(255, 255, 255, 0.66) 10px, rgba(255, 255, 255, 0.66) 20px) !important;
            box-shadow: inset 0 0 0px 1px #77859133;
        }
    </style>
@endsection

@section('scripts')
    <script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
    <script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cyb/bancos/transferencias/crear.js")}}" type="text/javascript"></script>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('chequeater.crear') }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/bancos/transferencias')}}">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.form-error')
                    @include('includes.mensaje')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Edición de Registros<small></small></h3>
                            <div class="card-tools">
                                <a href="{{route('chequeater')}}" class="btn btn-block btn-info btn-sm">
                                    Regresar a la Lista<i class="fas fa-arrow-circle-left pl-1"></i></a>
                            </div>
                        </div><br>

                        <form action="{{route('chequedeter.guardar', ['id'=>$aterceros['che_id']])}}" class="form-horizontal" method="post" id="form-general" method="post" autocomplete="off">
                            <input type="hidden" id="empPath" value="{{url('parametros/terminal/cuentabancaria')}}">
                            <input type="hidden" id="codigocuenta" value="{{old('che_cuentabancaria')}}">
                            <input type="hidden" id="codigoterminal" value="{{old('che_terminal')}}">
                            <div class="form-group row">
                                <div class="card-body">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Cuenta Bancaria a Debitar</label>
                                        <div class="col-sm-12 col-lg-4">
                                            <select name="che_cuentabancaria" class="form-control" id="inputcuentabancaria" required readonly="">
                                                <option value="">Seleccione una cuenta</option>
                                                @foreach($cuentasbancariass as $cuentasbancarias)
                                                    <option value="{{$cuentasbancarias->ctab_id}}"{{($aterceros->che_cuentabancaria ??'')==$cuentasbancarias->ctab_id ? 'selected':''}}>{{$cuentasbancarias->ctab_numero}} - {{$cuentasbancarias->Empresa->emp_siglas}} - {{$cuentasbancarias->Banco->ban_siglas}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido" requerido>Numero de Referencia</label>
                                        <div class="col-sm-12 col-lg-10">
                                            <input name="che_numero" type="text" class="form-control" readonly id="inputnumeroreferencia" aria-describedby="emailHelp" maxlengt="25" required value="{{old('che_numero', $aterceros->che_numero)}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="act_fechaAlta" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Fecha de Referencia</label>
                                        <div class="input-group col-sm-12 col-lg-3">
                                            <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputfechareferencia"  value="{{old('inputfechareferencia', Carbon\Carbon::parse($aterceros->che_fecNac??'')->format('d/m/Y'))}}" >
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                            </div>
                                            <input type="text" class="form-control float-right" id="inputfecha" name="che_fecha"
                                                   value="{{old('che_fecha')}}" required>
                                        </div>
                                        <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Monto</label>
                                        <div class="col-sm-12 col-lg-5">
                                            <input name="che_monto" type="text" readonly class="form-control" id="monto" maxlengt="25" required value="{{old('che_monto', $aterceros->che_monto)}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido" >Beneficiario</label>
                                        <div class="col-sm-12 col-lg-10">
                                            <input name="che_beneficiario" type="text" class="form-control" readonly id="inputbeneficiario" maxlengt="25" required value="{{old('che_beneficiario', $aterceros->che_beneficiario)}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido" >Descripción</label>
                                        <div class="col-sm-12 col-lg-10">
                                            <textarea name="che_descripcion"class="form-control" id="inputdescripcion" rows="3" required placeholder="Ingrese una descripción..." value="{{old('che_descripcion', $aterceros->che_descripcion)}}"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">¿Es negociable?</label>
                                        <div class="col-sm-12 col-lg-4">
                                            <select name="che_negociable" class="form-control" id="inputnegociable" required value="{{old('che_negociable')}}">
                                                <option value="">- - - -</option>
                                                <option value="0" {{old('che_tipo',$aterceros->che_negociable ?? null)==0 ? 'selected':''}}>No negociable</option>
                                                <option value="1" {{old('che_tipo',$aterceros->che_negociable ?? null)==1 ? 'selected':''}}>Negociable</option>
                                            </select>
                                        </div>
                                        <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Tipo</label>
                                        <div class="col-sm-12 col-lg-4">
                                            <select name="che_tipo" class="form-control" id="inputtipo" required value="{{old('che_tipo')}}" readonly="">
                                                <option value="CH" {{old('che_tipo',$aterceros->che_tipo ?? null)=='CH' ? 'selected':''}}>Cheque</option>
                                                <option value="TT" {{old('che_tipo',$aterceros->che_tipo ?? null)=='TT' ? 'selected':''}}>Transferencia a Terceros</option>
                                                <option value="TR" {{old('che_tipo',$aterceros->che_tipo ?? null)=='TR' ? 'selected':''}}>Transferencia a Relacionados</option>
                                                <option value="TI" {{old('che_tipo',$aterceros->che_tipo ?? null)=='TI' ? 'selected':''}}>Transferencia Interna</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Tipo de Cambio</label>
                                        <div class="col-sm-12 col-lg-4">
                                            <input name="che_tc" type="text" class="form-control" id="inputcambio" value="{{old('che_tc', $aterceros->che_tc)}}" readonly>
                                        </div>
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

