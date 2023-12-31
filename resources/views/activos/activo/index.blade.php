@extends("layout.layout")
@section("titulo")
Activos
@endsection

@if ($datas->count()>12)


@section("styles")
<link rel="stylesheet" href="{{asset("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
<link rel="stylesheet" href="{{asset("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
@endsection

@section("scriptPlugins")
<script src="{{asset("assets/plugins/datatables/jquery.dataTables.min.js")}}"></script>
<script src="{{asset("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
<script src="{{asset("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js")}}"></script>
<script src="{{asset("assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}"></script>
@endsection

@section("scripts")
<script src="{{asset("assets/pages/scripts/admin/table.js")}}" type="text/javascript"></script>
@endsection

@endif

@section('breadcrumbs')
{{ Breadcrumbs::render('activos') }}
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('activos/activo')}}">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Activos <small></small></h3>
                            <div class="card-tools">
                            @can('crear activos/activo')
                                <a href="{{route('activos.crear')}}" class="btn btn-block btn-success btn-sm">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                @else
                                <a href="{{route('activos.crear')}}" class="btn btn-block btn-success btn-sm disabled">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                            @endcan
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover" id="tabla-data">
                                <thead class="thead-dark">
                                    <tr>
                                      <th>Descripción</th>
                                      <th>Categoria</th>
                                      <th>Correlativo</th>
                                      <th>Status</th>
                                      <th>Empresa</th>
                                      <th>Terminal</th>
                                      <th class="width70">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                    <tr>
                                        <td>{{$data->act_descripcion}}</td>
                                        <td>{{$data->Categoria->cat_descripcion}}</td>
                                        <td>{{$data->act_correlativo}}</td>
                                        <td>{{$data->StatusActivos->sta_descripcion}}</td>
                                        <td>{{$data->Empresa->emp_siglas}}</td>
                                        <td>{{$data->Terminal->ter_abreviatura}}</td>
                                        <td>
                                            @can('actualizar activos/activo')
                                            <a href="{{route('activos.editar',['id'=> $data->act_id])}}"
                                                class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                                title="Editar este registro">
                                                <i class="far fa-edit"></i></a>
                                                <a href="{{route('activos.propiedades',['id'=> $data->act_id])}}"
                                                    class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                                    title="Agregar propiedades del Activo">
                                                    <i class="fas fa-wrench"></i></a>
                                            @else
                                            <a href="{{route('activos.editar',['id'=> $data->act_id])}}"
                                                class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                                title="Editar este registro">
                                                <i class="far fa-edit"></i></a>
                                                <a href="{{route('activos.propiedades',['id'=> $data->act_id])}}"
                                                    class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                                    title="Agregar propiedes del Activo">
                                                    <i class="fas fa-wrench"></i></a>
                                            @endcan
                                            @can('eliminar activos/activo')
                                            <a href="{{route('activos.eliminar',['id'=> $data->act_id])}}"
                                                class="btn-accion-tabla eliminar-registro" data-toggle="tooltip"
                                                title="Eliminar este registro">
                                                <i class="text-danger far fa-trash-alt"></i></a>
                                            @else
                                            <a href="{{route('activos.eliminar',['id'=> $data->act_id])}}"
                                                class="btn-accion-tabla eliminar-registro disabled" data-toggle="tooltip"
                                                title="Eliminar este registro">
                                                <i class="text-danger far fa-trash-alt"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
