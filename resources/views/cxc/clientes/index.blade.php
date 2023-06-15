@extends("layout.layout")
@section("titulo")
Clientes
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('clientes') }}
@endsection

@section('scripts')
<script src="{{asset("assets/pages/scripts/cxc/clientes/nuevo.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('cxc/clientes')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.mensaje')
                @include('includes.form-error')
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Clientes <small></small></h3>
                        <div class="card-tools">
                            @can('crear cxc/clientes')
                            <a href="{{route('clientes.crear','#')}}" class="btn btn-block btn-success btn-sm" id="crear">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                            @else
                            <a href="{{route('clientes.crear','#')}}" class="btn btn-block btn-success btn-sm disabled">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="tabla-data">
                            <thead class='thead-dark'>
                                <tr>
                                    <th>Nombre</th>
                                    <th>NIT</th>
                                    <th>Tipo de Cliente</th>
                                    <th>Tipo de Contribuyente</th>
                                    <th>Días de Crédito</th>
                                    <th class="width70">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{$data->Persona->per_nombre}}</td>
                                    <td>{{Str::nit($data->Persona->per_nit)}}</td>
                                    <td>{{$data->TiposClientes->tpp_nombre}}</td>
                                    <td>{{$data->Persona->TipoContribuyente->tpc_nombre}}</td>
                                    <td>{{$data->cli_credito}}</td>
                                    <td>
                                        @can('actualizar cxc/clientes')
                                        <a href="{{route('clientes.editar',['id'=> $data->cli_id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                            title="Editar este registro">
                                            <i class="far fa-edit"></i></a>
                                        @else
                                        <a href="{{route('clientes.editar',['id'=> $data->cli_id])}}"
                                            class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                            title="Editar este registro">
                                            <i class="far fa-edit"></i></a>
                                        @endcan

                                      <!-- @can('actualizar cxc/clientes')
                                        <a
                                            class="btn-accion-tabla mr-4 disabled"  data-toggle="tooltip"
                                            title="Tarifario">
                                            <i class="fas fa-hand-holding-usd"></i></a>
                                        @else
                                        <a
                                            class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                            title="Tarifario">
                                            <i class="fas fa-hand-holding-usd"></i></a>
                                        @endcan -->



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
