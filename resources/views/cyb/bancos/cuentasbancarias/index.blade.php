@extends("layout.layout")

@section("titulo")
    Catalogo de Cuentas
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
    <script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
    <script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cyb/bancos/cuentasbancarias/table.js")}}" type="text/javascript"></script>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('cuentasbancarias') }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/bancos/cuentasbancarias')}}">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Apertura de Cuenta Bancaria<small></small></h3>
                                <div class="card-tools">
                                    @can('crear cyb/bancos/cuentasbancarias')
                                    <a href="{{route('cuentasbancarias.crear')}}" class="btn btn-block btn-success btn-sm">
                                        Crear Nueva Cuenta<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                    @else
                                        <a href="{{route('cuentasbancarias.crear')}}" class="btn btn-block btn-success btn-sm disabled">
                                            Crear Nueva Cuenta<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                    @endcan
                                </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tabla-data" cellspacing="0" width="100%">
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
                                            <th scope="col">Opciones</th>


                                        </thead>
                                        <tbody>
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
                                                <td>
                                                    @can('actualizar cyb/bancos/cuentasbancarias')
                                                        <div class="form-group row">
                                                            <a href="{{route('cuentasbancarias.editar',['id'=> $cuentasbancarias['ctab_id']])}}"
                                                               class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                                               title="Editar este registro">
                                                                <i class="far fa-edit"></i></a>
                                                    @else
                                                        <a href="{{route('cuentasbancarias.editar',['id'=> $cuentasbancarias->ctab_id])}}"
                                                           class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                                           title="Editar este registro">
                                                            <i class="far fa-edit"></i></a>
                                                    @endcan
                                                    @can('eliminar cyb/bancos/cuentasbancarias')
                                                            <a href="{{route('cuentasbancarias.eliminar',['id'=> $cuentasbancarias['ctab_id']])}}"
                                                               class="btn-accion-tabla eliminar-registro" data-toggle="tooltip"
                                                               title="Eliminar este registro">
                                                                <i class="text-danger far fa-trash-alt"></i></a>
                                                        @else
                                                                <a href="{{route('cuentasbancarias.eliminar',['id'=> $cuentasbancarias->ctab_id])}}"
                                                                   class="btn-accion-tabla eliminar-registro disabled" data-toggle="tooltip"
                                                                   title="Editar este registro">
                                                                    <i class="text-danger far fa-trash-alt"></i></a>
                                                        </div>
                                                    @endcan
                                            </td>
                                        </tr>
                                    @endforeach

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
