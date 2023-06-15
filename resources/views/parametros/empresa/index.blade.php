@extends("layout.layout")
@section("titulo")
Empresa
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('empresa') }}
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('parametros/empresa')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.mensaje')
                @include('includes.form-error')
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Empresa <small></small></h3>
                        <div class="card-tools">
                            @can('crear parametros/empresa')
                            <a href="{{route('empresa.crear')}}" class="btn btn-block btn-success btn-sm">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                            @else
                            <a href="{{route('empresa.crear')}}" class="btn btn-block btn-success btn-sm disabled">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="tabla-data">
                            <thead class='thead-dark'>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Abreviatura</th>
                                    <th>NIT</th>
                                    <th>Activo</th>
                                    <th class="width70 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{$data->emp_nombre}}</td>
                                    <td>{{$data->emp_siglas}}</td>
                                    <td>{{Str::nit($data->emp_NIT)}}</td>
                                    <td>@if ($data->emp_activa)
                                        <i class="text-success fas fa-check"></i>
                                        @else
                                        <i class="text-danger fas fa-times"></i>
                                        @endif
                                    <td>
                                        <a href="{{route('empresa.mostrar',['id'=>$data->emp_id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip" title="Ver información">
                                            <i class="text-dark far fa-eye"></i></a>
                                        @can('actualizar parametros/empresa')
                                        <a href="{{route('empresa.editar',['id'=> $data->emp_id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                            title="Editar este registro">
                                            <i class="far fa-edit"></i></a>
                                        <a href="{{route('empresa.terminal',['id'=> $data->emp_id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                            title="Terminales">
                                            <i class="fas fa-boxes"></i></a>
                                        <a href="{{route('empresa.representante',['id'=> $data->emp_id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                            title="Representantes">
                                            <i class="fas fa-user-tie"></i></a>
                                        @else
                                        <a href="{{route('empresa.editar',['id'=> $data->emp_id])}}"
                                            class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                            title="Editar este registro">
                                            <i class="far fa-edit"></i></a>
                                        <a href="{{route('empresa.terminal',['id'=> $data->emp_id])}}"
                                            class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                            title="Terminales">
                                            <i class="fas fa-boxes"></i></a>
                                        <a href="{{route('empresa.representante',['id'=> $data->emp_id])}}"
                                            class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                            title="Representantes">
                                            <i class="fas fa-user-tie"></i></a>
                                        @endcan
                                        @can('eliminar parametros/empresa')
                                        <a href="{{route('empresa.eliminar',['id'=> $data->emp_id])}}"
                                            class="btn-accion-tabla eliminar-registro" data-toggle="tooltip"
                                            title="Eliminar este registro">
                                            <i class="text-danger far fa-trash-alt"></i></a>
                                        @else
                                        <a href="{{route('empresa.eliminar',['id'=> $data->emp_id])}}"
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
