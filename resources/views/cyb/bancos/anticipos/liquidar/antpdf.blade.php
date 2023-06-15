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
        @inject('detalle','App\Models\cyb\DetalleAnticipo')

        <thead class='thead-dark'>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Número</th>
            <th scope="col">Fecha</th>
            <th scope="col">Cheque</th>
            <th scope="col">Proveedor</th>
            <th scope="col">Monto</th>
            <th scope="col">Total de Detalles </th>
            <th scope="col">Estado</th>
        </tr>
        </thead>
        <tbody>
        @foreach($anticipos as $anticipo)
            <tr>
                <td scope="row">{{$anticipo['ant_id']}}</td>
                <td>{{$anticipo['ant_numero']}}</td>
                <td>{{$anticipo['ant_fecha']}}</td>
                <td>{{$anticipo->ChequeAnticipo->che_numero}}</td>
                <td>@if($anticipo['ant_proveedor']==null)
                        No Aplica
                    @else
                        {{$anticipo->ProveedorAnticipo->Persona->per_nombre}}
                    @endif
                </td>
                <td>{{Str::money($anticipo->ChequeAnticipo->che_monto,"Q ")}}</td>
                <td>{{$detalle->totalDetallesAnticipo($anticipo['ant_id'])}}</td>
                <td>@if($anticipo['ant_liquidado']==0)
                        No Liquidado
                    @else
                        Liquidado
                    @endif</td>
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

