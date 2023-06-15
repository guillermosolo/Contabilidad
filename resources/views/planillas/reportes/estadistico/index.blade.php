@extends("layout.layout")
@section("titulo")
    Prestacion Laboral
@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('prestacion-laboral') }}
@endsection

@section('contenido')

    <input type="hidden" id="routepath" value="{{url('planillas/reportes/reportes-estadistico')}}">
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
                                <a href="{{route('reportes-estadistico')}}" class="btn  btn-info btn-sm">Volver a
                                    Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                                <a href="{{route('reportes-estadistico.excel',['datas'=>encrypt($datas)])}}"
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
                                            <th>Número de empleado</th>
                                            <th>Primer nombre</th>
                                            <th>Segundo nombre</th>
                                            <th>Primer apellido</th>
                                            <th>Segundo apellido</th>
                                            <th>Nacionalidad</th>
                                            <th>Tipo de discapacidad</th>
                                            <th>Estado civil</th>
                                            <th>Documento identificación (DPI, Pasaporte u otro)</th>
                                            <th>Número de documento</th>
                                            <th>País de origen</th>
                                            <th>Lugar de nacimiento</th>
                                            <th>Número de Identificación Tributaria (NIT)</th>
                                            <th>Número de afiliación IGSS</th>
                                            <th>Sexo (M) O (F)</th>
                                            <th>Fecha de nacimiento</th>
                                            <th>Cantidad de hijos</th>
                                            <th>Ha trabajado en el extranjero</th>
                                            <th>Ocupación en el extranjero</th>
                                            <th>País</th>
                                            <th>Motivo de la finalización de la relación laboral en el extranjero</th>
                                            <th>Nivel académico alcanzado (poner el más alto)</th>
                                            <th>Título o diploma obtenido</th>
                                            <th>Pueblo de pertenencia</th>
                                            <th>Idiomas que domina</th>
                                            <th>Temporalidad del contrato</th>
                                            <th>Tipo de contrato</th>
                                            <th>Fecha de inicio de labores</th>
                                            <th>Fecha de reinicio de labores</th>
                                            <th>Fecha de retiro de labores</th>
                                            <th>Ocupación</th>
                                            <th>Jornada de trabajo</th>
                                            <th>Días laborados en el año</th>
                                            <th>Número de expediente del permiso de extranjero</th>
                                            <th>Salario mensual nominal Salario anual nominal</th>
                                            <th>Bonificación Decreto 78-89 (Q.250.00)</th>
                                            <th>Total horas extras anuales</th>
                                            <th>Valor de la hora extra</th>
                                            <th>Monto Aguinaldo Decreto 76-78</th>
                                            <th>Monto Bono 14 Decreto 42-92</th>
                                            <th>Retribución por comisiones Viáticos</th>
                                            <th>Bonificaciones adicionales</th>
                                            <th>Retribución por vacaciones</th>
                                            <th>Retribución por indemnización (Artículo 82 Código de Trabajo)</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($datas as $index =>$item)
                                            <tr>
                                                <td>{{$index++}}</td>
                                                <td>{{$item['empl_nom1']}}</td>
                                                <td>{{$item['empl_nom2']}}</td>
                                                <td>{{$item['empl_epe1']}}</td>
                                                <td>{{$item['empl_epe2']}}</td>
                                                <td>{{$item['empl_nacionalidad']}}</td>
                                                <td>{{$item['empl_discapacidad']}}</td>
                                                <td>{{$item['empl_estadoCivil']}}</td>
                                                <td>{{$item['empl_tipoDocID']}}</td>
                                                <td>{{$item['empl_docID']}}</td>
                                                <td>{{$item['empl_origen']}}</td>
                                                <td>{{$item['empl_lugNac']}}</td>
                                                <td>{{$item['empl_NIT']=='CF'?'':$item['empl_NIT']}}</td>
                                                <td>{{$item['empl_IGSS']}}</td>
                                                <td>{{$item['empl_sexo']}}</td>
                                                <td>{{\Carbon\Carbon::parse($item['empl_fecNac'])->format('d/m/Y')}}</td>
                                                <td>{{$item['empl_hijos']}}</td>
                                                <td>{{$item['extranjero']?'SI':'NO'}}</td>
                                                <td>{{$item['extranjero']?$item['extranjero']['trex_ocupacion']:''}}</td>
                                                <td>{{$item['extranjero']?$item['extranjero']['trex_pais']:''}}</td>
                                                <td>{{$item['extranjero']?$item['extranjero']['trex_motivo']:''}}</td>
                                                <td>{{$item['empl_nivelAcad']}}</td>
                                                <td>{{$item['empl_titulo']}}</td>
                                                <td>{{$item['empl_pueblo']}}</td>
                                                <td>{{$item['idiomas']}}</td>
                                                <td>{{$item['empl_temporalidad']}}</td>
                                                <td>{{$item['empl_tipoContrato']}}</td>
                                                <td>{{\Carbon\Carbon::parse($item['empl_inicio'])->format('d/m/Y')}}</td>
                                                <td></td>
                                                <td>{{\Carbon\Carbon::parse($item['empl_retiro'])->format('d/m/Y')}}</td>
                                                <td>{{$item['empl_ocupacion']}}</td>
                                                <td>{{$item['empl_jornada']}}</td>
                                                <td>{{$item['diasLab']}}</td>
                                                <td>{{$item['empl_expedienteExt']}}</td>
                                                <td>{{$item['empl_salario']}}</td>
                                                <td>{{$item['salario_anual']}}</td>
                                                <td>{{$item['bonificacion']}}</td>
                                                <td>{{$item['horasExtras']}}</td>
                                                <td>{{$item['valorHoraExtra']}}</td>
                                                <td>{{$item['aguinaldo']}}</td>
                                                <td>{{$item['bono14']}}</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
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
