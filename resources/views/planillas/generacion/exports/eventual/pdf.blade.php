<!DOCTYPE html>
<html lang="es">
<style>
    html {
        margin-top: 20px;
        margin-bottom: 30px;
        padding: 0;
        font-family: Arial, Helvetica, sans-serif;

    }

    header {
        margin: 0;
        padding: 0;
        font-size: 0.5rem;

    }

    main {
        margin: 0;
        padding-top: 10px;

    }

    .header-pdf {
        font-size: 0.35rem;
        border: solid 1px black;
        text-align: center;
        padding: 0;
        margin: 0;

    }

    .titulo1 {
        font-weight: 0;
    }

    .firma {
        font-weight: 0;
        font-size: 0.7rem;

    }

    .titulos {
        margin: 0;
        padding: 0;
    }

    .table {
        border-collapse: collapse;
        border: none;
    }

    .tr_item {
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

    .tr-final {
        border: solid 1px black;

    }

    .name-item {
        width: 150px;
    }

    .item {
        font-size: 0.5rem;
        text-align: right;
    }
    .tr_item-none{
        border-top: white solid 1px;
        border-bottom: white solid 1px;

    }
    .item-center {
        font-size: 0.5rem;
        text-align: center;
    }
</style>
<body>

<header>
    <h4 style="text-align: center" class="titulos">{{$planilla->Empresa->emp_nombre}}</h4>
    <h4 style="text-align: center" class="titulos">Planilla de Sueldos Eventual</h4>
    <h4 style="text-align: center" class="titulos"> {{$planilla->Terminal->ter_nombre}}</h4>
    <h4 style="text-align: center" class="titulo1 titulos">Del {{$planilla->pla_inicio->format('d')}}
        AL {{$planilla->pla_fin->format('d')}} DE {{Str::nombreMes(intval($planilla->pla_fin->format('m')))}}
        DE {{$planilla->pla_fin->format('Y')}}</h4>

</header>
<main>
    <div style="display: inline">
        <table class="table" style="width:100%;">
            <thead class='header'>
            <tr>
                <th class="header-pdf"></th>
                <th class="header-pdf name-item">NOMBRE</th>
                <th class="header-pdf">TURNO</th>
                <th class="header-pdf">VALOR DIA</th>
                <th class="header-pdf">HORAS ORDI.</th>
                <th class="header-pdf">VALOR&nbsp;H.<br>EXT.</th>
                <th class="header-pdf">HORAS<br>EXTRAS</th>
                <th class="header-pdf">SEPTIMO</th>
                <th class="header-pdf">TOTAL&nbsp;T.<br>ORDI.</th>
                <th class="header-pdf">TOTAL<br>EXTRA</th>
                <th class="header-pdf">BONIFI.</th>
                <th class="header-pdf">SUBTOTAL</th>
                <th class="header-pdf">TOTAL</th>
                <th class="header-pdf">I.G.S.S. (-)</th>
                <th class="header-pdf">DESCUENTO<br>(-)</th>
                <th class="header-pdf">TOTAL INGRESOS</th>
                <th class="header-pdf">AGUINALDO<br>(+)</th>
                <th class="header-pdf">BONO 14<br>(+)</th>
                <th class="header-pdf">VACACION.<br>(+)</th>
                <th class="header-pdf">INDEMN.<br>(+)</th>
                <th class="header-pdf">TOTAL&nbsp;A<br>RECIBIR</th>
                <td class="tr_item-none"></td>
                <th class="header-pdf">IGSS PAT.<br>12.67%</th>

            </tr>
            </thead>
            <tbody>
            @foreach ($datas??[] as $index => $data)
                <tr>
                    <td class="tr_item item ">{{$index+1}}</td>
                    <td class="tr_item item-center">{{$data['nombre']}}</td>
                    <td class="tr_item item-center">{{intval($data['turno'])}}</td>
                    <td class="tr_item item">{{Str::money($data['salario'],'') }}</td>
                    <td class="tr_item item-center">{{intval($data['horaOrdinaria']) }}</td>
                    <td class="tr_item item">{{Str::money($data['vHoraExtra'],'') }}</td>
                    <td class="tr_item item-center">{{intval($data['horaExtra'])}}</td>
                    <td class="tr_item item">{{Str::money($data['totalSeptimo'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['totalOrdinaria'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['totalExtra'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['bonificacion'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['subtotal'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['total'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['igss'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['descuentos'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['totalIngresos'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['aguinaldo'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['bono14'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['vacaciones'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['indemnizacion'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['totalRecibido'],'') }}</td>
                    <td class="tr_item-none "></td>
                    <td class="tr_item item">{{Str::money($data['igssPatronal'],'') }}</td>

                </tr>
            @endforeach
            </tbody>
            <tr>
                <td class="tr-final item "></td>
                <td class="tr-final item">TOTAL GENERAL</td>
                <td class="tr-final item-center">{{$totales['turno']}}</td>
                <td class="tr-final item">{{Str::money($totales['salario'],'')}}</td>
                <td class="tr-final item-center">{{intval($totales['horaOrdinaria']) }}</td>
                <td class="tr-final item">{{Str::money($totales['vHoraExtra'],'')}}</td>
                <td class="tr-final item-center">{{intval($totales['horaExtra'])}}</td>
                <td class="tr-final item">{{Str::money($totales['totalSeptimo'],'')}}</td>
                <td class="tr-final item">{{Str::money($totales['totalOrdinaria'],'')}}</td>
                <td class="tr-final item">{{Str::money($totales['totalExtra'],'')}}</td>
                <td class="tr-final item">{{Str::money($totales['bonificacion'],'')}}</td>
                <td class="tr-final item">{{Str::money($totales['subtotal'],'')}}</td>
                <td class="tr-final item">{{Str::money($totales['total'],'')}}</td>
                <td class="tr-final item">{{Str::money($totales['igss'],'')}}</td>
                <td class="tr-final item">{{Str::money($totales['descuentos'],'')}}</td>
                <td class="tr-final item">{{Str::money($totales['totalIngresos'],'')}}</td>
                <td class="tr-final item">{{Str::money($totales['aguinaldo'],'')}}</td>
                <td class="tr-final item">{{Str::money($totales['bono14'],'')}}</td>
                <td class="tr-final item">{{Str::money($totales['vacaciones'],'')}}</td>
                <td class="tr-final item">{{Str::money($totales['indemnizacion'],'')}}</td>
                <td class="tr-final item">{{Str::money($totales['totalRecibido'],'')}}</td>
                <td class="tr_item-none"></td>
                <td class="tr-final item">{{Str::money($totales['igssPatronal'],'')}}</td>

            </tr>

        </table>


    </div>

    <div>
        <h4 class="firma">PRESENTADO POR:<span>________________________________</span></h4>
        <h4 class="firma"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Vo.
            Bo:<span>________________________________</span></h4>

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
                $text = "{{$planilla->pla_fin->format('d/m/Y')}}";
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
