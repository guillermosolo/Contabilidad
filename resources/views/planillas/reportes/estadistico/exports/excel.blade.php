    <style >
        .td-class{
            border-top: 1px solid;
        }
    </style>

<table class="table table-striped table-hover" id="tabla-data" cellspacing="0"
       width="100%">
    <thead class='thead-dark'>
    <tr>

        <th   align="justify"  class="td-class">Número de empleado</th>
        <th   align="justify" class="td-class">Primer nombre</th>
        <th   align="justify" class="td-class">Segundo nombre</th>
        <th   align="justify" class="td-class">Primer apellido</th>
        <th   align="justify" class="td-class">Segundo apellido</th>
        <th   align="justify" class="td-class">Nacionalidad</th>
        <th   align="justify" class="td-class">Tipo de discapacidad</th>
        <th   align="justify" class="td-class">Estado civil</th>
        <th   align="justify" class="td-class">Documento identificación (DPI, Pasaporte u otro)</th>
        <th   align="justify" class="td-class">Número de documento</th>
        <th   align="justify" class="td-class">País de origen</th>
        <th   align="justify" class="td-class">Lugar de nacimiento</th>
        <th   align="justify" class="td-class">Número de Identificación Tributaria (NIT)</th>
        <th   align="justify" class="td-class">Número de afiliación IGSS</th>
        <th   align="justify" class="td-class">Sexo (M) O (F)</th>
        <th   align="justify" class="td-class">Fecha de nacimiento</th>
        <th   align="justify" class="td-class">Cantidad de hijos</th>
        <th   align="justify" class="td-class">Ha trabajado en el extranjero</th>
        <th   align="justify" class="td-class">Ocupación en el extranjero</th>
        <th   align="justify" class="td-class">País</th>
        <th   align="justify" class="td-class">Motivo de la finalización de la relación laboral en el extranjero</th>
        <th   align="justify" class="td-class">Nivel académico alcanzado (poner el más alto)</th>
        <th   align="justify" class="td-class">Título o diploma obtenido</th>
        <th   align="justify" class="td-class">Pueblo de pertenencia</th>
        <th   align="justify" class="td-class">Idiomas que domina</th>
        <th   align="justify" class="td-class">Temporalidad del contrato</th>
        <th   align="justify" class="td-class">Tipo de contrato</th>
        <th   align="justify" class="td-class">Fecha de inicio de labores</th>
        <th   align="justify" class="td-class">Fecha de reinicio de labores</th>
        <th   align="justify" class="td-class">Fecha de retiro de labores</th>
        <th   align="justify" class="td-class">Ocupación</th>
        <th   align="justify" class="td-class">Jornada de trabajo</th>
        <th   align="justify" class="td-class">Días laborados en el año</th>
        <th   align="justify" class="td-class">Número de expediente del permiso de extranjero</th>
        <th   align="justify" class="td-class">Salario mensual nominal</th>
        <th   align="justify" class="td-class">Salario anual nominal</th>
        <th   align="justify" class="td-class">Bonificación Decreto 78-89 (Q.250.00)</th>
        <th   align="justify" class="td-class">Total horas extras anuales</th>
        <th   align="justify" class="td-class">Valor de la hora extra</th>
        <th   align="justify" class="td-class">Monto Aguinaldo Decreto 76-78</th>
        <th   align="justify" class="td-class">Monto Bono 14 Decreto 42-92</th>
        <th   align="justify" class="td-class">Retribución por comisiones</th>
        <th   align="justify" class="td-class">Retribución por comisiones Viáticos</th>
        <th   align="justify" class="td-class">Bonificaciones adicionales</th>
        <th   align="justify" class="td-class">Retribución por vacaciones</th>
        <th   align="justify" class="td-class">Retribución por indemnización (Artículo 82 Código de Trabajo)</th>


    </tr>
    </thead>
    <tbody>
    @foreach($datas as $index =>$item)
        <tr>
            <td>{{$index+1}}</td>
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
            <td></td>

        </tr>
    @endforeach

    </tbody>
</table>
