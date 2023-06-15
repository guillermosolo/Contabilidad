@extends("layout.layout")
@section("titulo")
Usuario
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
{{ Breadcrumbs::render('usuario') }}
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('parametros/usuario')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.mensaje')
                @include('includes.form-error')
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Usuario<small></small></h3>
                        <div class="card-tools">
                            @can('crear parametros/usuario')
                            <a href="{{route('usuario.crear')}}" class="btn btn-block btn-success btn-sm">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                            @else
                            <a href="{{route('usuario.crear')}}" class="btn btn-block btn-success btn-sm disabled">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="tabla-data">
                            <thead class='thead-dark'>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Activo</th>
                                    <th>Empleado</th>
                                    <th class="width70  ">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{$data->usu_nombre}}</td>
                                    <td>@if ($data->usu_activo)
                                        <i class="text-success fas fa-check"></i>
                                        @else
                                        <i class="text-danger fas fa-times"></i>
                                        @endif
                                    <td>{{$data->Empleados->getNombreCompleto($data->usu_empleado)}}</td>
                                    <td>
                                        <a href="{{route('usuario.mostrar',['id'=>$data->id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip" title="Ver información">
                                            <i class="text-dark far fa-eye"></i></a>
                                        @can('actualizar parametros/usuario')
                                        <a href="{{route('usuario.editar',['id'=> $data->id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                            title="Editar este registro">
                                            <i class="far fa-edit"></i></a>

                                        <a href="{{route('usuario.editarC',['id'=> $data->id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip" title="Contraseña">
                                            <i class="fas fa-key"></i></a>

                                        <a href="{{route('usuario.roles',['id'=> $data->id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip" title="Asignar Roles">
                                            <i class="fas fa-tasks"></i></a>

                                        <a href="{{route('usuario.permisos',['id'=> $data->id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                            title="Asignar Permisos">
                                            <i class="fas fa-user-lock"></i></a>

                                        <a href="{{route('usuario.empresas',['id'=> $data->id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                            title="Asignar Empresas">
                                            <i class="fas fa-city"></i></a>

                                        <a href="{{route('usuario.terminales',['id'=> $data->id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                            title="Asignar Terminales">
                                            <i class="fas fa-boxes"></i></a>
                                        @else
                                        <a href="{{route('usuario.editar',['id'=> $data->id])}}"
                                            class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                            title="Editar este registro">
                                            <i class="far fa-edit"></i></a>

                                        <a href="{{route('usuario.editarC',['id'=> $data->id])}}"
                                            class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                            title="Contraseña">
                                            <i class="fas fa-key"></i></a>

                                        <a href="{{route('usuario.roles',['id'=> $data->id])}}"
                                            class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                            title="Asignar Permisos">
                                            <i class="fas fa-tasks"></i></a>
                                        <a href="{{route('usuario.permisos',['id'=> $data->id])}}"
                                            class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                            title="Asignar Roles">
                                            <i class="fas fa-user-lock"></i></a>

                                        <a href="{{route('usuario.empresas',['id'=> $data->id])}}"
                                            class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                            title="Asignar Empresas">
                                            <i class="fas fa-city"></i></a>

                                        <a href="{{route('usuario.terminales',['id'=> $data->id])}}"
                                            class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                            title="Asignar Terminales">
                                            <i class="fas fa-boxes"></i></a>
                                        @endcan
                                        @can('eliminar parametros/usuario')
                                        <a href="{{route('usuario.eliminar',['id'=> $data->id])}}"
                                            class="btn-accion-tabla eliminar-registro" data-toggle="tooltip"
                                            title="Eliminar este registro">
                                            <i class="text-danger far fa-trash-alt"></i></a>
                                        @else
                                        <a href="{{route('usuario.eliminar',['id'=> $data->id])}}"
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
