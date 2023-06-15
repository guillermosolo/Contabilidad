@extends("layout.layout")
@section("titulo")
Pólizas de Importación
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
{{ Breadcrumbs::render('importacion') }}
@endsection


@section('contenido')
<input type="hidden" id="routepath" value="{{url('cxp/importacion')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.mensaje')
                @include('includes.form-error')
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Pólizas de Importación <small></small></h3>
                        <div class="card-tools">
                            @can('crear cxp/importacion')
                            <a href="{{route('importacion.crear')}}" class="btn btn-block btn-success btn-sm" id="crear">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                            @else
                            <a href="{{route('importacion.crear')}}" class="btn btn-block btn-success btn-sm disabled">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="tabla-data">
                            <thead class='thead-dark'>
                                <tr>
                                    <th>Proveedor</th>
                                    <th>Fecha</th>
                                    <th>DUA</th>
                                    <th>Orden</th>
                                    <th>FOB</th>
                                    <th class="width70">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                   <td>{{$data->poim_proveedor}}</td>
                                   <td>{{$data->poim_fecha}}</td>
                                   <td>{{$data->poim_dua}}</td>
                                   <td>{{$data->poim_orden}}</td>
                                   <td>{{Str::money($data->poim_FOB,$data->Moneda->mon_simbolo . " ")}}</td>
                                    <td>
                                        @can('ver cxp/facturas')
                                        <a href="{{route('importacion.mostrar',['id'=> $data->poim_id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                            title="Editar este registro">
                                            <i class="far fa-eye text-dark"></i></a>
                                        @else
                                        <a href="{{route('importacion.mostrar',['id'=> $data->poim_id])}}"
                                            class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                            title="Editar este registro">
                                            <i class="far fa-eye text-dark"></i></a>
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
