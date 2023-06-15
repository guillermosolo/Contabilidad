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
    <h3><center>Transacciones Bancarias Conciliadas</center></h3>
</header>
<main>
    <table class="table">
        @inject('det','App\Models\cyb\DetalleConciliacion')
        <thead class='thead-dark'>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Mes</th>
            <th scope="col">Año</th>
            <th scope="col">Saldo</th>
            <th scope="col">Total Concilado</th>
            <th scope="col">Cuenta Bancaria</th>
        </tr>
        </thead>
        <tbody>
        @foreach($transacciones as $conci)
            <tr>
                <td>{{$conci['con_id']}}</td>
                <td>@if($conci['con_mes'] == 1) Enero @elseif($conci['con_mes'] == 2)
                        Febrero @elseif($conci['con_mes'] == 3) Marzo
                    @elseif($conci['con_mes'] == 4) Abril @elseif($conci['con_mes'] == 5)
                        Mayo @elseif($conci['con_mes'] == 6) Junio
                    @elseif($conci['con_mes'] == 7) Julio @elseif($conci['con_mes'] == 8)
                        Agosto @elseif($conci['con_mes'] == 9) Septiembre
                    @elseif($conci['con_mes'] == 10)
                        Octubre @elseif($conci['con_mes'] == 11) Noviembre @else
                        Diciembre @endif</td>
                <td>{{$conci['con_anio']}}</td>
                <td>{{Str::money($conci['con_saldo'], "Q ")}}</td>
                <td>{{Str::money($det->totalConciliacion($conci['con_id']), "Q ")}}</td>
                <td>{{$conci->ConciliacionCuenta->ctab_numero}}
                    - {{$conci->ConciliacionCuenta->Empresa->emp_siglas}}
                    - {{$conci->ConciliacionCuenta->Moneda->mon_nombre}}</td>
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
