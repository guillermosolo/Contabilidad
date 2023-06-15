<table>
    <thead >
    <tr >
        <th ></th>
        <th>NOMBRE</th>
        <th>TURNO</th>
        <th >VALOR<br>DIA</th>
        <th >HORAS<br>ORDI.</th>
        <th >VALOR&nbsp;H.<br>EXT.</th>
        <th >HORAS<br>EXTRAS</th>
        <th >SEPTIMO</th>
        <th >TOTAL&nbsp;T.<br>ORDI.</th>
        <th >TOTAL<br>EXTRA</th>
        <th >BONIFI.</th>
        <th >SUB.<br>TOTAL</th>
        <th >TOTAL.</th>
        <th >I.G.S.S.<br>(-)</th>
        <th >DESCUENTO<br>(-)</th>
        <th >TOTAL INGRESOS</th>
        <th >AGUINALDO<br>(+)</th>
        <th >BONO 14<br>(+)</th>
        <th >VACACION.<br>(+)</th>
        <th >INDEMN.<br>(+)</th>
        <th >TOTAL&nbsp;A<br>RECIBIR</th>
        <th >IGSS PAT.<br>12.67%</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($datas??[] as $index => $data)
        <tr>
            <td >{{$index+1}}</td>
            <td >{{$data['nombre']}}</td>
            <td >{{$data['turno']}}</td>
            <td >{{$data['salario'] }}</td>
            <td >{{$data['horaOrdinaria']}}</td>
            <td >{{$data['vHoraExtra'] }}</td>
            <td >{{$data['horaExtra']}}</td>
            <td >{{$data['totalSeptimo'] }}</td>
            <td >{{$data['totalOrdinaria'] }}</td>
            <td >{{$data['totalExtra'] }}</td>
            <td >{{$data['bonificacion'] }}</td>
            <td >{{$data['subtotal'] }}</td>
            <td >{{$data['total'] }}</td>
            <td >{{$data['igss'] }}</td>
            <td >{{$data['descuentos'] }}</td>
            <td >{{$data['totalIngresos'] }}</td>
            <td >{{$data['aguinaldo'] }}</td>
            <td >{{$data['bono14'] }}</td>
            <td >{{$data['vacaciones'] }}</td>
            <td >{{$data['indemnizacion'] }}</td>
            <td >{{$data['totalRecibido'] }}</td>
            <td >{{$data['igssPatronal'] }}</td>

        </tr>
    @endforeach
    </tbody>
    <tr>
        <td ></td>
        <td>TOTAL GENERAL</td>
        <td>{{$totales['turno']}}</td>
        <td>{{$totales['salario']}}</td>
        <td>{{$totales['horaOrdinaria']}}</td>
        <td>{{$totales['vHoraExtra']}}</td>
        <td>{{$totales['horaExtra']}}</td>
        <td>{{$totales['totalSeptimo']}}</td>
        <td>{{$totales['totalOrdinaria']}}</td>
        <td>{{$totales['totalExtra']}}</td>
        <td>{{$totales['bonificacion']}}</td>
        <td>{{$totales['subtotal']}}</td>
        <td>{{$totales['total']}}</td>
        <td>{{$totales['igss']}}</td>
        <td>{{$totales['descuentos']}}</td>
        <td>{{$totales['totalIngresos']}}</td>
        <td>{{$totales['aguinaldo']}}</td>
        <td>{{$totales['bono14']}}</td>
        <td>{{$totales['vacaciones']}}</td>
        <td>{{$totales['indemnizacion']}}</td>
        <td>{{$totales['totalRecibido']}}</td>
        <td>{{$totales['igssPatronal']}}</td>
    </tr>
</table>
