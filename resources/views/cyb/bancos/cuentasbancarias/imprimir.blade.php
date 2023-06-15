@extends("layout.layout")

@section("titulo")
    Catálogos de Empresas
@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
@endsection

@section("scriptPlugins")
    <script src="{{asset("assets/plugins/datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}"></script>
@endsection

@section('scripts')
    <script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cxc/nabono/crear1.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
    <script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cxc/nabono\orden.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cyb/bancos/cuentasbancarias/table.js")}}" type="text/javascript"></script>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('cuentasbancarias.imprimir') }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/bancos/catalogo')}}">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Impresión de Catálogos<small></small></h3>
                            <div class="card-tools">
                                <a href="{{route('cuentasbancarias.catalogo','#')}}" class="btn btn-block btn-success btn-sm">
                                    Buscar de nuevo<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <a href="{{route('cbpdf',['dato'=>$dato])}}" target="blank" class="btn btn btn-outline-danger">Generar PDF<i class="far fa-file-pdf pl-1"></i></a>
                                    <a href="{{route('cbexcel', ['dato'=>$dato])}}" target="blank" class="btn btn btn-outline-success">Generar Excel<i class="far fa-file-excel pl-1"></i></a>
                                </div>
                            </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tabla-data">
                                <thead class='thead-dark'>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Número&nbspde&nbspCuenta</th>
                                    <th scope="col">Tipo&nbspde&nbspCuenta</th>
                                    <th scope="col">Banco</th>
                                    <th scope="col">Moneda</th>
                                    <th scope="col">Cuenta&nbspContable</th>
                                    <th scope="col">Nombre&nbspde&nbspla&nbspEmpresa</th>
                                    <th scope="col">Contacto</th>
                                    <th scope="col">Teléfono</th>


                                </thead>
                                <tbody>
                                @if(count($cuentasbancariass)<=0)
                                    <tr>
                                        <td colspan="10">No se encontraron resultados...</td>
                                    </tr>
                                @else
                                @foreach($cuentasbancariass as $cuentasbancarias)
                                    <tr>
                                        <td scope="row">{{$cuentasbancarias['ctab_id']}}</td>
                                        <td>{{$cuentasbancarias['ctab_numero']}}</td>
                                        <td>{{$cuentasbancarias->Tipo->tcb_descripcion}}</td>
                                        <td>{{$cuentasbancarias->Banco->ban_siglas}}</td>
                                        <td>{{$cuentasbancarias->Moneda->mon_nombre}}</td>
                                        <td>{{$cuentasbancarias->Contable->cta_descripcion}}</td>
                                        <td>{{$cuentasbancarias->Empresa->emp_siglas}}</td>
                                        <td>{{$cuentasbancarias['ctab_contacto']}}</td>
                                        <td>{{$cuentasbancarias['ctab_telefono']}}</td>
                                    </tr>
                                @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
