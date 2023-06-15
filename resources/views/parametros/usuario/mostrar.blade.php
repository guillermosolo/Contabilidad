@extends("layout.layout")
@section("titulo")
Usuario
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('usuario.mostrar',$data) }}
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('parametros/usuario')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Mostrar Usuario: {{$data->usu_nombre}}<small></small></h3>
                        <div class="card-tools">
                            <a href="{{route('usuario')}}" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                    <div class="card-body row">
                        <div class="col-lg-4 col-sm-12">
                            <div class="row">
                                <label for="" class="col-lg-4 text-sm-left text-lg-right">Usuario</label>
                                <p class="col-lg-8">{{$data->usu_nombre}}</p>
                            </div>
                            <div class="row">
                                <label for="" class="col-lg-4 text-sm-left text-lg-right">Nombre</label>
                                <p class="col-lg-8">{{$data->Empleados->getNombreCompleto($data->usu_empleado)}}</p>
                            </div>
                            <div class="row">
                                <label for="" class="col-lg-4 text-sm-left text-lg-right">Roles</label>
                                <p class="col-lg-8">{{$data->getRoleNames()->implode(',')}}</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-12">
                                <div class="col-lg-12">
                                    <div class="card card-outline card-secondary">
                                        <div class="card-header">
                                            <h4 class="card-title">Empresas</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="list-group list-group-flush">
                                                @foreach ($data->Empresas as $item)
                                                <div class="d-flex justify-content-between align-items-center">
                                                    {{$item->emp_siglas}}
                                                    @if ($item->emp_activa)
                                                    <span class="badge badge-success badge-pill"><i
                                                            class="fas fa-check"></i></span>
                                                    @else
                                                    <span class="badge badge-danger badge-pill"><i
                                                            class="fas fa-times"></i></span>
                                                    @endif
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="card card-outline card-secondary">
                                    <div class="card-header">
                                        <h4 class="card-title">Terminales</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="list-group list-group-flush">
                                            @foreach ($data->Terminales as $item)
                                            <div class="d-flex justify-content-between align-items-center">
                                                {{$item->ter_nombre}}
                                                @if ($item->ter_activo)
                                                <span class="badge badge-success badge-pill"><i
                                                        class="fas fa-check"></i></span>
                                                @else
                                                <span class="badge badge-danger badge-pill"><i
                                                        class="fas fa-times"></i></span>
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-outline card-secondary">
                                <div class="card-header">
                                    <h4 class="card-title">Permisos</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-striped table-hover" id="tabla">
                                        <thead class='thead-dark'>
                                            <tr>
                                                <th rowspan="2" class="text-center align-middle">Nombre</th>
                                                <th colspan="4" class="text-center">Permisos</th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">Ver</th>
                                                <th class="text-center">Crear</th>
                                                <th class="text-center">Actualizar</th>
                                                <th class="text-center">Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($menu as $item)
                                            @if ($item['men_padre']!=0)
                                            @break
                                            @endif
                                            @include("parametros.usuario.menu-item2",compact('item'))
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
</section>
@endsection
