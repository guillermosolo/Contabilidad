@extends("layout.layout")
@section("titulo")
Moneda
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
{{ Breadcrumbs::render('moneda') }}
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('admin/moneda')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.mensaje')
                @include('includes.form-error')
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Moneda<small></small></h3>
                        <div class="card-tools">
                            @can('crear admin/moneda')
                            <a href="{{route('moneda.crear')}}" class="btn btn-block btn-success btn-sm">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                            @else
                            <a href="{{route('moneda.crear')}}" class="btn btn-block btn-success btn-sm disabled">
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
                                    <th>Símbolo</th>
                                    <th class="width70">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{$data->mon_nombre}}</td>
                                    <td>{{$data->mon_abreviatura}}</td>
                                    <td>{{$data->mon_simbolo}}</td>
                                    <td>
                                        @can('actualizar admin/moneda')
                                        <a href="{{route('moneda.editar',['id'=> $data->mon_id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                            title="Editar este registro">
                                            <i class="far fa-edit"></i></a>
                                        @else
                                        <a href="{{route('moneda.editar',['id'=> $data->mon_id])}}"
                                            class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                            title="Editar este registro">
                                            <i class="far fa-edit"></i></a>
                                        @endcan
                                        @can('eliminar admin/moneda')
                                        <a href="{{route('moneda.eliminar',['id'=> $data->mon_id])}}"
                                            class="btn-accion-tabla eliminar-registro" data-toggle="tooltip"
                                            title="Eliminar este registro">
                                            <i class="text-danger far fa-trash-alt"></i></a>
                                        @else
                                        <a href="{{route('moneda.eliminar',['id'=> $data->mon_id])}}"
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
