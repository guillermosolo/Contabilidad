@extends("layout.layout")
@section("titulo")
Invoice
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
{{ Breadcrumbs::render('invoice') }}
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('cxc/ventas/invoice')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.mensaje')
                @include('includes.form-error')
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Invoice <small></small></h3>
                        <div class="card-tools">
                            @can('crear cxc/ventas/invoice')
                            <a href="{{route('invoice.crear')}}" class="btn btn-block btn-success btn-sm">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                            @else
                            <a href="{{route('invoice.crear')}}" class="btn btn-block btn-success btn-sm disabled">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                            @endcan

                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="tabla-data">
                            <thead class='thead-dark'>
                                <tr>
                                    <th>Empresa</th>
                                    <th>Terminal</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>



                                    <th class="width70">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                <tr>
                                    <td>{{$data->Empresa->emp_siglas}}</td>
                                    <td>{{$data->Terminal->ter_abreviatura}}</td>
                                    <td>{{$data->Cliente->per_nombre}}</td>
                                    <td>{{\Carbon\Carbon::parse($data->ven_fecha)->format('d/m/Y')}}</td>


                                    <td>
                                        <a href="{{route('invoice.mostrar',['id'=>$data->ven_id])}}"
                                            class="btn-accion-tabla mr-4" data-toggle="tooltip" title="Ver Invoice">
                                            <i class="text-dark far fa-eye"></i></a>
                                            @can('cxc/ventas/invoice')
                                        <a href="{{route('invoice.editar',['id'=> $data->ven_id])}}"
                                            class="btn-accion-tabla mr-4"  data-toggle="tooltip"
                                            title="Anular Invoice">
                                            <i class="fas fa-window-close"></i></a>
                                        @else
                                        <a href="{{route('invoice.editar',['id'=> $data->ven_id])}}"
                                            class="btn-accion-tabla mr-4 disabled" data-toggle="tooltip"
                                            title="Anular Invoice">
                                            <i class="fas fa-window-close"></i></a>
                                             
                                        </td>
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
