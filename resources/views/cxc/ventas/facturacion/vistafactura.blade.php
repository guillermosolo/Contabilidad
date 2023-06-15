<!DOCTYPE html>
<html lang="es">

<head>
    <style>
        .imagen1 {
            text-align: center;
            font-family: "arial"
        }

        div {
            text-align: center;
            font-family: "arial"
        }
    </style>



    <style>
        #heading {
            color: white;
            font-family: "arial"
        }
    </style>
    <style>
        .tama {

            color: #fff;
            background-color: rgb(15, 121, 241);
            font-size: x-small;
            font-family: "arial"

        }

        .cuerpo {
            border: rgb(15, 121, 241) 1px solid;
            font-family: "arial"

        }

        .linea {
            font-size: x-small;
            font-family: "arial"

        }
    </style>
</head>

<body>
    <main>
        <table>
            <tr>
                <th height="15">

                    @if (file_exists(public_path()."/assets/img/logos/".$data->Empresa->emp_id.".jpg"))
                    <img src="{{asset("assets/img/logos/".$data->Empresa->emp_id.".jpg")}}" alt=""
                        class="mx-auto d-block" height="60px">
                    @elseif (file_exists(public_path()."/assets/img/logos/".$data->Empresa->emp_id.".png"))
                    <img src="{{asset("assets/img/logos/".$data->Empresa->emp_id.".png")}}" alt=""
                        class="mx-auto d-block" height="60px">
                    @else|
                    <img src="{{asset("assets/img/logos/nologo.png")}}" alt="" class="mx-auto d-block" height="100px">
                    @endif

                </th>

                <th class="linea" height="15" width="300">
                    {{$data->Empresa->emp_nombre}}
                    <br>{{$data->Empresa->emp_siglas}}
                    <br>{{$data->Empresa->emp_colonia}}
                    <br>{{$data->Empresa->Departamento->dep_descripcion}}
                    ,{{$data->Empresa->Departamento->dep_descripcion}}
                    <br> Nit: {{$data->Empresa->emp_NIT}}
                </th>

                <th>
                    <table class="cuerpo" WIDTH="250">
                        <p class="linea"> Documento Tributario Electrónico</p>
                        <tr>
                            <th class="tama">
                                FACTURA ELECTRONICA
                            </th>
                        </tr>
                        <tr>
                            <td class="linea" align="left">Serie: {{$data->ven_serie}}</td>
                        </tr>
                        <tr>
                            <td class="linea" align="left">Número: {{$data->ven_numDoc}}</td>
                        </tr>
                    </table>
                </th>
            </tr>
        </table>

        <table class="cuerpo">
            <tr></tr>
            <tr>
                <td class="linea" colspan="1">Nombre: {{$data->Cliente->per_nombre}}</td>

                <td class="linea"> Fecha: {{\Carbon\Carbon::parse($data->ven_fecha)->format('d/m/Y')}}</td>
            </tr>
            <tr>
                <td class="linea" colspan="1">Dirección: {{$data->Cliente->per_direccion}}</td>
                <td class="linea">NIT: {{$data->Cliente->per_nit}}
                </td>
            </tr>

            <tr class="tama">
                <th height="15" width="100">Cantidad</th>
                <th width="575">Descripción</th>
                <th width="100">Total</th>
            </tr>
            <tr>
            </tr>
            @foreach ($data->Detalles as $linea)
            <tr>

                <td class="linea">{{$linea->detv_cantidad}}</td>
                <td class="linea">{{$data->ven_descripcion}}</td>
                <td class="linea">{{Str::decimal($data->ven_total)}}</td>

            </tr>
            @endforeach

            <tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            <tr></tr>
            </tr>
            <tr>
                <td class="linea" colspan="3" align="center">SUJETO A PAGOS TRIMESTRALES</td>
            </tr>

            <td class="linea" colspan="1">Autorización: {{$data->ven_iiud}}</td>
            </tr>

            <tr>
                <td class="linea" colspan="1">Total en letras:</td>
                <td class="linea" align="right"> TOTAL: </td>
                <td class="linea" align="right">{{Str::decimal($data->ven_total)}}</td>
            </tr>
        </table>

        <table>
            <tr></tr>
            <tr>
                <td class="linea" colspan="2">Certificador: </td>
                <td class="linea" colspan="2" align="right"> Nit: </td>
                <td class="linea" align="right"> Correlativo Interno: {{$data->ven_correlativoInt}} </td>
            </tr>

            <tr>
                <td class="linea" colspan="2">Fecha Certificicación:
                    {{\Carbon\Carbon::parse($data->ven_fechaCert)->format('d/m/Y')}} </td>
            </tr>
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
</body>

</html>
