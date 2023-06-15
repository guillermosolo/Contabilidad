<!DOCTYPE html>
<html lang="es">
<style>
    html {
        margin-top: 40px;
        margin-bottom: 30px;
        padding: 0;
        font-family: Arial, Helvetica, sans-serif;

    }

    .header {
        margin: 0;
        padding: 0;
        font-size: 0.9rem;
        line-height: 1.4;

    }

    main {
        margin: 0;
        padding-top: 10px;

    }

    .titulo1 {
        font-weight: 0;
    }

    .firma {
        margin: 0;
        font-weight: 0;
        font-size: 0.9rem;
    }

    .titulos {
        margin: 0;
        padding: 0;
    }

    .div_firma {
        margin-bottom: 40px;
        margin-top: 10px;
    }

    .div_principal_empleado {
        margin-top: 20px;
        border-bottom: 2px solid black;
    }

    .div_principal {
        margin-top: 20px;
    }

    .div_items {
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .item_titulo {
        width: 350px;
        display: inline-block;
    }

    .item_data {
        display: inline-block;
    }

    .item_data_text {
        text-align: right;
        width: 90px;
    }
    .item_data_text_total{
        text-align: right;
        width: 70px;
        display: inline-block;

    }
    .item_data_q {
        text-align: left;
        display: inline-block;
    }
    .div_texto {
        margin-top: 60px;
        margin-bottom: 100px;

    }
</style>
<body>
<main>
    @php($diferencia =  $planilla->pla_inicio->diffInDays($planilla->pla_fin)+1)
    @php($inicio = $planilla->pla_inicio->format('d/m/Y'))
    @php($fin = $planilla->pla_fin->format('d/m/Y'))
    @php($titulo1 = 'RECIBI DE: '. $planilla->Empresa->emp_nombre)
    @php($formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT))
    @php($titulo2 = 'DEL '.$planilla->pla_inicio->format('d').' AL ' .$planilla->pla_fin->format('d') .' DE '. Str::nombreMes(intval($planilla->pla_fin->format('m'))). ' DE '. $planilla->pla_fin->format('Y'))
    @foreach ($datas??[] as $index => $data)
        <div class="header">
            <h4 style="text-align: center" class="titulos">FINIQUITO LABORAL</h4>
            <h4 style="text-align: center" class="titulos">{{$titulo1}}</h4>
            <h4 style="text-align: center" class="titulo1 titulos">POR CONCEPTO DE LA SIGUIENTE LIQUIDACION DE
                PRESTACIONES Y SALARIOS</h4>
            <h4 style="text-align: center" class="titulo1 titulos">{{$titulo2}}</h4>
        </div>
        <div class="div_principal_empleado">
            <div class="div_items">
                <div class="item_titulo">
                    1.- Código del Empleado
                </div>
                <div class="item_data">
                    <div class="item_data_text">
                        {{$data['codigoEmpleado']}}
                    </div>
                </div>
            </div>
            <div class="div_items">
                <div class="item_titulo">
                    2.- Nombre del Empleado.
                </div>
                <div class="item_data ">
                    <span style="border: 1px solid black">{{$data['nombre']}}</span>
                </div>
            </div>
            <div class="div_items">
                <div class="item_titulo">
                    3.- Puesto
                </div>
                <div class="item_data">
                </div>
            </div>
            <div class="div_items">
                <div class="item_titulo">
                    4.- Fecha de Inicio
                </div>
                <div class="item_data">
                    <div class="item_data_text">
                        {{$inicio}}
                    </div>
                </div>
            </div>
            <div class="div_items">
                <div class="item_titulo">
                    5.- Fecha de Retiro
                </div>
                <div class="item_data">
                    <div class="item_data_text">
                        {{$fin}}
                    </div>
                </div>
            </div>
            <div class="div_items">
                <div class="item_titulo">
                    6.- Total dias Trabajados
                </div>
                <div class="item_data">
                    <div class="item_data_text">
                        <span>{{$data['diasLab']}}</span>
                    </div>
                </div>
            </div>

        </div>
        <div class="div_principal">
            <h4 style="text-align: center; margin-bottom:6px; font-size:0.8rem" class="titulos">**DESGLOSE DE
                PRESTACIONES Y SALARIOS**</h4>
            <div class="div_items">
                <div class="item_titulo">
                    TOTAL DIAS TRABAJADOS
                </div>
                <div class="item_data">
                    <div class="item_data_text">
                        <span>{{$data['diasLab']}}</span>
                    </div>
                </div>
            </div>
            <div class="div_items">
                <div class="item_titulo">
                    SUELDO ORDINARIO
                </div>
                <div class="item_data">
                    <div class="item_data_q">
                        <span>Q.</span>
                    </div>
                    <div class="item_data_text_total">
                        <span>{{Str::money($data['totalOrdinaria'],'') }}</span>
                    </div>
                </div>
            </div>
            <div class="div_items">
                <div class="item_titulo">
                    SUELDO EXTRAORDINARIO
                </div>
                <div class="item_data">
                    <div class="item_data_q">
                        <span>Q.</span>
                    </div>
                    <div class="item_data_text_total">
                        <span>{{Str::money($data['totalExtra'],'') }}</span>
                    </div>
                </div>
            </div>
            <div class="div_items">
                <div class="item_titulo">
                    BONIFICACION DECRETO
                </div>
                <div class="item_data">
                    <div class="item_data_q">
                        <span>Q.</span>
                    </div>
                    <div class="item_data_text_total">
                        <span>{{Str::money($data['bonificacion'],'') }}</span>
                    </div>

                </div>
            </div>
            <div class="div_items">
                <div class="item_titulo">
                    AGUINALDO
                </div>
                <div class="item_data">
                    <div class="item_data_q">
                        <span>Q.</span>
                    </div>
                    <div class="item_data_text_total">
                        <span>{{Str::money($data['aguinaldo'],'') }}</span>
                    </div>
                </div>
            </div>
            <div class="div_items">
                <div class="item_titulo">
                    BONO 14
                </div>
                <div class="item_data">
                    <div class="item_data_q">
                        <span>Q.</span>
                    </div>
                    <div class="item_data_text_total">
                        <span>{{Str::money($data['bono14'],'') }}</span>
                    </div>
                </div>
            </div>
            <div class="div_items">
                <div class="item_titulo">
                    VACACIONES
                </div>
                <div class="item_data">
                    <div class="item_data_q">
                        <span>Q.</span>
                    </div>
                    <div class="item_data_text_total">
                        <span>{{Str::money($data['vacaciones'],'') }}</span>
                    </div>
                </div>
            </div>
            <div class="div_items">
                <div class="item_titulo">
                    INDEMNIZACION
                </div>
                <div class="item_data">
                    <div class="item_data_q">
                        <span>Q.</span>
                    </div>
                    <div class="item_data_text_total">
                        <span>{{Str::money($data['indemnizacion'],'') }}</span>
                    </div>
                </div>
            </div>
            <div class="div_items">
                <div class="item_titulo">
                    OTROS INGRESOS
                </div>
                <div class="item_data">
                    <div class="item_data_q">
                        <span>Q.</span>
                    </div>
                    <div class="item_data_text_total">
                        <span>{{Str::money(0,'') }}</span>
                    </div>
                </div>
            </div>
            <span style="font-size:5px;line-height:1">_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</span>
        </div>
        <div class="div_principal">
            <div class="div_items">
                <div class="item_titulo">
                    SUB-TOTAL
                </div>
                <div class="item_data">
                    <div class="item_data_text">
                        @php($total = $data['totalOrdinaria']+$data['totalExtra']+$data['bonificacion']+$data['aguinaldo']+$data['bono14']+$data['vacaciones']+$data['indemnizacion'])

                        <div class="item_data_q">
                            <span>Q.</span>
                        </div>
                        <div class="item_data_text_total">
                            <span>{{Str::money($total,'') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <span style="font-size:5px;line-height:1">_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</span>
        </div>
        <div class="div_principal">
            <div class="div_items">
                <div class="item_titulo">
                    IGSS
                </div>
                <div class="item_data">
                    <div class="item_data_text">
                        <div class="item_data_q">
                            <span>Q.</span>
                        </div>
                        <div class="item_data_text_total">
                            <span>{{Str::money($data['igss'],'') }}</span>
                        </div>

                    </div>
                </div>
            </div>
            <div class="div_items">
                <div class="item_titulo">
                    ANTICIPOS
                </div>
                <div class="item_data">
                    <div class="item_data_q">
                        <span>Q.</span>
                    </div>
                    <div class="item_data_text_total">
                        <span>{{Str::money(0,'') }}</span>
                    </div>
                </div>
            </div>
            <div class="div_items">
                <div class="item_titulo">
                    OTROS DESCUENTOS
                </div>
                <div class="item_data">
                    <div class="item_data_q">
                        <span>Q.</span>
                    </div>
                    <div class="item_data_text_total">
                        <span>{{Str::money($data['descuentos'],'') }}</span>
                    </div>
                </div>
            </div>
            <span style="font-size:5px;line-height:1">_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</span>
        </div>
        <div class="div_principal">
            <div class="div_items">
                <div class="item_titulo">
                    TOTAL DESCUENTOS
                </div>
                <div class="item_data">
                    <div class="item_data_text">
                        @php($descuento = $data['igss']+$data['descuentos'])
                        <div class="item_data_q">
                            <span>Q.</span>
                        </div>
                        <div class="item_data_text_total">
                            <span>{{Str::money($descuento,'') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <span style="font-size:5px;line-height:1">_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _</span>
        </div>
        <div class="div_principal">

            <div class="div_items">
                <div class="item_titulo" style="font-weight:bold;">
                    TOTAL LÍQUIDO A RECIBIR
                </div>
                <div class="item_data" style="font-weight: bold">
                    <div class="item_data_q">
                        <span>Q.</span>
                    </div>
                    <div class="item_data_text_total">
                        @php($total= $total-$descuento)
                        <span>{{Str::money($total,'') }}</span>
                    </div>
                </div>
            </div>
                <h5 style="font-weight:bold;font-size: 0.9rem; margin:0">
                    @php($decimales = explode(".", number_format($total, 2, ".", "")) )
                    @php($total_letras =  strtoupper($formatterES->format($decimales[0])) . ' ' . $decimales[1] . '/100 QUETZALES' )
                    TOTAL EN LETRAS:<br> {{ $total_letras}}
                </h5>
        </div>
        <div class="div_texto">
            <p style="font-size:14px; margin: 0;width:660px;text-align: justify">
                Hago constar que se me pagaron todas mis prestaciones y que no tengo ningún reclamo en contra de la empresa, y por este medio extiendo amplio y eficaz finiquito laboral.
            </p>

        </div>
        <div class="div_firma">
            <h4 class="firma">Recibí Conforme:<span>____________________________</span></h4>
            <h4 class="firma" style="font-weight: bold;margin-left: 115px">{{$data['nombre']}}</h4>
            <h4 class="firma" style="font-weight: bold;margin-left: 115px">DPI: {{ $data['dpi']}}</h4>
        </div>
        <div style="page-break-after:always"></div>
    @endforeach


</main>
</body>

</html>
