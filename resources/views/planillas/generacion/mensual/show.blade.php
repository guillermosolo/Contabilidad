@extends("layout.layout")
@section("titulo")
    Detalle Planilla Mensual
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('planillas-mensual.show',$id) }}
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
                                <a href="{{route('planillas-mensual')}}" class="btn  btn-info btn-sm">Volver a
                                    Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                                <a href="{{route('planillas-mensual.excel',['id'=>$id])}}"
                                   class="btn btn-outline-success btn-sm">
                                    Exportar a Excel<i class="far fa-file-excel pl-1"></i></a>
                                <a href="{{route('planillas-mensual.pdf',['id'=>$id])}}"
                                   class="btn btn-outline-danger btn-sm">
                                    Exportar a PDF<i class="far fa-file-pdf pl-1"></i></a>
                            </div>
                        </div>
                        <div>
                            <div class="card-body">
                                <h4 style="text-align: center" class="titulos">{{$dataPlanilla['empresa'] }}</h4>
                                <h4 style="text-align: center" class="titulos">Planilla de Sueldos</h4>
                                <h4 style="text-align: center" class="titulos">{{ $dataPlanilla['terminal'] }}</h4>
                                <h4 style="text-align: center" class="titulo1 titulos">Del {{$dataPlanilla['dia']==15?'1':'16'}} AL {{$dataPlanilla['dia']==15?'15':$dataPlanilla['diaFinal']}} DE {{Str::nombreMes($dataPlanilla['mes'])}} DE {{$dataPlanilla['anio']}}</h4>

                                <div class="table-responsive">
                                    {{--                                    <table class="table table-striped table-hover" id="tabla-data" cellspacing="0"--}}

                                    <table class="table table-striped table-hover" cellspacing="0"
                                           width="100%">
                                        <thead class='thead-dark'>
                                        <tr>
                                            <th class="m-0 mx-1 p-0"></th>
                                            <th class="m-0 mx-1 p-0">NOMBRE</th>
                                            <th class="m-0 mx-1 p-0">PUESTO</th>
                                            <th class="m-0 mx-1 p-0">DIAS<br>LAB</th>
                                            <th class="m-0 mx-1 p-0">SUELDO<br>MENSUAL</th>
                                            <th class="m-0 mx-1 p-0">SUELDO<br>ORDINARIO</th>
                                            <th class="m-0 mx-1 p-0">BONIF.</th>
                                            <th class="m-0 mx-1 p-0">OTRAS BONIF.</th>
                                            <th class="m-0 mx-1 p-0">HORAS<br>EXTRAS</th>
                                            <th class="m-0 mx-1 p-0">SUELDO<br>EXTRA</th>
                                            <th class="m-0 mx-1 p-0">SUBTOTAL</th>
                                            <th class="m-0 mx-1 p-0">IGSS</th>
                                            <th class="m-0 mx-1 p-0">ISR</th>
                                            <th class="m-0 mx-1 p-0">PRESTAMOS</th>
                                            <th class="m-0 mx-1 p-0">ANTICIPOS</th>
                                            <th class="m-0 mx-1 p-0">OTROS</th>
                                            <th class="m-0 mx-1 p-0">TOTAL<br>DESCTOS</th>
                                            <th class="m-0 mx-1 p-0">SALARIO<br>LIQUIDO</th>
                                            <th class="m-0 mx-1 p-0">IGSS PAT.<br>12.67%</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($datas as $data)
                                            <tr>
                                                <td>{{$data->empleado}}</td>
                                                <td>{{strtoupper($data->nombre)}}</td>
                                                <td></td>
                                                <td>{{$data->diasLab}}</td>
                                                <td>{{Str::money($data->sueldoMensual,'')}}</td>
                                                <td>{{Str::money($data->sueldoOrdinario,'')}}</td>
                                                <td>{{Str::money($data->bonificacion_incentivo,'')}}</td>
                                                <td>{{Str::money($data->bonificaciones,'')}}</td>
                                                <td>{{$data->horas_extras}}</td>
                                                <td>{{Str::money($data->sueldo_extra,'')}}</td>
                                                <td>{{Str::money($data->subtotal,'')}}</td>
                                                <td>{{Str::money($data->igss,'')}}</td>
                                                <td>{{Str::money($data->isr,'')}}</td>
                                                <td>{{Str::money($data->prestamos,'')}}</td>
                                                <td>{{Str::money($data->anticipos,'')}}</td>
                                                <td>{{Str::money($data->otros,'')}}</td>
                                                <td>{{Str::money($data->totalDescuentos,'')}}</td>
                                                <td>{{Str::money($data->sueldoLiquido,'')}}</td>
                                                <td>{{Str::money($data->igssPatronal,'')}}</td>

                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="tr-final"></td>
                                            <td class="tr-final">TOTAL GENERAL</td>
                                            <td class="tr-final"></td>
                                            <td class="tr-final">{{$totales['diasLab']}}</td>
                                            <td class="tr-final">{{Str::money($totales['sueldoMensual'],'')}}</td>
                                            <td class="tr-final">{{Str::money($totales['sueldoOrdinario'],'')}}</td>
                                            <td class="tr-final">{{Str::money($totales['bonificacion_incentivo'],'')}}</td>
                                            <td class="tr-final">{{Str::money($totales['bonificaciones'],'')}}</td>
                                            <td class="tr-final">{{$totales['horas']}}</td>
                                            <td class="tr-final">{{Str::money($totales['sueldo_extra'],'')}}</td>
                                            <td class="tr-final">{{Str::money($totales['subtotal'],'')}}</td>
                                            <td class="tr-final">{{Str::money($totales['igss'],'')}}</td>
                                            <td class="tr-final">{{Str::money($totales['isr'],'')}}</td>
                                            <td class="tr-final">{{Str::money($totales['prestamos'],'')}}</td>
                                            <td class="tr-final">{{Str::money($totales['anticipos'],'')}}</td>
                                            <td class="tr-final">{{Str::money($totales['otros'],'')}}</td>
                                            <td class="tr-final">{{Str::money($totales['totalDescuentos'],'')}}</td>
                                            <td class="tr-final">{{Str::money($totales['sueldoLiquido'],'')}}</td>
                                            <td class="tr-final">{{Str::money($totales['igssPatronal'],'')}}</td>

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
