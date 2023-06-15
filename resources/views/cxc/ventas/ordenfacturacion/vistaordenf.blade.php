<!DOCTYPE html>
<html lang="es">

<head>
    <style>
        .imagen1 {
            text-align: center;
            font-family: "arial"
        }


        #heading {
            color: white;
            font-family: "arial"
        }


        .tama {

            color: #fff;
            background-color: rgb(15, 121, 241);
            font-size: x-small;
            font-family: "arial"

        }

        .cuerpo {
            border: black 1px solid;


        }

        .linea {
            font-size: x-small;
            font-family: "arial"

        }

        .horizontal {
            border-bottom: rgb(15, 121, 241) 1px solid;
            font-size: x-small;
            font-family: "arial"

        }

        .verticalLine {
            border-left: rgb(15, 121, 241) 1px solid;
            font-size: x-small;
            font-family: "arial"
        }

        .letter {

            border: 1px solid white;

            font-size: x-small;
            font-family: "arial"
        }

        .letter2 {

            border: 1px solid white;
            font-size: x-small;
            font-family: "arial"
        }

        .letter1 {

            font-size: x-small;
            font-family: "arial"
        }

        .total {
            width: 25%;
            text-align: right;
            vertical-align: top;
            border: 1px solid white;
            font-family: "arial";
            font-size: x-small;
        }

        .centrar {
            text-align: left;
        }

        .borde {

            text-align: right;
            vertical-align: top;
            border: solid #000;
            font-family: "arial";
            font-size: x-small;
        }

        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

    </style>
</head>

<body>

    <main>
        <table class="letter2 ">
            <tr class="letter2 ">
                <th height="15">
                <td>

                    @if (file_exists(public_path() . '/assets/img/logos/' . $data->Empresa->emp_id . '.jpg'))
                        <img src="{{ public_path() . '/assets/img/logos/' . $data->Empresa->emp_id . '.jpg'}}" alt=""
                            class="mx-auto d-block" height="100px">
                    @elseif (file_exists(public_path()."/assets/img/logos/".$data->Empresa->emp_id.".png"))
                        <img src="{{ public_path() .'/assets/img/logos/' . $data->Empresa->emp_id . '.png' }}" alt=""
                            class="mx-auto d-block" height="100px">
                    @else
                        <p>{{ $data->Empresa->emp_siglas }}</p>
                    @endif
                </td>
                </th>
        </table>

        <table>

            </td>
            </tr>

            <tr>
                <td class="letter"><strong>BUQUE </strong></td>
                <td class="letter2"> {{ $data->ordf_buque }} </td>
            </tr>

            <tr>
                <td class="letter"> <strong>VIAJE </strong></td>
                <td class="letter2"> {{ $data->ordf_viaje }}</td>
            </tr>

            <tr>
                <td class="letter"><strong>ETA </strong></td>
                <td style="width: 450px;" class="letter2">
                    {{ \Carbon\Carbon::parse($data->ordf_eta)->format('d/m/Y') }}</td>
                <th>
                <td class="letter"><strong>TIPO CAMBIO </strong></td>
                <td class="letter">{{($data->ordf_tipoCambio) }} </td>
                </th>
            </tr>


            <tr>
                <td class="letter"><strong> DESCRIPCIÓN </strong></td>
                <td class="letter2">{{ $data->ordf_descripcion }}</td>
            </tr>



        </table>

        <table style="width:100%" border="1" class="borde">

            <tr class="header">
                <th style="width: 250px;">SERVICIO</th>
                <th style="width: 45px;">Cantidad</th>
                <th style="width: 50px;">Tarifa</th>
                <th style="width: 80px;">Subtotal&nbsp;<br>sin IVA</th>
                <th style="width: 80px;">IVA</th>
                <th style="width: 80px;">Total</th>
                <th style="width: 80px;">Total Q.</th>

            </tr>

            @foreach ($data->detalleOrdenFacturacion as $linea)

                <tr>
                    <td style="text-align: left" width="180%">
                        @if ($linea->dof_producto)
                            <span>{{ $linea->Productos->prod_desc_lg }}</span>
                        @endif
                    </td>
                    <td>{{ Str::decimal($linea->dof_cantidad) }}</td>

                    <td>{{ Str::money($linea->dof_tarifa, $data->moneda->mon_simbolo . ' ') }}</td>

                    <td>{{ Str::money($linea->dof_tarifa * $linea->dof_cantidad, $data->moneda->mon_simbolo . ' ') }}
                    </td>
                    <td>{{ Str::money($linea->dof_tarifa * $linea->dof_cantidad * 0.12, $data->moneda->mon_simbolo . ' ') }}
                    </td>
                    <td>{{ Str::money($linea->dof_tarifa * $linea->dof_cantidad + $linea->dof_tarifa * $linea->dof_cantidad * 0.12, $data->moneda->mon_simbolo . ' ') }}
                    </td>
                    <td>Q.
                        {{ Str::decimal(($linea->dof_tarifa * $linea->dof_cantidad + $linea->dof_tarifa * $linea->dof_cantidad * 0.12) * $data->ordf_tipoCambio) }}

                    </td>


                </tr>




            @endforeach
        </table>
        <table>
            <tr>
                <td style="width: 600px;" class="letter"><strong>TOTAL DE PROFORMA </strong> </td>
                <th>
                <td> </td>
                <td style="width: 105px;" class="total">Q. {{ Str::decimal($data->ordf_total) }} </td>
                </th>
            </tr>
        </table>
        </table>


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
    </main>




</body>







</html>
