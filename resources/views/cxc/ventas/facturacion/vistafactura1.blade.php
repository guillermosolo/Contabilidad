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
            border: rgb(15, 121, 241) 1px solid;
            font-family: "arial"

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

          .centrar{
            text-align: center;
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

                <th class="linea" height="15" width="250">
                    {{$data->Empresa->emp_nombre}}
                    <br>{{$data->Empresa->emp_siglas}}
                    <br>{{$data->Empresa->emp_colonia}}
                    <br>{{$data->Empresa->Departamento->dep_descripcion}}
                    ,{{$data->Empresa->Departamento->dep_descripcion}}
                    <br> Nit: {{$data->Empresa->emp_NIT}}
                </th>


                <th  WIDTH="205">
                    <table class="cuerpo" WIDTH="170">

                        <tr>
                           <!-- <th>
                                <p class="linea"> Documento Tributario Electrónico</p>
                            </th> -->

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
                    <p class="linea"> Tipo de Cambio: {{Str::decimal($data->ven_tipoCambio)}}</p>
                </th>
            </tr>


        </table>

        <table class="cuerpo">

            <tr>
                <td align="left" class="linea" colspan="2">Nombre: {{$data->Cliente->per_nombre}}</td>

                <td class="linea" align="right"> Fecha: {{\Carbon\Carbon::parse($data->ven_fecha)->format('d/m/Y')}}</td>
            </tr>
            <tr>
                <td align="left" class="linea" colspan="2">Dirección: {{$data->Cliente->per_direccion}}</td>
                <td class="linea" align="right">NIT: {{$data->Cliente->per_nit}}
                </td>
            </tr>

            <tr class="tama">
                <th clasws="verticalLine" height="15" width="100">Cantidad</th>
                <th width="350">Descripción</th>
                <th width="100">Total</th>
            </tr>

            @foreach ($data->Detalles as $linea)
            <tr>
               
                <td class="verticalLine">{{$linea->detv_cantidad}}</td>
                <td class="verticalLine">
                    @if($linea->detv_producto)
                    <span>{{$linea->Productos->prod_desc_lg}}</span>
                    @endif
                </td>
                <td class="verticalLine">{{Str::decimal($data->ven_total)}}</td>

            </tr>
            @endforeach


            <tr>
                <td class="horizontal" colspan="3" align="center">SUJETO A PAGOS TRIMESTRALES</td>
            </tr>

            <tr>
            <td align="left" class="horizontal" colspan="2">Autorización: {{$data->ven_iiud}}</td>
            </tr>

            <tr>
                <td align="left" class="horizontal" colspan="1">Total en letras:</td>
                <td class="horizontal" align="right"> TOTAL: </td>
                <td class="horizontal" align="right">{{Str::decimal($data->ven_total)}}</td>
            </tr>
        </table>

        <table>
            <tr></tr>
            <tr>
                <td align="left" colspan="2" class="linea" >Certificador: {{$data->Empresa->FEL->cer_nombre}} </td>
                <td class="linea" colspan="2"  align="right"> Nit: {{$data->Empresa->FEL->cer_nit}} </td>

                <td class="linea" colspan="2" align="right"> Correlativo Interno: {{$data->Correlativo->corr_correlativo}} </td>
            </tr>


            <tr>
                <td class="linea">Fecha Certificicación:
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
    </main>
</body>

</html>
