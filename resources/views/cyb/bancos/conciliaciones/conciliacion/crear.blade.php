@extends("layout.layout")
@section("titulo")
    Crear Conciliación
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
    <script src="{{asset("assets/pages/scripts/cxc/nabono\orden.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cyb/bancos/conciliaciones/crear.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js")}}"></script>
    <script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
@endsection
@section('breadcrumbs')
    {{ Breadcrumbs::render('conciliaciones.crear') }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/bancos/debitos')}}">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Conciliaciónes<small></small></h3>
                            <div class="card-tools">
                                <a href="{{route('conciliaciones')}}" class="btn btn-block btn-info btn-sm">
                                    Volver a Conciliaciónes<i class="fas fa-arrow-circle-left pl-1"></i></a>
                            </div>
                        </div><br>
                        <form action="{{route('conciliaciones.import',['id'=>$id])}}" class="form-horizontal" enctype="multipart/form-data" method="post" id="form-general" autocomplete="off">
                            <div class="form-group row">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="emp_logo" class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-right">Exel</label>
                                        <div class="input-group col-sm-12 col-lg-10">
                                            @csrf
                                            <div class="custom-file @if($conciliacion['con_conciliado']==1) disabled @endif">
                                                <input type="file" accept=".xls,.xlsx" class="custom-file-input form-control float-right inline" id="excel" name="excel"
                                                       lang="es">
                                                <label class="custom-file-label" for="excel">Seleccione Archivo</label>
                                            </div>
                                            <div class="col-sm-12 col-lg-3 text-center @if($conciliacion['con_conciliado']==1) disabled @endif">
                                                <a href="{{route('conciliaciones.autorizarsinexel',['id'=>$id])}}" class="btn btn-outline-dark">
                                                    <strong>Conciliación sin Excel  </strong><i class="fas fa-arrow-circle-up"></i></a>
                                            </div>
                                        </div>
                                        <br>

                                    </div>

                                </div>
                            </div>
                            <div class="card-footer" >
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4 text-center @if($conciliacion['con_conciliado']==1) disabled @endif">
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

