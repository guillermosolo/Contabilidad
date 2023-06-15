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
        margin-bottom: 50px;
    }

    .div_principal_empleado {
        margin-top: 20px;
    }

    .div_principal {
        margin-top: 20px;
    }

    .div_items {
        font-size: 0.9rem;
        margin-bottom: 5px;
    }

    .item_titulo {
        width: 350px;
        display: inline-block;
    }

    .item_titulo_detalle {
        width: 240px;
        display: inline-block;
    }

    .item_data {
        text-align: right;
        display: inline-block;
    }

    .item_titulo_detalle_dias {
        width: 60px;
        display: inline-block;
    }

    .item_titulo_detalle_total {
        display: inline-block;
        width: 100px;
    }
    .item_titulo_detalle_label{
        width: 150px;
        display: inline-block;
    }
    .item_titulo_detalle_final{
        margin-left: 270px;
        width: 500px;
        display: inline-block;
    }
    .item_data_text {
        width: 100px;
        display: inline-block;

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
    <div class="header">
        <h4 style="text-align: center" class="titulos">{{$data['empresa']}}</h4>
        <h4 style="text-align: center" class="titulo1 titulos">LIQUIDACION DE PRESTACIONES LABORALES</h4>
    </div>
    <div class="div_principal_empleado">
        <div class="div_items">
            <div class="item_titulo">
                Nombre
            </div>
            <div class="item_data">
                <span style="">{{$data['nombre']}}</span>
            </div>
        </div>
        <div class="div_items">
            <div class="item_titulo">
                Puesto
            </div>
            <div class="item_data ">
                <span style="border: 1px solid black"></span>
            </div>
        </div>
        <div class="div_items">
            <div class="item_titulo">
                Motivo
            </div>
            <div class="item_data">
                <div class="item_data_text">
                    {{$data['motivo']}}
                </div>
            </div>
        </div>
        <div class="div_items">
            <div class="item_titulo">
                Fecha de Inicio
            </div>
            <div class="item_data">
                <div class="item_data_text">
                    {{$data['inicio_empleado']}}
                </div>
            </div>
        </div>
        <div class="div_items">
            <div class="item_titulo">
                Fecha de Finalizacion
            </div>
            <div class="item_data">
                <div class="item_data_text">
                    {{$data['fecha_calculo']}}
                </div>
            </div>
        </div>
        <br>
        <div class="div_items">
            <div class="item_titulo">
                Sueldo Promedio Ultimos 6 Meses <br>
                (ORDINARIO Y EXTRAORDINARIO)
            </div>
            <div class="item_data">
                <div class="item_data_text">
                    <label>{{Str::money($data['salarioPromedio'],'Q.')}}</label>
                </div>
            </div>
        </div>

    </div>
    <div class="div_principal">
        <h4 style="text-align: center; font-size:0.8rem" class="titulos">**CALCULO DE
            LIQUIDACION**</h4>
        <div class="div_items " style="margin-top: 20px; margin-bottom:10px; ">
            <div class="item_titulo_detalle">
            </div>
            <div class="item_titulo_detalle">
            </div>
            <div class="item_titulo_detalle_label" style="font-size:0.7rem; font-weight:bold;border-bottom: black 1px solid ">
                DIAS POR <br>&nbsp; PAGAR &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp;   TOTALES
            </div>
        </div>
        <div class="div_items ">
            <div class="item_titulo_detalle">
                INDEMNIZACION
            </div>
            <div class="item_titulo_detalle">
                Del {{$data['indemnizacion']['fecha']->format('d/m/Y')}} Al {{$data['fecha_calculo']}}
            </div>
            <div class="item_titulo_detalle_dias">
                {{$data['indemnizacion']['dias']}}
            </div>
            <div class="item_titulo_detalle_total">
                <div class="item_data_q">
                    <span>Q.</span>
                </div>
                <div class="item_data_text_total">
                    <span>{{Str::money($data['indemnizacion']['monto'],'')}}</span>
                </div>
            </div>
        </div>
        <div class="div_items ">
            <div class="item_titulo_detalle">
                AGUINALDO
            </div>
            <div class="item_titulo_detalle">
                Del {{$data['aguinaldo']['fecha']->format('d/m/Y')}} Al {{$data['fecha_calculo']}}
            </div>
            <div class="item_titulo_detalle_dias">
                {{$data['aguinaldo']['dias']}}
            </div>
            <div class="item_titulo_detalle_total">
                <div class="item_data_q">
                    <span>Q.</span>
                </div>
                <div class="item_data_text_total">
                    <label>{{Str::money($data['aguinaldo']['monto'],'')}}</label>
                </div>
            </div>
        </div>
        <div class="div_items ">
            <div class="item_titulo_detalle">
                BONO 14
            </div>
            <div class="item_titulo_detalle">
                Del {{$data['bono14']['fecha']->format('d/m/Y')}} Al {{$data['fecha_calculo']}}
            </div>
            <div class="item_titulo_detalle_dias">
                {{$data['bono14']['dias']}}
            </div>

            <div class="item_titulo_detalle_total">
                <div class="item_data_q">
                    <span>Q.</span>
                </div>
                <div class="item_data_text_total">
                    <label>{{Str::money($data['bono14']['monto'],'')}}</label>
                </div>
            </div>
        </div>
        <div class="div_items ">
            <div class="item_titulo_detalle">
                VACACIONES
            </div>
            <div class="item_titulo_detalle">
            </div>
            <div class="item_titulo_detalle_dias">
                {{$data['vacaciones']['dias']}}
            </div>
            <div class="item_titulo_detalle_total">
                <div class="item_data_q">
                    <span>Q.</span>
                </div>
                <div class="item_data_text_total">
                    <label>{{Str::money($data['vacaciones']['monto'],'')}}</label>
                </div>
            </div>
        </div>
        <div class="div_items ">
            <div class="item_titulo_detalle">
                QUINCENA
            </div>
            <div class="item_titulo_detalle">
                Del {{$data['quincena']['fecha']->format('d/m/Y')}} Al {{$data['fecha_calculo']}}
            </div>
            <div class="item_titulo_detalle_dias">
                {{$data['quincena']['dias']}}
            </div>
            <div class="item_titulo_detalle_total">
                <div class="item_data_q">
                    <span>Q.</span>
                </div>
                <div class="item_data_text_total">
                    <label>{{Str::money($data['quincena']['monto'],'')}}</label>
                </div>
            </div>
        </div>
        <div class="div_items ">
            <div class="item_titulo_detalle">
                BONIFICACION DECRETO
            </div>
            <div class="item_titulo_detalle">
            </div>
            <div class="item_titulo_detalle_dias">
            </div>
            <div class="item_titulo_detalle_total">
                @php($bonificacion = round((250/30)*$data['quincena']['dias'],2))

                <div class="item_data_q">
                    <span>Q.</span>
                </div>
                <div class="item_data_text_total">
                    <label>{{Str::money($bonificacion,'')}}</label>
                </div>
            </div>
        </div>
        <div class="div_items ">
            <div class="item_titulo_detalle">
                (-) IGSS
            </div>
            <div class="item_titulo_detalle">
            </div>
            <div class="item_titulo_detalle_dias">
            </div>
            <div class="item_titulo_detalle_total">
                @php($igss = round((($data['salarioPromedio']/30)*$data['quincena']['dias'])*(4.83/100),2))
                <div class="item_data_q">
                    <span>Q.</span>
                </div>
                <div class="item_data_text_total">
                    <label style="color:red;font-weight:bold    ">({{Str::money($igss,'')}})</label>
                </div>
            </div>
        </div>
        <div class="div_items ">
            <div class="item_titulo_detalle">
                (-) Descuentos
            </div>
            <div class="item_titulo_detalle">
            </div>
            <div class="item_titulo_detalle_dias">
            </div>
            <div class="item_titulo_detalle_total">
                @php($igss = round((($data['salarioPromedio']/30)*$data['quincena']['dias'])*(4.83/100),2))
                <div class="item_data_q">
                    <span>Q.</span>
                </div>
                <div class="item_data_text_total">
                    <label style="color:red;font-weight:bold    ">({{Str::money($data['descuentos'],'')}})</label>
                </div>
            </div>
        </div>
        <div class="div_items ">
            <div class="item_titulo_detalle">
            </div>
            <div class="item_titulo_detalle">
            </div>
            <div class="item_titulo_detalle_dias">
            </div>
            <div class="item_titulo_detalle_total">
                @php($igss = round((($data['salarioPromedio']/30)*$data['quincena']['dias'])*(4.83/100),2))
                @php($total = round($data['aguinaldo']['monto']+$data['bono14']['monto']+$data['vacaciones']['monto']+$data['indemnizacion']['monto']+$data['quincena']['monto']+$bonificacion-$igss-$data['descuentos'],2))
                <div class="item_data_q" style=" font-weight:bold; ">
                    <span>Q.</span>
                </div>
                <div class="item_data_text_total">
                    <label style=" font-weight:bold; ">{{Str::money($total,'')}}</label>
                </div>
            </div>
        </div>
        <br>
        <div class="div_items ">
            <div class="item_titulo_detalle_final">
                @php($igss = round((($data['salarioPromedio']/30)*$data['quincena']['dias'])*(4.83/100),2))
                    <span style=" font-weight:bold; border:2px solid black; padding: 3px ">TOTAL PRESTACIONES LABORALES &nbsp;&nbsp;&nbsp;&nbsp;{{Str::money($total,'Q. ')}}</span>
            </div>
        </div>
        <h5 style="font-weight:bold;font-size: 0.9rem; margin:0">
            @php($formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT))
            @php($decimales = explode(".", number_format($total, 2, ".", "")) )
            @php($total_letras =  strtoupper($formatterES->format($decimales[0])) . ' ' . $decimales[1] . '/100 QUETZALES' )
            TOTAL EN LETRAS: <br> {{ $total_letras}}
        </h5>
        <br><br>
        <div class="div_texto">
                <p style="font-size:14px; margin: 0;width:660px;text-align: justify">
                    Hago constar que se me pagaron todas mis prestaciones y que no tengo ningún reclamo en contra de la empresa, y por este medio extiendo amplio y eficaz finiquito laboral.
                </p>
        </div>
        <div class="div_firma">
            <h4 class="firma">Recibí Conforme:<span>________________________________</span></h4>
            <h4 class="firma" style="font-weight: bold;margin-left: 115px">{{$data['nombre']}}</h4>
            <h4 class="firma" style="font-weight: bold;margin-left: 115px">DPI: {{ $data['dpi']}}</h4>
        </div>
    </div>

</main>
</body>

</html>
