@extends("layout.layout")
@section("titulo")
Recibos
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
{{ Breadcrumbs::render('recibos') }}
@endsection


@section('contenido')
<input type="hidden" id="routepath" value="{{url('cxp/recibos')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.mensaje')
                @include('includes.form-error')
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Recibos de Compra <small></small></h3>
                        <div class="card-tools">
                            @can('crear cxp/recibos')
                            <a href="{{route('recibos.crear')}}" class="btn btn-block btn-success btn-sm" id="crear">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                            @else
                            <a href="{{route('recibos.crear')}}" class="btn btn-block btn-success btn-sm disabled">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="tabla-data">
                            <thead class='thead-dark'>
                                <tr>
                                    <th>Proveedor</th>
                                    <th>Número de Recibo</th>
                                    <th>Fecha</th>
                                    <th class="text-right">Monto</th>
                                    <th class="width70">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{$data->rec_nombre}}</td>
                                    <td>{{$data->rec_numDoc??'S/N'}}</td>
                                    <td>{{$data->rec_fecha}}</td>
                                    <td class="text-right">{{Str::money($data->rec_monto,$data->Moneda->mon_simbolo . " ")}}</td>
                                    <td>
                                        @can('ver cxp/recibos')
                                        <a href="{{route('recibos.mostrar',['id'=> $data->rec_id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip"
                                            title="Editar este registro">
                                            <i class="far fa-eye text-dark"></i></a>
                                        @else
                                        <a href="{{route('recibos.mostrar',['id'=> $data->rec_id])}}"
                                            class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                            title="Editar este registro">
                                            <i class="far fa-eye text-dark"></i></a>
                                        @endcan
                                    </>
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
