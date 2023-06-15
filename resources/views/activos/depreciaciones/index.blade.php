@extends("layout.layout")
@section("titulo")
Depreciaciones
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
{{ Breadcrumbs::render('activos') }}
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('activos/depreciacion')}}">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Depreciaciones<small></small></h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover" id="tabla-data">
                                <thead class="thead-dark">
                                    <tr>
                                      <th>Descripción</th>
                                      <th>Categoria</th>
                                      <th>Correlativo</th>
                                      <th>Status</th>
                                      <th>Empresa</th>
                                      <th>Terminal</th>
                                      <th class="width70">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                    <tr>
                                        <td>{{$data->act_descripcion}}</td>
                                        <td>{{$data->Categoria->cat_descripcion}}</td>
                                        <td>{{$data->act_correlativo}}</td>
                                        <td>{{$data->StatusActivos->sta_descripcion}}</td>
                                        <td>{{$data->Empresa->emp_siglas}}</td>
                                        <td>{{$data->Terminal->ter_abreviatura}}</td>
                                        <td>
                                           <a href="{{route('depreciaciones.mostrar',['id'=> $data->act_id])}}"
                                                class="btn-accion-tabla" data-toggle="tooltip"
                                                title="Ver tabla">
                                                <i class="text-dark far fa-eye"></i></a>
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
