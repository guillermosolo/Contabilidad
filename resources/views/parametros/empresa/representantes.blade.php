@extends("layout.layout")
@section("titulo")
Empresa
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('empresa.representante',$data) }}
@endsection

@section('styles')
<link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
@endsection

@section('scripts')
<script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
<script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
<script src="{{asset("assets/pages/scripts/parametros/empresa/representante.js")}}" type="text/javascript"></script>
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('parametros/empresa')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.mensaje')
                @include('includes.form-error')
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Representantes de <small>{{$data->emp_nombre}}</small></h3>
                        <div class="card-tools">
                            <a href="{{route('empresa')}}" class="btn btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                            @can('actualizar parametros/empresa')
                            <a href="{{route('empresa.representante.crear',['id'=>$data->emp_id])}}"
                                class="btn btn-success btn-sm">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                            @else
                            <a href="{{route('empresa.representante.crear')}}"
                                class="btn btn-block btn-success btn-sm disabled">
                                Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover" id="tabla-data">
                            <thead class='thead-dark'>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Cargo</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th class="width70 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data->Representantes as $item)
                                <tr>
                                    <td>{{$item->repr_nombre}}</td>
                                    <td>{{App\Models\Admin\TiposRepresentante::getTipo($item->pivot->rep_tipo)}}</td>
                                    <td>{{\Carbon\Carbon::parse($item->pivot->rep_inicio)->format('d/m/Y')}}</td>
                                    <td>{{is_null($item->pivot->rep_fin)?'':\Carbon\Carbon::parse($item->pivot->rep_fin)->format('d/m/Y')}}
                                    </td>
                                    <td class="text-center">
                                        @if($item->pivot->rep_tipo!=2 && (is_null($item->pivot->rep_fin)||$item->pivot->rep_fin>date("Y-m-d H:i:s")))
                                        @can('actualizar parametros/empresa')
                                        <a href="{{route('empresa.representante.editar',['id'=> $item->pivot->rep_empresa,'representante'=>$item->pivot->rep_representante,'tipo'=>$item->pivot->rep_tipo,'inicio'=>\Carbon\Carbon::parse($item->pivot->rep_inicio)->format('Ymd')])}}"
                                            class="btn-accion-tabla" data-toggle="tooltip"
                                            title="Modificar Representación">
                                            <i class="far fa-edit"></i></a>
                                        @else
                                        <a href="#" class="btn-accion-tabla fin-asignacion disabled"
                                            data-toggle="tooltip" title="Eliminar este registro">
                                            <i class="far fa-edit"></i></a>
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
