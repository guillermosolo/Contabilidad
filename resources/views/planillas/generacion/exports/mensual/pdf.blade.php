<!DOCTYPE html>
<html lang="es">
<style>
    html{
        margin-top: 20px;
        margin-bottom: 30px;
        padding: 0;
    }
    header{
        margin: 0;
        padding: 0;
        font-size: 0.7rem;

    }
    main{
        margin: 0;
        padding: 10px;

    }
    .header-pdf {
        font-size: 0.5rem;
        border: solid 1px black;
        text-align: center;


    }
    .titulo1 {
        font-weight: 0;
    }
    .firma {
        font-weight: 0;
        font-size: 0.7rem;

    }
    .titulos{
        margin: 0;
        padding: 0;

    }
    .table {
        width: 100%;
        border-collapse: collapse;
        border: none;
    }
    .tr_item{
        border: solid 1px black;
    }
    td {
        font-size: 75%;
        border: none;

    }

    th {
        color: black;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }


    .header {
        border: solid 1px black;

    }

    .tr-final{
        border: solid 1px black;

    }
    .name-item{
        width: 180px;
    }

    .item{
        font-size: 0.6rem;
        text-align: right;
    }
    .item-center{
        font-size: 0.6rem;
        text-align: center;
    }
    .tr_item-none{
        border-top: white solid 1px;
        border-bottom: white solid 1px;

    }
</style>
<body>

<header>
    <h4 style="text-align: center" class="titulos">{{$dataPlanilla['empresa'] }}</h4>
    <h4 style="text-align: center" class="titulos">Planilla de Sueldos</h4>
    <h4 style="text-align: center" class="titulos">{{ strtoupper($dataPlanilla['terminal'] ) }}</h4>
    <h4 style="text-align: center" class="titulo1 titulos">Del {{$dataPlanilla['dia']==15?'1':'16'}} AL {{$dataPlanilla['dia']==15?'15':$dataPlanilla['diaFinal']}} DE {{Str::nombreMes($dataPlanilla['mes'])}} DE {{$dataPlanilla['anio']}}</h4>

</header>
<main>
    <table class="table">
        <thead class='header'>
        <tr class="header">
            <th class="header-pdf "></th>
            <th class="header-pdf name-item">NOMBRE</th>
            <th class="header-pdf">PUESTO</th>
            <th class="header-pdf">DIAS<br>LAB</th>
            <th class="header-pdf">SUELDO<br>MENSUAL</th>
            <th class="header-pdf">SUELDO<br>ORDINARIO</th>
            <th class="header-pdf">BONIF. INCENT.</th>
            <th class="header-pdf">OTRAS BONIF.</th>
            <th class="header-pdf">HORAS<br>EXTRAS</th>
            <th class="header-pdf">SUELDO<br>EXTRA</th>
            <th class="header-pdf">SUBTOTAL</th>
            <th class="header-pdf">IGSS</th>
            <th class="header-pdf">ISR</th>
            <th class="header-pdf">PRESTAMOS</th>
            <th class="header-pdf">ANTICIPOS</th>
            <th class="header-pdf">OTROS</th>
            <th class="header-pdf">TOTAL<br>DESCTOS</th>
            <th class="header-pdf">SALARIO<br>LIQUIDO</th>
            <td class="tr_item-none"></td>
            <th class="header-pdf">IGSS PAT.<br>12.67%</th>

        </tr>
        </thead>
        <tbody>
        @foreach ($datas as $index=> $data)
            <tr>
                <td class="tr_item item"> {{$index+1}}</td>
                <td class="tr_item item" style="text-align:left;">{{strtoupper($data->nombre)}}</td>
                <td class="tr_item item"></td>
                <td class="tr_item item-center">{{$data->diasLab}}</td>
                <td class="tr_item item">{{Str::money($data->sueldoMensual,'')}}</td>
                <td class="tr_item item">{{Str::money($data->sueldoOrdinario,'')}}</td>
                <td class="tr_item item">{{Str::money($data->bonificacion_incentivo,'')}}</td>
                <td class="tr_item item">{{Str::money($data->bonificaciones,'')}}</td>
                <td class="tr_item item">{{$data->horas_extras}}</td>
                <td class="tr_item item">{{Str::money($data->sueldo_extra,'')}}</td>
                <td class="tr_item item">{{Str::money($data->subtotal,'')}}</td>
                <td class="tr_item item">{{Str::money($data->igss,'')}}</td>
                <td class="tr_item item">{{Str::money($data->isr,'')}}</td>
                <td class="tr_item item">{{Str::money($data->prestamos,'')}}</td>
                <td class="tr_item item">{{Str::money($data->anticipos,'')}}</td>
                <td class="tr_item item">{{Str::money($data->otros,'')}}</td>
                <td class="tr_item item">{{Str::money($data->totalDescuentos,'')}}</td>
                <td class="tr_item item">{{Str::money($data->sueldoLiquido,'')}}</td>
                <td class="tr_item-none"></td>
                <td class="tr_item item">{{Str::money($data->igssPatronal,'')}}</td>

            </tr>

        @endforeach

        <tr>
            <td class="item">TOTAL </td>
            <td class="item" style="text-align:left;">GENERAL</td>
            <td class="item"></td>
            <td class="item-center tr-final">{{$totales['diasLab']}}</td>
            <td class=" item tr-final">{{Str::money($totales['sueldoMensual'],'')}}</td>
            <td class=" item tr-final">{{Str::money($totales['sueldoOrdinario'],'')}}</td>
            <td class=" item tr-final">{{Str::money($totales['bonificacion_incentivo'],'')}}</td>
            <td class=" item tr-final">{{Str::money($totales['bonificaciones'],'')}}</td>
            <td class=" item tr-final">{{$totales['horas']}}</td>
            <td class=" item tr-final">{{Str::money($totales['sueldo_extra'],'')}}</td>
            <td class=" item tr-final">{{Str::money($totales['subtotal'],'')}}</td>
            <td class=" item tr-final">{{Str::money($totales['igss'],'')}}</td>
            <td class=" item tr-final">{{Str::money($totales['isr'],'')}}</td>
            <td class=" item tr-final">{{Str::money($totales['prestamos'],'')}}</td>
            <td class=" item tr-final">{{Str::money($totales['anticipos'],'')}}</td>
            <td class=" item tr-final">{{Str::money($totales['otros'],'')}}</td>
            <td class= "item tr-final">{{Str::money($totales['totalDescuentos'],'')}}</td>
            <td class=" item tr-final">{{Str::money($totales['sueldoLiquido'],'')}}</td>
            <td class="tr_item-none"></td>
            <td class="item tr-final" > {{Str::money($data->igssPatronal,'')}}</td>
        </tr>
        </tbody>
    </table>

    <div>
        <h4 class="firma">PRESENTADO POR:<span>________________________________</span></h4>
        <h4 class="firma"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Vo. Bo:<span>________________________________</span></h4>

    </div>
</main>

<script type="text/php">
        if (isset($pdf)) {
                $x = 675;
                $y = 570;
                $text = "Página {PAGE_NUM} de {PAGE_COUNT}";
                $font = null;
                $size = 10;
                $color = array(0,0,0);
                $word_space = 0.0;  //  default
                $char_space = 0.0;  //  default
                $angle = 0.0;   //  default
                $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
            }



           if (isset($pdf)) {
                $x = 50;
                $y = 570;
                $text = "{{$dataPlanilla['fecha']}}";
                $font = null;
                $size = 10;
                $color = array(0,0,0);
                $word_space = 0.0;  //  default
                $char_space = 0.0;  //  default
                $angle = 0.0;   //  default
                $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
            }

                if (isset($pdf)) {
                $x = 50;
                $y = 580;
                $text = "Cifras Expresadas en Quetzales";
                $font = null;
                $size = 10;
                $color = array(0,0,0);
                $word_space = 0.0;  //  default
                $char_space = 0.0;  //  default
                $angle = 0.0;   //  default
                $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
            }
</script>
</body>

</html>
