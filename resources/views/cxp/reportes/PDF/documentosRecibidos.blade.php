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
        }

        th {
            background-color: #292428;
            color: white;
            border: none;
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
        <h3><center>Listado de Documentos Recibidos<center></h3>
    </header>
    <main>
        <table class="table">
            <thead class='thead-dark'>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Número de Doc.</th>
                    <th>Proveedor</th>
                    <th class="text-right">Monto</th>
                    <th>Empresa</th>
                    <th>Terminal</th>
                    <th>Correlativo Interno</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                <tr>
                    <td>{{$data->id}}</td>
                    <td>{{$data->tipo}}</td>
                    <td>{{$data->fecha}}</td>
                    <td>{{$data->numero}}</td>
                    <td>{{$data->proveedor}}</td>
                    <td class="text-right">{{Str::money($data->monto,$data->moneda . " ")}}</td>
                    <td>{{$data->empresa}}</td>
                    <td>{{$data->terminal}}</td>
                    <td>{{$data->correlativo}}</td>
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
