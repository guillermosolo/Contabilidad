@extends("layout.layout")
@section("titulo")
    {{$tipo=='D'?'Descuentos':'Bonificaciones'}}
@endsection

@section('breadcrumbs')
    @if($tipo==='D')
        {{ Breadcrumbs::render('descuento') }}
    @else
        {{ Breadcrumbs::render('bonificacion') }}
    @endif
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


@section('contenido')
    <input type="hidden" id="routepath" value="{{url($tipo=='D'?'planillas/descuentos':'planillas/bonificaciones')}}">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <span class="card-title"><small>{{$tipo=='D'?'Descuentos':'Bonificaciones'}}</small></span>
                            <div class="row d-flex justify-content-lg-end justify-content-sm-center">

                                <div class="bd-highlight p-2">
                                    @if($tipo==='D')
                                        <a href="{{route('descuento.crear')}}"
                                           class="btn btn-block btn-success btn-sm my-0 mx-2 @can('crear planillas/descuentos')  @else disabled @endcan">
                                            Nuevo Registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                    @else
                                        <a href="{{route('bonificacion.crear')}}"
                                           class="btn btn-block btn-success btn-sm my-0 mx-2 @can('crear planillas/bonificaciones')  @else disabled @endcan">
                                            Nuevo Registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                    @endif
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
                                            <th>Tipo</th>
                                            <th>Empresa</th>
                                            <th>Monto</th>
                                            <th>Inicio</th>
                                            <th>Fin</th>
                                            <th>CuentaContable</th>
                                            <th>General</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($datas??[] as $data)
                                            <tr>
                                                <td>{{$data->desc_id}}</td>
                                                <td>{{$data->TiposDesc->tipd_clase=='D'?'DESCUENTO POR ':'BONIFICACION POR '}}{{$data->TiposDesc->tipd_descripcion}}</td>
                                                <td>{{$data->CuentaContable->Empresa->emp_siglas}}</td>
                                                <td>{{$data->TiposDesc->tipd_forma=='F'?Str::money($data->desc_monto,'Q.'):$data->desc_monto.'%' }}</td>
                                                <td>{{$data->desc_inicio}}</td>
                                                <td>{{$data->desc_fin}}</td>
                                                <td>{{$data->CuentaContable->cta_codigo}}-{{$data->CuentaContable->cta_descripcion}}</td>
                                                <td>{{$data->desc_general==1?'SI':'NO'}}</td>


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
