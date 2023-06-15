@extends("layout.layout")
@section("titulo")
    Conciliaciones
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
    <script src="{{asset("assets/pages/scripts/cyb/bancos/transferencias/relacionados/relacion.js")}}" type="text/javascript"></script>

@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('cajachica.crear') }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/bancos/conciliaciones')}}">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.form-error')
                    @include('includes.mensaje')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Crear Conciliaciones<small></small></h3>
                            <div class="card-tools">
                                <a href="{{route('conciliaciones')}}" class="btn btn-block btn-info btn-sm">
                                    Volver al Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                            </div>
                        </div>

                        <form action="{{route('conciliaciones.guardar')}}" id="form-general" class="form-horizontal" method="post">
                            <input type="hidden" id="ctaPath" value="{{url('cyb/bancos/conciliaciones/filtro')}}">
                            <input type="hidden" id="codigoempdeb" value="{{old('dlcc_empresa')}}">
                            <input type="hidden" id="codigocuentadeb" value="{{old('che_cuentabancaria')}}">


                            <div class="card-body">
                                @csrf
                                    <div class="form-group row">
                                        <label for="inputempresadeb" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Empresa</label>
                                        <div class="col-sm-12 col-lg-8">
                                            <select name="dlcc_empresa" class="form-control select2" id="inputempresadeb" required>
                                                <option value="">Seleccione la Empresa</option>
                                                @foreach (auth()->user()->Empresas as $empresa)
                                                    <option
                                                        value="{{$empresa->emp_id}}"{{old('dlcc_empresa')==$empresa->emp_id ? 'selected':''}}>{{$empresa->emp_siglas}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="inputcuentabancariadeb" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Cuenta a Conciliar</label>
                                        <div class="col-sm-12 col-lg-8">
                                            <select name="con_cuentabancaria" class="form-control select2" id="inputcuentabancariadeb" required>
                                            </select>
                                        </div>
                                    </div>
                                <div class="form-group row">

                                    <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Saldo</label>
                                    <div class="col-sm-12 col-lg-8">
                                        <input name="con_saldo" value="{{old('cch_nombre')}}"type="text" class="form-control" id="exampleInputPassword1" maxlengt="25" placeholder="Digite un Saldo" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Año</label>
                                    <div class="col-sm-12 col-lg-8">
                                        <select name="con_anio" class="form-control select2" id="inputempleados" required>
                                            <option value=""> Elija el año </option>
                                            <option value="2021"> 2021 </option>
                                            <option value="2022"> 2022 </option>
                                            <option value="2023"> 2023 </option>
                                            <option value="2024"> 2024 </option>
                                            <option value="2025"> 2025 </option>
                                            <option value="2026"> 2026 </option>
                                            <option value="2027"> 2027 </option>
                                            <option value="2028"> 2028 </option>
                                            <option value="2029"> 2029 </option>
                                            <option value="2030"> 2030 </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="con_mes" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Mes</label>
                                    <div class="col-sm-12 col-lg-8">
                                        <select name="con_mes" class="form-control select2" id="inputempresa" required>
                                            <option value=""> Elija un mes </option>
                                            <option value="01"> Enero </option>
                                            <option value="02"> Febrero </option>
                                            <option value="03"> Marzo</option>
                                            <option value="04"> Abril </option>
                                            <option value="05"> Mayo </option>
                                            <option value="06"> Junio </option>
                                            <option value="07"> Julio </option>
                                            <option value="08"> Agosto </option>
                                            <option value="09"> Septiembre </option>
                                            <option value="10"> Octubre </option>
                                            <option value="11"> Noviembre </option>
                                            <option value="12"> Diciembre </option>
                                        </select>
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

