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
    <script src="{{asset("assets/pages/scripts/planillas/generacion/show.js")}}" type="text/javascript"></script>
@endsection


@section('contenido')
    @inject('empleado','App\Models\Planilla\Empleado')
    <input type="hidden" id="routepath" value="{{url('planillas/generacion/eventual')}}">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <span class="card-title"><small>Detalle Planilla Eventual</small></span>
                            <div class="card-tools">
                                <a href="{{route('planillas-eventual')}}" class="btn  btn-info btn-sm">Volver a
                                    Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                                <a href="{{route('planillas-eventual.excel',['id'=>$planilla->pla_id])}}"
                                   class="btn btn-outline-success btn-sm">
                                    Exportar a Excel<i class="far fa-file-excel pl-1"></i></a>
                                <a href="{{route('planillas-eventual.pdf',['id'=>$planilla->pla_id])}}"
                                   class="btn btn-outline-danger btn-sm">
                                    Exportar a PDF<i class="far fa-file-pdf pl-1"></i></a>
                                <a href="{{route('planillas-eventual.finiquito',['id'=>$planilla->pla_id])}}"
                                   class="btn btn-outline-danger btn-sm">
                                    Exportar Finiquito PDF<i class="far fa-file-pdf pl-1"></i></a>
                            </div>
                        </div>
                        <div>
                            <div class="card-body">
                                <h4 style="text-align: center" class="titulos">{{$planilla->Empresa->emp_siglas}}</h4>
                                <h4 style="text-align: center" class="titulos">Planilla de Sueldos Eventual</h4>
                                <h4 style="text-align: center" class="titulos">{{$planilla->Terminal->ter_abreviatura}}</h4>
                                <h4 style="text-align: center" class="titulo1 titulos">
                                    Del {{$planilla->pla_inicio->format('d')}} AL {{$planilla->pla_fin->format('d')}}
                                    DE {{Str::nombreMes(intval($planilla->pla_fin->format('m')))}}
                                    DE {{$planilla->pla_fin->format('Y')}}</h4>

                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
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
                                            <th style="min-width:60px">TOTAL.</th>
                                            <th style="min-width:90px">I.G.S.S. (-)</th>
                                            <th style="min-width:90px">Descuento (-)</th>
                                            <th style="min-width:130px">TOTAL INGRESOS</th>
                                            <th style="min-width:110px">AGUINALDO (+)</th>
                                            <th style="min-width:90px">BONO 14 (+)</th>
                                            <th style="min-width:100px">VACACION. (+)</th>
                                            <th style="min-width:90px">INDEMN. (+)</th>
                                            <th style="min-width:130px">TOTAL A RECIBIR</th>
                                            <th style="min-width:130px">IGSS PAT. 12.67%</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($datas??[] as $data)
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
                                                <td>{{Str::money($data['total'],'Q.') }}</td>
                                                <td>{{Str::money($data['igss'],'Q.') }}</td>
                                                <td>{{Str::money($data['descuentos'],'Q.') }}</td>
                                                <td>{{Str::money($data['totalIngresos'],'Q.') }}</td>
                                                <td>{{Str::money($data['aguinaldo'],'Q.') }}</td>
                                                <td>{{Str::money($data['bono14'],'Q.') }}</td>
                                                <td>{{Str::money($data['vacaciones'],'Q.') }}</td>
                                                <td>{{Str::money($data['indemnizacion'],'Q.') }}</td>
                                                <td>{{Str::money($data['totalRecibido'],'Q.') }}</td>
                                                <td>{{Str::money($data['igssPatronal'],'Q.') }}</td>


                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tr>
                                            <td class="tr-final"></td>
                                            <td class="tr-final">TOTAL GENERAL</td>
                                            <td class="tr-final">{{$totales['turno']}}</td>
                                            <td class="tr-final">{{Str::money($totales['salario'],'Q.')}}</td>
                                            <td class="tr-final">{{$totales['horaOrdinaria']}}</td>
                                            <td class="tr-final">{{Str::money($totales['vHoraExtra'],'Q.')}}</td>
                                            <td class="tr-final">{{Str::money($totales['horaExtra'],'Q.')}}</td>
                                            <td class="tr-final">{{Str::money($totales['totalSeptimo'],'Q.')}}</td>
                                            <td class="tr-final">{{Str::money($totales['totalOrdinaria'],'Q.')}}</td>
                                            <td class="tr-final">{{Str::money($totales['totalExtra'],'Q.')}}</td>
                                            <td class="tr-final">{{Str::money($totales['bonificacion'],'Q.')}}</td>
                                            <td class="tr-final">{{Str::money($totales['subtotal'],'Q.')}}</td>
                                            <td class="tr-final">{{Str::money($totales['total'],'Q.')}}</td>
                                            <td class="tr-final">{{Str::money($totales['igss'],'Q.')}}</td>
                                            <td class="tr-final">{{Str::money($totales['descuentos'],'Q.')}}</td>
                                            <td class="tr-final">{{Str::money($totales['totalIngresos'],'Q.')}}</td>
                                            <td class="tr-final">{{Str::money($totales['aguinaldo'],'Q.')}}</td>
                                            <td class="tr-final">{{Str::money($totales['bono14'],'Q.')}}</td>
                                            <td class="tr-final">{{Str::money($totales['vacaciones'],'Q.')}}</td>
                                            <td class="tr-final">{{Str::money($totales['indemnizacion'],'Q.')}}</td>
                                            <td class="tr-final">{{Str::money($totales['totalRecibido'],'Q.')}}</td>
                                            <td class="tr-final">{{Str::money($totales['igssPatronal'],'Q.')}}</td>

                                        </tr>
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
