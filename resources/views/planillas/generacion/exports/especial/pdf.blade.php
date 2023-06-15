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
    }
    main{
        margin: 0;
        padding: 10px;

    }
    .header-pdf {
        text-align: left;
        font-size: 0.8rem;
    }
    .titulo1 {
        font-weight: 0;
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

    .text-right {
        text-align: right;
    }

    .header {
        border: solid 1px black;

    }
    .hr-final{
        width: 100%;
    }
    .tr-final{
        border-top: solid 1px black;
    }
</style>
<body>
@inject('empleado','App\Models\Planilla\Empleado')

<header>
    <h4 style="text-align: center" class="titulos">{{$dataPlanilla['empresa'] }}</h4>
    <h4 style="text-align: center" class="titulos">Planilla de {{$dataPlanilla['pla_tipo']=='N'?'Bono 14':'Aguinaldo'}}</h4>
    <h4 style="text-align: center" class="titulos">{{strtoupper($dataPlanilla['terminal'])  }}</h4>
    <h4 style="text-align: center" class="titulo1 titulos">Del {{$dataPlanilla['pla_inicio']->format('d/m/Y')}} al {{$dataPlanilla['pla_fin']->format('d/m/Y')}}</h4>

</header>
<main>
    <table class="table">
        <thead class='header'>
        <tr>
            <th class="header-pdf"></th>
            <th class="header-pdf">NOMBRE</th>
            <th class="header-pdf">TOTAL</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($datas as $index => $data)
            <tr>
                <td >{{$index+1}}</td>
                <td>{{strtoupper($empleado->getNombreCompleto($data->empleado))}}</td>
                <td>{{Str::money($data->monto,'')}}</td>
            </tr>
        @endforeach
        <tr>
            <td class="tr-final"></td>
            <td class="tr-final">TOTAL GENERAL</td>
            <td class="tr-final">{{Str::money($total,'')}}</td>
        </tr>
        </tbody>
    </table>

    <div>
        <h4 class="titulo1">PRESENTADO POR:<span>________________________________</span></h4>
        <h4 class="titulo1"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Vo. Bo:<span>________________________________</span></h4>

    </div>
</main>

<script type="text/php">
        if (isset($pdf)) {
                $x = 700;
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
