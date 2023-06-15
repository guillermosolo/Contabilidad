@extends("layout.layout")
@section("titulo")
    Prestacion Laboral

@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('prestacion-laboral') }}
@endsection

@section('contenido')

    <input type="hidden" id="routepath" value="{{url('planillas/prestaciones-laboral')}}">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <span class="card-title"><small>Prestacion Laboral</small></span>
                            <div class="card-tools">
                                <a href="{{route('prestacion-laboral')}}" class="btn  btn-info btn-sm">Volver a
                                    Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                                <a href="{{route('prestacion-laboral.pdf',['datas'=>encrypt($datas)])}}"
                                   class="btn btn-outline-danger btn-sm">
                                    Exportar a PDF<i class="far fa-file-pdf pl-1"></i></a>
                            </div>
                        </div>
                        <div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="tabla-data" cellspacing="0"
                                           width="100%">
                                        <thead class='thead-dark'>
                                        <tr>
                                            <th>Codigo Empleado</th>
                                            <th>Codigo</th>
                                            <th>Fecha Inicio Empleado</th>
                                            <th>Fecha Calculo</th>
                                            <th>Salario Mensual</th>
                                            <th>Salario Promedio</th>
                                            <th>Indemnizacion</th>
                                            <th>Vacaciones</th>
                                            <th>Bono 14</th>
                                            <th>Aguinaldo</th>
                                            <th>Quincena</th>
                                            <th>Total</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$datas['nombre']}}</td>
                                                <td>{{$datas['codigo']}}</td>
                                                <td>{{$datas['inicio_empleado']}}</td>
                                                <td>{{$datas['fecha_calculo']}}</td>
                                                <td>{{$datas['salario']}}</td>
                                                <td>{{$datas['salarioPromedio']}}</td>
                                                <td>{{$datas['indemnizacion']['monto']}}</td>
                                                <td>{{$datas['vacaciones']['monto']}}</td>
                                                <td>{{$datas['bono14']['monto']}}</td>
                                                <td>{{$datas['aguinaldo']['monto']}}</td>
                                                <td>{{$datas['quincena']['monto']}}</td>
                                                <td>{{$datas['aguinaldo']['monto']+$datas['bono14']['monto']+$datas['vacaciones']['monto']+$datas['indemnizacion']['monto']+$datas['quincena']['monto']}}</td>
                                            </tr>
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
