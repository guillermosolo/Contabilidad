@extends("layout.layout")
@section("titulo")
    Detalle Planilla Especial
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('planillas-especial.ver',$id) }}
@endsection
@section("styles")
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
    <style>
        .tr-final{
            border-top: solid 1px black;
        }
    </style>

@endsection
@section("scriptPlugins")
    <script src="{{asset("assets/plugins/datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}"></script>
@endsection

@section("scripts")
    <script src="{{asset("assets/pages/scripts/planillas/generacion/show.js")}}" type="text/javascript"></script>
@endsection


@section('contenido')
    @inject('empleado','App\Models\Planilla\Empleado')
    <input type="hidden" id="routepath" value="{{url('planillas/generacion/mensual')}}">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <span class="card-title"><small>Detalle Planilla Mensual</small></span>
                            <div class="card-tools">
                                <a href="{{route('planillas-especial')}}" class="btn  btn-info btn-sm">Volver a
                                    Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                                <a href="{{route('planillas-especial.excel',['id'=>$id])}}"
                                   class="btn btn-outline-success btn-sm">
                                    Exportar a Excel<i class="far fa-file-excel pl-1"></i></a>
                                <a href="{{route('planillas-especial.pdf',['id'=>$id])}}"
                                   class="btn btn-outline-danger btn-sm">
                                    Exportar a PDF<i class="far fa-file-pdf pl-1"></i></a>
                            </div>
                        </div>
                        <div>
                            <div class="card-body">
                                <h4 style="text-align: center" class="titulos">{{$dataPlanilla['empresa']  }}</h4>
                                <h4 style="text-align: center" class="titulos">Planilla de {{$dataPlanilla['pla_tipo']=='N'?'Bono 14':'Aguinaldo'}}</h4>
                                <h4 style="text-align: center" class="titulos"> $dataPlanilla['terminal'] }}</h4>
                                <h4 style="text-align: center" class="titulo1 titulos">Del {{$dataPlanilla['pla_inicio']->format('d/m/Y')}} al {{$dataPlanilla['pla_fin']->format('d/m/Y')}} Del {{$dataPlanilla['anio']}}</h4>

                                <div class="table-responsive">
                                    {{--                                    <table class="table table-striped table-hover" id="tabla-data" cellspacing="0"--}}

                                    <table class="table table-striped table-hover" cellspacing="0"
                                           width="100%">
                                        <thead class='thead-dark'>
                                        <tr>
                                            <th class="m-0 mx-1 p-0"></th>
                                            <th class="m-0 mx-1 p-0">NOMBRE</th>
                                            <th class="m-0 mx-1 p-0">TOTAL</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($datas as $data)
                                            <tr>
                                                <td>{{$data->empleado}}</td>
                                                <td>{{strtoupper($empleado->getNombreCompleto($data->empleado))}}</td>
                                                <td>{{Str::money($data->monto,'Q.')}}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="tr-final"></td>
                                            <td class="tr-final">TOTAL GENERAL</td>
                                            <td class="tr-final">{{Str::money($total,'Q.')}}</td>
                                        </tr>
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
