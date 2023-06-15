@extends("layout.layout")
@section("titulo")
    Liquidación
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
    <script src="{{asset("assets/pages/scripts/cyb/cajas/liquidaciones/crearliqui.js")}}" type="text/javascript"></script>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('liquidacion.crear') }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/cajas/responsables')}}">
    @inject('empleado','App\Models\Planilla\Empleado')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.form-error')
                    @include('includes.mensaje')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Liquidación de Caja Chica<small></small></h3>
                            <div class="card-tools">
                                <a href="{{route('liquidacion')}}" class="btn btn-block btn-info btn-sm">
                                    Volver al listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                            </div>
                        </div><br>

                        <form action="{{route('crearliquidacion')}}" id="form-general" class="form-horizontal" method="post">
                            <input type="hidden" id="cuentaContable" value="{{old('cch_cuentacontable')}}">
                            <input type="hidden" id="ctaPath" value="{{url('contabilidad/ctaCuentaPorNivel')}}">
                            <div class="form-group row">
                                <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Caja Chica</label>
                                <div class="col-sm-12 col-lg-8">
                                    <select name="lcc_cajachica" class="form-control select2" id="inputcajas" required>
                                        <option value=""> Seleccione Caja Chica</option>
                                    @if($cajaschicas->count())
                                            @foreach($cajaschicas as $cajas)
                                                <option value="{{$cajas->cch_id}}"{{old('lcc_cajachica')==$cajas->cch_id ? 'selected':''}}>{{$cajas->cch_nombre}} - {{$empleado->getNombreCompleto($cajas->cch_responsable)}} - {{$cajas->Empresa->emp_siglas}}</option>
                                            @endforeach
                                        @else
                                            <option value="">No hay cajas chicas disponibles</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                @csrf
                                <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Descripción</label>
                                <div class="col-sm-12 col-lg-8">
                                    <input name="lcc_descripcion" value="{{old('lcc_descripcion')}}"type="text" class="form-control" id="exampleInputPassword1" maxlengt="25" placeholder="Ingrese una descripción" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="act_fechaAlta" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Fecha de Referencia</label>
                                <div class="input-group col-sm-12 col-lg-3">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputfechareferencia">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="inputfecha" name="lcc_fecha"
                                           value="{{old('lcc_fecha')}}" required>
                                </div>
                            </div>
                            @if($cajaschicas->count())
                            @else
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>¡No se encontraron Cajas Chicas!</strong>Esto sucede porque todas las cajas chicas ya  cuentan
                                    con una liquidación activa, regresa al listado para comprobarlo.
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="form-group row" hidden>
                                <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Pendiente</label>
                                <div class="col-sm-12 col-lg-4">
                                    <select name="lcc_pendiente" class="form-control" id="inputempresa" required>
                                        <option value="0">Pendiente</option>
                                    </select>
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

