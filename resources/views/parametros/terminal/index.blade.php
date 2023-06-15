@extends("layout.layout")
@section("titulo")
Terminal
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('terminal') }}
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('parametros/terminal')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.mensaje')
                @include('includes.form-error')
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Terminal <small></small></h3>
                        <div class="card-tools">
                            @can('crear parametros/terminal')
                            <a href="{{route('terminal.crear')}}" class="btn btn-block btn-success btn-sm">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                            @else
                            <a href="{{route('terminal.crear')}}" class="btn btn-block btn-success btn-sm disabled">
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
                                    <th>Municipio</th>
                                    <th>Activo</th>
                                    <th class="width70">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{$data->ter_nombre}}</td>
                                    <td>{{$data->ter_abreviatura}}</td>
                                    <td>{{$data->Departamento->getDescLg($data->ter_municipio)}}</td>
                                    <td>@if ($data->ter_activo)
                                        <i class="text-success fas fa-check"></i>
                                        @else
                                        <i class="text-danger fas fa-times"></i>
                                        @endif
                                    </td>
                                    <td>
                                        @can('actualizar parametros/terminal')
                                        <a href="{{route('terminal.editar',['id'=> $data->ter_id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                            title="Editar este registro">
                                            <i class="far fa-edit"></i></a>
                                        @else
                                        <a href="{{route('terminal.editar',['id'=> $data->ter_id])}}"
                                            class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                            title="Editar este registro">
                                            <i class="far fa-edit"></i></a>
                                        @endcan
                                        @can('eliminar parametros/terminal')
                                        <a href="{{route('terminal.eliminar',['id'=> $data->ter_id])}}"
                                            class="btn-accion-tabla eliminar-registro" data-toggle="tooltip"
                                            title="Eliminar este registro">
                                            <i class="text-danger far fa-trash-alt"></i></a>
                                        @else
                                        <a href="{{route('terminal.eliminar',['id'=> $data->ter_id])}}"
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
