@extends("layout.layout")
@section("titulo")
    Septimos de Planilla Eventual
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('planillas-eventual.crear') }}
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
    <script src="{{asset("assets/pages/scripts/planillas/generacion/eventual/generacion.js")}}"
            type="text/javascript"></script>
@endsection


@section('contenido')
    @inject('empleado','App\Models\Planilla\Empleado')
    <input type="hidden" id="authPath" value="{{url('planillas/generacion/eventual/septimo')}}">
    <input type="hidden" id="routepath" value="{{url('planillas/generacion/eventual')}}">
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
                                <a href="{{route('planillas-eventual')}}" class="btn  btn-info btn-sm">Volver a
                                    Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>

                            </div>
                        </div>
                        <div>
                            <div class="card-body">
                                {{--                                <h4 style="text-align: center" class="titulos">{{$dataPlanilla['empresa']??'Empresa' .' '. $dataPlanilla['terminal']??'Terminal' }}</h4>--}}
                                <h4 style="text-align: center" class="titulos">Planilla de Sueldos Eventual</h4>
                                {{--                                <h4 style="text-align: center" class="titulo1 titulos">Del {{$dataPlanilla['dia']==15?'1':'16'}} AL {{$dataPlanilla['dia']==15?'15':$dataPlanilla['diaFinal']}} DE {{Str::nombreMes($dataPlanilla['mes'])}} DE {{$dataPlanilla['anio']}}</h4>--}}

                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" cellspacing="0"
                                           width="100%">
                                        <thead class='thead-dark'>
                                        <tr>
                                            <th>Empleado</th>
                                            <th>NOMBRE</th>
                                            <th>TURNO</th>
                                            <th style="min-width:80px">VALOR DIA</th>
                                            <th style="min-width:145px">HORAS ORDINARIAS</th>
                                            <th style="min-width:145px">VALOR H. EXT.</th>
                                            <th style="min-width:110px">HORAS EXTRAS</th>
                                            <th style="min-width:60px">SEPTIMO</th>
                                            <th style="min-width:110px">TOTAL T. ORDI.</th>
                                            <th style="min-width:100px">TOTAL EXTRA</th>
                                            <th style="min-width:60px">BONIFI.</th>
                                            <th style="min-width:90px">SUB. TOTAL</th>
                                            <th style="min-width:130px">FORZAR SEPTIMO</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($datas??[] as $index =>  $data)
                                            <tr>
                                                <td>{{$data['empleado']}}</td>
                                                <td>{{$data['nombre']}}</td>
                                                <td>{{$data['turno']}}</td>
                                                <td>{{Str::money($data['salario'],'Q.') }}</td>
                                                <td>{{$data['horaOrdinaria']}}</td>
                                                <td>{{Str::money($data['vHoraExtra'],'Q.') }}</td>
                                                <td>{{$data['horaExtra']}}</td>
                                                <td>{{Str::money($data['totalSeptimo'],'Q.') }}</td>
                                                <td>{{Str::money($data['totalOrdinaria'],'Q.') }}</td>
                                                <td>{{Str::money($data['totalExtra'],'Q.') }}</td>
                                                <td>{{Str::money($data['bonificacion'],'Q.') }}</td>
                                                <td>{{Str::money($data['subtotal'],'Q.') }}</td>
                                                <td class="text-center">
                                                    <div class="icheck-green">
                                                        <input type="checkbox" id="checkbox{{$data['empleado']}}"
                                                               value="0"
                                                                 onclick="forzarSeptimo({{$data['empleado']}},'{{$id}}')">
                                                        <label for="checkbox{{$data['empleado']}}">
                                                        </label>
                                                    </div>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td class="tr-final"></td>
                                            <td class="tr-final">TOTAL GENERAL</td>
                                            <td class="tr-final">{{$totales['turno']}}</td>
                                            <td class="tr-final">{{Str::money($totales['salario'],'Q.')}}</td>
                                            <td class="tr-final">{{$totales['horaOrdinaria']}}</td>
                                            <td class="tr-final">{{Str::money($totales['vHoraExtra'],'Q.')}}</td>
                                            <td class="tr-final">{{$totales['horaExtra']}}</td>
                                            <td class="tr-final">{{Str::money($totales['totalSeptimo'],'Q.')}}</td>
                                            <td class="tr-final">{{Str::money($totales['totalOrdinaria'],'Q.')}}</td>
                                            <td class="tr-final">{{Str::money($totales['totalExtra'],'Q.')}}</td>
                                            <td class="tr-final">{{Str::money($totales['bonificacion'],'Q.')}}</td>
                                            <td class="tr-final">{{Str::money($totales['subtotal'],'Q.')}}</td>
                                            <td class="tr-final"></td>
                                        </tr>
                                        </tbody>
                                    </table>

                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">

                                <div class="d-flex justify-content-center">
                                    <a  class="btn btn-lg btn-outline-success float-right"
                                            href="{{route('planillas-eventual.insert')}}">Guardar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
