@extends("layout.layout")
@section("titulo")
    Actualizar Caja Chica
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
    {{ Breadcrumbs::render('cajachica.editar',$cajachicas['cch_id']) }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/cajas/responsables')}}">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.form-error')
                    @include('includes.mensaje')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Editar Caja Chica<small></small></h3>
                            <div class="card-tools">
                                <a href="{{route('cajachica')}}" class="btn btn-block btn-info btn-sm">
                                    Ver Cajas Chicas<i class="fas fa-arrow-circle-left pl-1"></i></a>
                            </div>
                        </div><br>

                        <form action="{{route('cajachica.actualizar', ['id'=>$cajachicas['cch_id']])}}" id="form-general" class="form-horizontal" method="post" autocomplete="off">
                            <input type="hidden" id="cuentaContable" value="{{old('cch_cuentacontable', $cajachicas->cch_cuentacontable)}}">
                            <input type="hidden" id="ctaPath" value="{{url('contabilidad/ctaCuentaPorNivel')}}">
                            <input type="hidden" id="empresa" value="{{$cajachicas->cch_empresa}}">
                            <input type="hidden" id="responsable" value="{{$cajachicas->cch_responsable}}">
                            <div class="form-group row">
                                @csrf
                                @method('PUT')
                                <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Nombre de Caja chica</label>
                                <div class="col-sm-12 col-lg-8">
                                    <input name="cch_nombre" value="{{old('cch_nombre', $cajachicas->cch_nombre ?? '')}}"type="text" class="form-control" id="exampleInputPassword1" maxlengt="25" placeholder="Ingrese una descripción" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Responsable</label>
                                <div class="col-sm-12 col-lg-8">
                                    <select name="cch_responsable" class="form-control select2" id="inputempleados" required>
                                        <option value=""> Seleccione un empleado</option>
                                        @foreach($empleados as $empleado)
                                            <option value="{{$empleado['empl_id']}}"{{($cajachicas->cch_responsable ??'')==$empleado['empl_id'] ? 'selected':''}}>{{$empleado['empl_nom1']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Empresa</label>
                                <div class="col-sm-12 col-lg-8">
                                    <select name="cch_empresa" class="form-control" id="inputempresa" required>
                                        <option value="">Seleccione un empresa</option>
                                        @foreach($empresas as $empresa)
                                            <option value="{{$empresa['emp_id']}}"{{($cajachicas->cch_empresa ??'')==$empresa['emp_id'] ? 'selected':''}}>{{$empresa['emp_siglas']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Cuenta Contable</label>
                                <div class="col-sm-12 col-lg-8">
                                    <select name="cch_cuentacontable" class="form-control select2" id="inputcuentacontable" required>
                                        <option value=""> Seleccione una cuenta</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Monto</label>
                                <div  class="col-sm-12 col-lg-4">
                                    <input name="cch_monto" value="{{old('cch_monto', $cajachicas->cch_monto ?? '')}}" type="text" class="form-control" id="inputmonto" onkeypress='return validaNumericos(event,"D",this.value);' Step=".0001" placeholder="Ingrese una cantidad" required>
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
