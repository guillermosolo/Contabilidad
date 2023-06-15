<table>
    <thead >
    <tr>
        <th></th>
        <th>NOMBRE</th>
        <th>PUESTO</th>
        <th>DIAS<br>LAB</th>
        <th>SUELDO<br>MENSUAL</th>
        <th>SUELDO<br>ORDINARIO</th>
        <th>BONIF. INCENT.</th>
        <th>OTRAS BONIF.</th>
        <th>HORAS<br>EXTRAS</th>
        <th>SUELDO<br>EXTRA</th>
        <th>SUBTOTAL</th>
        <th>IGSS</th>
        <th>ISR</th>
        <th>PRESTAMOS</th>
        <th>ANTICIPOS</th>
        <th>OTROS</th>
        <th>TOTAL<br>DESCTOS</th>
        <th>SALARIO<br>LIQUIDO</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($datas as $index => $data)
        <tr>
            <td >{{$index+1}}</td>
            <td>{{strtoupper($data->nombre)}}</td>
            <td></td>
            <td>{{$data->diasLab}}</td>
            <td>{{$data->sueldoMensual}}</td>
            <td>{{$data->sueldoOrdinario}}</td>
            <td>{{$data->bonificacion_incentivo}}</td>
            <td>{{$data->bonificaciones}}</td>
            <td>{{$data->horas_extras}}</td>
            <td>{{$data->sueldo_extra}}</td>
            <td>{{$data->subtotal}}</td>
            <td>{{$data->igss}}</td>
            <td>{{$data->isr}}</td>
            <td>{{$data->prestamos}}</td>
            <td>{{$data->anticipos}}</td>
            <td>{{$data->otros}}</td>
            <td>{{$data->totalDescuentos}}</td>
            <td>{{$data->sueldoLiquido}}</td>
        </tr>
    @endforeach
    <tr>
        <td class="tr-final"></td>
        <td class="tr-final">TOTAL GENERAL</td>
        <td class="tr-final"></td>
        <td class="tr-final">{{$totales['diasLab']}}</td>
        <td class="tr-final">{{$totales['sueldoMensual']}}</td>
        <td class="tr-final">{{$totales['sueldoOrdinario']}}</td>
        <td class="tr-final">{{$totales['bonificacion_incentivo']}}</td>
        <td class="tr-final">{{$totales['bonificaciones']}}</td>
        <td class="tr-final">{{$totales['horas']}}</td>
        <td class="tr-final">{{$totales['sueldo_extra']}}</td>
        <td class="tr-final">{{$totales['subtotal']}}</td>
        <td class="tr-final">{{$totales['igss']}}</td>
        <td class="tr-final">{{$totales['isr']}}</td>
        <td class="tr-final">{{$totales['prestamos']}}</td>
        <td class="tr-final">{{$totales['anticipos']}}</td>
        <td class="tr-final">{{$totales['otros']}}</td>
        <td class="tr-final">{{$totales['totalDescuentos']}}</td>
        <td class="tr-final">{{$totales['sueldoLiquido']}}</td>
    </tr>
    </tbody>
</table>
