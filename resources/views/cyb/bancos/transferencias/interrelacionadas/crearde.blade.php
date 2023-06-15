@extends('layout.layout')

@section("titulo")
    Transferencias De Relacionadas
@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
@endsection

@section('scripts')
    <script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
    <script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cyb/bancos/transferencias/relacionados/relacion.js")}}" type="text/javascript"></script>
@endsection


@section('breadcrumbs')
    {{ Breadcrumbs::render('derelacionadas.crear') }}
@endsection
@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/bancos/transferencias/a-terceros')}}">
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
                                <a href="{{route('derelacionadas')}}" class="btn btn-block btn-info btn-sm">
                                    Regresar a la Lista<i class="fas fa-arrow-circle-left pl-1"></i></a>
                            </div>
                        </div>
                        <br>
                        <form action="{{route('relacionadas.crear')}}" class="form-horizontal">
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4 text-center">
                                    <div class="col-lg-12">
                                        <fieldset class="border p-2 col-sm-12 col-lg-12">
                                            <button type="submit" class="btn btn-outline-dark">A Relacionadas</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                            <button type="button" class="btn btn-dark active">De Relacionadas</button>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <form action="{{route('derelacionadas.guardar')}}" class="form-horizontal" method="post"
                              id="form-general" autocomplete="off">
                            <input type="hidden" id="ctaPath" value="{{url('cyb/bancos/transferencias/filtro')}}">
                            <input type="hidden" id="terPath" value="{{url('parametros/terminal')}}">
                            <input type="hidden" id="codigoterdeb" value="{{old('che_terminal')}}">
                            <input type="hidden" id="codigoempdeb" value="{{old('dlcc_empresa')}}">
                            <input type="hidden" id="codigocuentadeb" value="{{old('che_cuentabancaria')}}">
                            <input type="hidden" id="codigoterminaldeb" value="{{old('che_terminal')}}">
                            <input type="hidden" id="codigotercre" value="{{old('che_terminal2')}}">
                            <input type="hidden" id="codigoempcre" value="{{old('dlcc_empresacre')}}">
                            <input type="hidden" id="codigocuentacre" value="{{old('che_cuentabancaria2')}}">
                            <input type="hidden" id="codigoterminalcre" value="{{old('che_terminal2')}}">

                            <div class="card-body">

                                <fieldset class="card-body">
                                    @csrf

                                    <div class="form-group row">
                                        <div class="col-sm-12 col-lg-6">
                                            <fieldset class="border p-2 col-sm-12 col-lg-12">
                                                <legend class="w-auto"><strong>Cuenta a Acreditar</strong></legend>

                                                <div class="form-group row">
                                                    <label for="inputempresadeb"
                                                           class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Empresa</label>
                                                    <div class="col-sm-12 col-lg-10">
                                                        <select name="dlcc_empresa" class="form-control select2" id="inputempresadeb" required>
                                                            <option value="">Seleccione la Empresa</option>
                                                            @foreach (auth()->user()->Empresas as $empresa)
                                                                <option
                                                                    value="{{$empresa->emp_id}}"{{old('dlcc_empresa')==$empresa->emp_id ? 'selected':''}}>{{$empresa->emp_siglas}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="form-group row">
                                                    <label for="inputcuentabancariadeb"
                                                           class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Cuenta
                                                        a Acreditar</label>
                                                    <div class="col-sm-12 col-lg-10">
                                                        <select name="trab_cuentabancaria" class="form-control select2"
                                                                id="inputcuentabancariadeb" required>
                                                        </select>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <br>
                                        </div>

                                        <div class="col-sm-12 col-lg-6">
                                            <fieldset class="border p-2 col-sm-12 col-lg-12">
                                                <legend class="w-auto"><strong>Empresa a Debitar</strong></legend>

                                                <div class="form-group row">
                                                    <label for="inputempresacre"
                                                           class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Empresa</label>
                                                    <div class="col-sm-12 col-lg-10">
                                                        <select name="empresa" class="form-control select2"
                                                                id="inputempresacre" required>
                                                            <option value="">Seleccione la Empresa</option>
                                                            @foreach($empresas as $empresa)
                                                                <option value="{{$empresa->emp_id}}"{{old('cch_empresa')==$empresa->emp_id?'selected':''}}>{{$empresa['emp_siglas']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <br>
                                            </fieldset>
                                        </div>
                                    </div>

                                    <fieldset class="border p-2 col-sm-12 col-lg-12">
                                        <legend class="w-auto"><strong>Información General</strong></legend>
                                        <div class="form-group row">
                                            <label for="per_nit"
                                                   class="col-sm-24 col-lg-2 control-label text-sm-left text-lg-right requerido"
                                                   requerido>Numero de Referencia</label>
                                            <div class="col-sm-12 col-lg-10">
                                                <input name="trab_documento" type="text" class="form-control"
                                                       id="inputnumeroreferencia" aria-describedby="emailHelp"
                                                       maxlengt="25" required value="{{old('che_numero')}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="act_fechaAlta"
                                                   class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Fecha
                                                de Referencia</label>
                                            <div class="input-group col-sm-12 col-lg-3">
                                                <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputfechareferencia">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                                </div>
                                                <input type="text" class="form-control float-right" id="inputfecha"
                                                       name="trab_fecha"
                                                       value="{{old('che_fecha')}}" required>
                                            </div>
                                            <label for="per_nit"
                                                   class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Monto</label>
                                            <div class="col-sm-12 col-lg-5">
                                                <input name="trab_monto" type="text" class="form-control" id="monto"
                                                       maxlengt="25" required value="{{old('che_monto')}}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="per_nit"
                                                   class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Descripción</label>
                                            <div class="col-sm-12 col-lg-10">
                                                <textarea name="trab_descripcion" class="form-control"
                                                          id="inputdescripcion" rows="3" required
                                                          placeholder="Ingrese una descripción...">{{old('che_descripcion')}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="per_nit"
                                                   class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right requerido"
                                                   hidden>Tipo</label>
                                            <div class="col-sm-12 col-lg-4">
                                                <input name="trab_tipo" type="text" class="form-control" hidden required
                                                       value="DR">
                                            </div>
                                        </div>
                                    </fieldset>
                                </fieldset>
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
