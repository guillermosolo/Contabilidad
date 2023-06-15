@extends("layout.layout")
@section("titulo")
    Cajas Chicas
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
    {{ Breadcrumbs::render('cajachica') }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/cajas/responsables')}}">
    @inject('empleado','App\Models\Planilla\Empleado')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Responsables<small></small></h3>
                            <div class="card-tools">
                                @can('crear cyb/cajas/responsables')
                                <a href="{{route('cajachica.crear')}}" class="btn btn-block btn-success btn-sm">
                                    Nueva Caja Chica<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                @else
                                    <a href="{{route('cajachica.crear')}}" class="btn btn-block btn-success btn-sm disabled">
                                        Nueva Caja Chica<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                @endcan
                            </div>
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tabla-data">
                                <thead class='thead-dark'>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Responsable</th>
                                    <th scope="col">Cuenta Contable</th>
                                    <th scope="col">Empresa</th>&nbsp
                                    <th scope="col">Monto</th>
                                    <th scope="col">Opciones</th>

                                </thead>
                                <tbody>
                                @foreach($cajachicas as $cajachica)
                                    <tr>
                                        <td scope="row">{{$cajachica['cch_id']}}</td>
                                        <td>{{$cajachica['cch_nombre']}}</td>
                                        <td>{{$empleado->getNombreCompleto($cajachica->cch_responsable)}}</td>
                                        <td>{{$cajachica->CuentaContable->cta_descripcion}}</td>
                                        <td>{{$cajachica->Empresa->emp_siglas}}</td>
                                        <td>{{Str::money($cajachica['cch_monto'],"Q ")}}</td>
                                        <td>
                                            @can('actualizar cyb/cajas/responsables')
                                                <div class="form-group row">
                                                    <a href="{{route('cajachica.editar', ['id'=>$cajachica['cch_id']])}}"
                                                       class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                                       title="Editar este registro">
                                                        <i class="far fa-edit"></i></a>
                                                    @else
                                                    <a href=""
                                                       class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                                       title="Editar este registro">
                                                        <i class="far fa-edit"></i></a>
                                                    @endcan
                                                    @can('eliminar cyb/cajas/responsables')
                                                    <a href="{{route('cajachica.eliminar', ['id'=>$cajachica['cch_id']])}}"
                                                       class="btn-accion-tabla eliminar-registro" data-toggle="tooltip"
                                                       title="Eliminar este registro">
                                                        <i class="text-danger far fa-trash-alt"></i></a>
                                                    @else
                                                <a href=""
                                                   class="btn-accion-tabla eliminar-registro disabled" data-toggle="tooltip"
                                                   title="Editar este registro">
                                                    <i class="text-danger far fa-trash-alt"></i></a>
                                                        @endcan
                                                </div>
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
    </section>


@endsection
