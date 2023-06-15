@extends("layout.layout")
@section("titulo")
Documentos Recibidos
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
{{ Breadcrumbs::render('reportescxp.docrecibidos') }}
@endsection


@section('contenido')
<input type="hidden" id="routepath" value="{{url('cxp/reportes/recibidos')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.mensaje')
                @include('includes.form-error')
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Documentos Recibidos <small></small></h3>
                        <div class="card-tools">
                            <a href="{{route('cxp.reportes.recibidos.excel',['empresas'=>$params['empresas']])}}" class="btn btn-outline-success btn-sm">
                                Exportar a Excel<i class="far fa-file-excel pl-1"></i></a>
                            <a href="{{route('cxp.reportes.recibidos.pdf',['empresas'=>$params['empresas']])}}" class="btn btn-outline-danger btn-sm">
                                Exportar a PDF<i class="far fa-file-pdf pl-1"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="tabla-data">
                            <thead class='thead-dark'>
                                <tr>
                                    <th>ID</th>
                                    <th>Tipo</th>
                                    <th>Fecha</th>
                                    <th>Número de Doc.</th>
                                    <th>Proveedor</th>
                                    <th class="text-right">Monto</th>
                                    <th>Empresa</th>
                                    <th>Terminal</th>
                                    <th>Correlativo Interno</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{$data->id}}</td>
                                    <td>{{$data->tipo}}</td>
                                    <td>{{$data->fecha}}</td>
                                    <td>{{$data->numero}}</td>
                                    <td>{{$data->proveedor}}</td>
                                    <td class="text-right">{{Str::money($data->monto,$data->moneda . " ")}}</td>
                                    <td>{{$data->empresa}}</td>
                                    <td>{{$data->terminal}}</td>
                                    <td>{{$data->correlativo}}</td>
                                    <td>@if($data->tipo=="R")
                                        @can('ver cxp/recibos')
                                        <a href="{{route('recibos.mostrar',['id'=> $data->id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                            title="Ver documento completo">
                                            <i class="far fa-eye text-dark"></i></a>
                                        @else
                                        <a href="{{route('recibos.mostrar',['id'=> $data->id])}}"
                                            class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                            title="Ver documento completo">
                                            <i class="far fa-eye text-dark"></i></a>
                                        @endcan
                                        @elseif($data->tipo=="I")
                                        @can('ver cxp/facturas')
                                        <a href="{{route('importacion.mostrar',['id'=> $data->id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                            title="Ver documento completo">
                                            <i class="far fa-eye text-dark"></i></a>
                                        @else
                                        <a href="{{route('importacion.mostrar',['id'=> $data->id])}}"
                                            class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                            title="Ver documento completo">
                                            <i class="far fa-eye text-dark"></i></a>
                                        @endcan
                                        @elseif($data->tipo=="F")
                                        @can('ver cxp/facturas')
                                        <a href="{{route('facturas.mostrar',['id'=> $data->id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                            title="Ver documento completo">
                                            <i class="far fa-eye text-dark"></i></a>
                                        @else
                                        <a href="{{route('facturas.mostrar',['id'=> $data->id])}}"
                                            class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                            title="Ver documento completo">
                                            <i class="far fa-eye text-dark"></i></a>
                                        @endcan
                                        @endif
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
