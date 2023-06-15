@extends("layout.layout")
@section("titulo")
Rol
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('rol') }}
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('parametros/rol')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.mensaje')
                @include('includes.form-error')
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Rol <small></small></h3>
                        <div class="card-tools">
                            @can('crear parametros/rol')
                            <a href="{{route('rol.crear')}}" class="btn btn-block btn-success btn-sm">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                            @else
                            <a href="{{route('rol.crear')}}" class="btn btn-block btn-success btn-sm disabled">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="tabla-data">
                            <thead class='thead-dark'>
                                <tr>
                                    <th>Nombre</th>
                                    <th class="width70 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{$data->name}}</td>
                                    <td class="text-center">
                                        @can('actualizar parametros/rol')
                                        <a href="{{route('rol.asignarPermisos',['id'=>$data->id])}}" class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                            title="Permisos">
                                            <i class="fas fa-lock-open"></i></a>
                                        @else
                                        <a href="#" class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                            title="Permisos">
                                            <i class="fas fa-lock-open"></i></a>
                                        @endcan
                                        @can('eliminar parametros/rol')
                                        <a href="{{route('rol.eliminar',['id'=> $data->id])}}"
                                            class="btn-accion-tabla eliminar-registro" data-toggle="tooltip"
                                            title="Eliminar este registro">
                                            <i class="text-danger far fa-trash-alt"></i></a>
                                        @else
                                        <a href="{{route('rol.eliminar',['id'=> $data->id])}}"
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
