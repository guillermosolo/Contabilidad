<!DOCTYPE html>
<html lang="es">

<head>
    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
            border: none;
        }

        td {
            font-size: 75%;
            border: none;
            text-align: center;
        }

        th {
            background-color: #292428;
            color: white;
            border: none;
            font-size: 0.9rem;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .text-right{
            text-align: right;
        }
    </style>
</head>

<body>
<header>
    <h3><center>Liquidaciones Autorizadas de Cajas Chicas</center></h3>
</header>
<main>
    <table class="table">
        @inject('detalle','App\Models\cyb\DetalleLiquidacionCC')
        <thead class='thead-dark'>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Descripción</th>
            <th scope="col">Fecha</th>
            <th scope="col">Caja Chica</th>
            <th scope="col">Suma de Autorizados</th>
            <th scope="col">Detalles Completos</th>
            <th scope="col">Estado</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($liquidaciones as $liquid)
            <tr>
                <td scope="row">{{$liquid['lcc_id']}}</td>
                <td>{{$liquid['lcc_descripcion']}}</td>
                <td>{{$liquid['lcc_fecha']}}</td>
                <td>{{$liquid->Cajas->cch_nombre}}</td>
                <td>{{Str::money($detalle->totalDetallesCajas($liquid['lcc_id']),"Q ")}}</td>
                <td>{{Str::money($detalle->DetallesCompletos($liquid['lcc_id']),"Q ")}}</td>
                <td>{{$liquid['lcc_pendiente'] == 0? 'Pendiente': 'Liquidada'}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</main>
<script type="text/php">
        if (isset($pdf)) {
                $x = 700;
                $y = 595;
                $text = "Página {PAGE_NUM} de {PAGE_COUNT}";
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
