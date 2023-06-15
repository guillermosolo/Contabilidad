@extends("layout.layout")
@section("titulo")
    Tipo de Descuento o Bonificacion
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('tipodesc') }}
@endsection
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
    <script src="{{asset("assets/pages/scripts/planillas/tipodesc/table.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('planillas/tipo-descuentos')}}">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <span class="card-title"><small>Tipo de descuentos y bonificaciones</small></span>
                            <div class="row d-flex justify-content-lg-end justify-content-sm-center">

                                <div class="bd-highlight p-2">
                                    @can('crear planillas/tipo-descuentos')
                                        <a href="{{route('tipodesc.crear')}}"
                                           class="btn btn-block btn-success btn-sm my-0 mx-2">
                                            Nuevo Registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                    @else
                                        <a href="{{route('tipodesc.crear','#')}}"
                                           class="btn btn-block btn-success btn-sm disabled">
                                            Nuevo Registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="tabla-data" cellspacing="0"
                                           width="100%">
                                        <thead class='thead-dark'>
                                        <tr>
                                            <th>No.</th>
                                            <th>Descripcion</th>
                                            <th>Forma</th>
                                            <th>Clase</th>
{{--                                            <th>Acciones</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($datas??[] as $data)
                                            <tr>
                                                <td>{{$data->tipd_id}}</td>
                                                <td>{{$data->tipd_descripcion}}</td>
                                                <td>{{$data->tipd_forma=='F'?'FIJO':'PORCENTUAL'}}</td>
                                                <td>{{$data->tipd_clase=='B'?'BONIFICACION':($data->tipd_clase=='D'?'DESCUENTO':$data->tipd_clase)}}</td>
{{--                                                <td>--}}
{{--                                                    @can('actualizar planillas/tipo-descuentos')--}}
{{--                                                        <a href="{{route('tipodesc.editar',['id'=> $data->tipd_id])}}"--}}
{{--                                                           class="btn-accion-tabla mr-4" data-toggle="tooltip"--}}
{{--                                                           title="Editar este registro">--}}
{{--                                                            <i class="far fa-edit"></i></a>--}}
{{--                                                    @else--}}
{{--                                                        <a href="{{route('tipodesc.editar',['id'=> $data->tipd_id])}}"--}}
{{--                                                           class="btn-accion-tabla disabled" data-toggle="tooltip"--}}
{{--                                                           title="Editar este registro">--}}
{{--                                                            <i class="far fa-edit"></i></a>--}}
{{--                                                    @endcan--}}
{{--                                                    @can('eliminar planillas/tipo-descuentos')--}}
{{--                                                        <a href="{{route('tipodesc.eliminar',['id'=> $data->tipd_id])}}"--}}
{{--                                                           class="btn-accion-tabla eliminar-registro "--}}
{{--                                                           data-toggle="tooltip"--}}
{{--                                                           title="Eliminar este registro">--}}
{{--                                                            <i class="text-danger far fa-trash-alt"></i></a>--}}
{{--                                                    @else--}}
{{--                                                        <a href="{{route('tipodesc.eliminar',['id'=> $data->tipd_id])}}"--}}
{{--                                                           class="btn-accion-tabla eliminar-registro disabled"--}}
{{--                                                           data-toggle="tooltip"--}}
{{--                                                           title="Eliminar este registro">--}}
{{--                                                            <i class="text-danger far fa-trash-alt"></i></a>--}}
{{--                                                    @endcan--}}
{{--                                                </td>--}}

                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
