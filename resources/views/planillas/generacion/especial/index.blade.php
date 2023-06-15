@extends("layout.layout")
@section("titulo")
    Planilla Especial
@endsection
@section('breadcrumbs')
    {{ Breadcrumbs::render('planillas-especial') }}

@endsection
@section('breadcrumbs')

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
    <script src="{{asset("assets/pages/scripts/planillas/generacion/table.js")}}" type="text/javascript"></script>
@endsection


@section('contenido')
    @inject('empleado','App\Models\Planilla\Empleado')

    <input type="hidden" id="routepath"
           value="{{url('planillas/generacion/especial')}}">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <span
                                class="card-title"><small>Planillas Especial</small></span>
                            <div class="row d-flex justify-content-lg-end justify-content-sm-center">
                                <div class="bd-highlight p-2">
                                    <a href="{{route('planillas-especial.crear')}}"
                                       class="btn btn-block btn-success btn-sm my-0 mx-2  @can('crear planillas/generacion/mensual') @else disabled @endcan"
                                       id="crear">
                                        Generar Planilla<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
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
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>

                                            <th>Descripcion</th>
                                            <th>Tipo</th>
                                            <th>Acciones</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($datas as $data)
                                            <tr>
                                                <td>{{$data->pla_id}}</td>
                                                <td>{{Carbon\Carbon::parse($data->pla_inicio)->format('Y/m/d')}}</td>
                                                <td>{{Carbon\Carbon::parse($data->pla_fin)->format('Y/m/d')}}</td>

                                                <td>{{$data->pla_descripcion}}</td>
                                                <td>{{$data->pla_tipo=='N'?'BONO 14':'AGUINALDO'}}</td>
                                                <td>
                                                    @can('crear planillas/generacion')
                                                        <a href="{{route('planillas-especial.ver',['id'=> $data->pla_id])}}"
                                                           class="btn-accion-tabla" data-toggle="tooltip"
                                                           title="Ver planilla">
                                                            <i class="far fa-eye"></i></a>
                                                    @else
                                                        <a href="{{route('planillas-especial.ver',['id'=> $data->pla_id])}}"
                                                           class="btn-accion-tabla disabled" data-toggle="tooltip"
                                                           title="Ver planilla">
                                                            <i class="far fa-eye"></i></a>
                                                    @endcan
                                                        @if($data->pla_estado=='C')
                                                            <a href="{{route('planillas-eventual.eliminar',['id'=> $data->pla_id])}}"
                                                               class="btn-accion-tabla eliminar-registro "
                                                               data-toggle="tooltip"
                                                               title="Eliminar este registro">
                                                                <i class="text-danger far fa-trash-alt"></i></a>
                                                        @endif
                                                </td>
                                            </tr>
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

    </section>
@endsection
