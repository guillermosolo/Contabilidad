@extends("layout.layout")
@section("titulo")
    Detalle de Anticipo
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
    <script src="{{asset("assets/pages/scripts/cyb/cajas/anticipo/crear.js")}}" type="text/javascript"></script>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('anticipos.detalle', $anticipos->ant_id) }}
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
                            <h3 class="card-title">Formulario de Detalle<small></small></h3>
                            <div class="card-tools">
                            @can('crear cyb/bancos/anticipos/crear')
                                <a href="{{route('anticipos')}}" class="btn btn-block btn-info btn-sm">
                                    Volver al Listado<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                            @else
                                <a href="" class="btn btn-block btn-success btn-sm disabled">
                                    Volver al Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                            @endcan
                            </div>
                        </div>
                        <form action="{{route('anticipos.guardardetalle', ['id'=>$anticipos['ant_id']])}}" class="form-horizontal" method="post" id="form-general">
                            <div class="card-body">
                            <input type="hidden" id="empPath" value="{{url('parametros/terminal/cuentabancaria')}}">
                            <input type="hidden" id="codigocuenta" value="{{old('che_cuentabancaria')}}">
                            <input type="hidden" id="codigoterminal" value="{{old('che_terminal')}}">
                            <div class="form-group row">
                                @csrf
                                <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Anticipo</label>
                                <div class="col-sm-12 col-lg-6">
                                    <input name="dant_anticipo" type="text" class="form-control" id="inputmonto" hidden value="{{$anticipos->ant_id}}" required>
                                    <input type="text" class="form-control" id="inputmonto" readonly value="{{$anticipos->ant_numero}}" required>
                                </div>

                            </div>
                            <div class="form-group row">

                                <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Movimiento</label>
                                <div class="col-sm-12 col-lg-6">
                                    <select name="dant_tipo" class="form-control select2" id="exampleFormControlSelect1" required>
                                        <option value="">Movimiento Bancario</option>
                                        @foreach($movimientos as $movimiento)
                                        <option value="{{$movimiento->movb_id}}">{{$movimiento->movb_descripcion}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Numero Referencial</label>
                                <div class="col-sm-12 col-lg-6">
                                    <input name="dant_documento" type="text" class="form-control" id="inputmonto" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Monto</label>
                                <div class="col-sm-12 col-lg-6">
                                    <input name="dant_monto" type="text" class="form-control" id="inputcheque" required>
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
