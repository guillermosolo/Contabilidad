<!DOCTYPE html>
<html lang="es">
<style>
    html {
        margin-top: 25px;
        margin-bottom: 30px;
        padding: 0;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 0.7rem;

    }

    .header {
        margin: 0;
        padding: 0;
        font-size: 0.7rem;
        line-height: 1.4;

    }

    main {
        margin: 0;
        padding-top: 10px;

    }

    .titulo1 {
        font-weight: 0;
    }

    .titulos {
        margin: 0;
        padding: 0;
    }

    .div_principal_empleado {
        margin-top: 20px;
        margin-left: 200px;
    }

    .div_items {
        font-size: 0.6rem;
    }
    .item_titulo {
        width: 350px;
        display: inline-block;
    }
    .item_data {
        text-align: right;
        display: inline-block;
    }
    .header-pdf {
        font-size: 0.5rem;
        background-color: #f2f2f2;
        padding: 0;
        margin: 0;
    }
    .header-border-parcial {
        border-bottom: 1px solid;
        border-left: 1px solid;
        border-right: 1px solid;
        padding: 0;
        margin: 0;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        border: none;
    }
    .tr_item{
        border: solid 1px black;
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


    .header {

    }

    .tr-final{

        border-bottom-style:  double;
    }
    .name-item{
        width: 150px;
    }

    .item{
        font-size: 0.5rem;
        text-align: right;
    }
    .item-center-periodo{
        font-size: 0.4rem;
        text-align: center;
    }
    .item-center{
        font-size: 0.5rem;
        text-align: center;
    }
</style>
<body>
<main>
    <div class="header">
        <h4 style="text-align: center" class="titulos">{{$empleado->Empresa->emp_nombre}}</h4>
        <h4 style="text-align: center" class="titulo1 titulos">LIBRO DE SALARIOS</h4>
    </div>
    <div class="div_principal_empleado">
        <div class="div_items">
            @php($nombre = $empleado->getNombreCompleto($empleado->empl_id))
            <div class="item_titulo">
                NOMBRE: {{$nombre}}
            </div>
            <div class="item_data">
                NACIONALIDAD: {{$empleado->Origen->pai_descripcion}}
            </div>
        </div>
        <div class="div_items">
            <div class="item_titulo">
                PUESTO:
            </div>
            <div class="item_data ">
                EDAD: {{ now()->diffInYears (\Carbon\Carbon::parse($empleado->empl_fecNac))}}
            </div>
        </div>
        <div class="div_items">
            <div class="item_titulo">
               No. DE AFILIACION: {{$empleado->empl_IGSS}}
            </div>
            <div class="item_data">
               No. DE DPI
            </div>
        </div>
        <div class="div_items">
            <div class="item_titulo">
                FECHA INGRESO: {{ \Carbon\Carbon::parse($empleado->empl_inicio)->format('d/m/Y')}}
            </div>
            <div class="item_data">
             SEXO: {{$empleado->empl_sexo==1?'FEMENINO':'MASCULINO'}}
            </div>
        </div>
        <div class="div_items">
            <div class="item_titulo">
                FECHA DE BAJA: {{ $empleado->empl_fin?\Carbon\Carbon::parse($empleado->empl_fin)->format('d/m/Y'):''}}
            </div>
            <div class="item_data">

            </div>
        </div>
        <br>

    </div>
        <table class="table">
            <thead >
            <tr >
                <th  colspan="1" class="header-pdf" style="border-top: 1px solid; border-left: 1px solid; border-right: 1px solid"></th>
                <th  colspan="1" class="header-pdf" style="border-top: 1px solid; border-left: 1px solid; border-right: 1px solid"></th>
                <th  colspan="1" class="header-pdf" style="border-top: 1px solid; border-left: 1px solid; border-right: 1px solid"  ></th>
                <th  colspan="2" class="header-pdf" style="border-top: 1px solid; border-left: 1px solid; border-right: 1px solid">HORAS TRABAJADAS</th>
                <th  colspan="1" class="header-pdf" style="border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;border-bottom: 1px solid"  ></th>
                <th  colspan="4" class="header-pdf" style="border-top: 1px solid; border-left: 1px solid; border-right: 1px solid">SALARIO DEVENGADO</th>
                <th  colspan="4" class="header-pdf" style="border-top: 1px solid; border-left: 1px solid; border-right: 1px solid">DEDUCCIONES LEGALES</th>
                <th  colspan="1" class="header-pdf" style="border-top: 1px solid; border-left: 1px solid; border-right: 1px solid;"  >Dto.42-92 </th>
                <th  colspan="4" class="header-pdf" style="border-top: 1px solid; border-left: 1px solid; border-right: 1px solid"></th>
            </tr>
            <tr >
                <th class="header-pdf header-border-parcial" style=" width: 20px" >No. ORDEN</th>
                <th class="header-pdf header-border-parcial"  style=" width: 70px">PERIODO <br>DE<br> TRABAJO</th>
                <th class="header-pdf header-border-parcial"  style=" width: 40px">SALARIO <br>EN<br> QUEZALES</th>
                <th class="header-pdf header-border-parcial" style="border-top: 1px solid; width: 50px">DIAS <br>TRABAJADOS</th>
                <th class="header-pdf header-border-parcial" style="border-top: 1px solid; width: 40px">ORDINARIAS</th>
                <th class="header-pdf header-border-parcial" style="border-top: 1px solid; width: 50px">EXTRAORDINARIAS</th>
                <th class="header-pdf header-border-parcial" style="border-top: 1px solid;width: 50px">ORDINARIO</th>
                <th class="header-pdf header-border-parcial" style="border-top: 1px solid;width: 50px">EXTRAORDINARIAS</th>
                <th class="header-pdf header-border-parcial" style="border-top: 1px solid;width: 50px">SEPTIMOS <br> Y ASUETOS</th>
                <th class="header-pdf header-border-parcial" style="border-top: 1px solid;width: 40px">OTROS</th>
                <th class="header-pdf header-border-parcial" style="border-top: 1px solid;width: 50px">SALARIO <br> TOTAL</th>
                <th class="header-pdf header-border-parcial" style="border-top: 1px solid;width: 40px">CUOTA <br> IGSS</th>
                <th class="header-pdf header-border-parcial" style="border-top: 1px solid;width: 60px">OTRAS <br> DEDUCCIONES</th>
                <th class="header-pdf header-border-parcial" style="border-top: 1px solid;width: 60px">TOTAL <br> DEDUCCIONES</th>
                <th class="header-pdf header-border-parcial"  style="width: 35px" >Aguinaldo <br> VACACIONES <br> Y OTROS</th>
                <th class="header-pdf header-border-parcial" style="border-top: 1px solid;width: 60px">BONIFICACION <br> INCENTIVO</th>
                <th class="header-pdf header-border-parcial" style="border-top: 1px solid;width: 60px">LIQUIDO <br> A<br> RECIBIR</th>
                <th class="header-pdf header-border-parcial" style="border-top: 1px solid;" >&nbsp;&nbsp;&nbsp;&nbsp;FIRMA&nbsp;&nbsp;&nbsp;&nbsp;  </th>
                <th class="header-pdf header-border-parcial" style="border-top: 1px solid;width:60px">OBSERVACIONES</th>

            </tr>
            </thead>
            <tbody>
            @foreach ($dataEmpleado??[] as $index => $data)
                <tr>
                    <td class="tr_item item-center ">{{$index+1}}</td>
                    <td class="tr_item item-center-periodo">{{$data['periodo']}}</td>
                    <td class="tr_item item">{{Str::money($data['sueldoMensual'],'') }}</td>
                    <td class="tr_item item-center">{{ intval($data['diasLab']) }}</td>
                    <td class="tr_item item-center">{{ intval($data['horasOrdinales']) }}</td>
                    <td class="tr_item item-center">{{ intval($data['horasExtras']) }}</td>
                    <td class="tr_item item">{{Str::money($data['sueldoOrdinario'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['sueldoExtra'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['septimos'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['otros_salarios'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['sueldoTotal'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['igss'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['otras_deducciones'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['total_deducciones'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['bonos'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['bonificacion_incentivo'],'') }}</td>
                    <td class="tr_item item">{{Str::money($data['sueldoLiquido'],'') }}</td>
                    <td class="tr_item item" ></td>
                    <td class="tr_item item"></td>

                </tr>
            @endforeach

            </tbody>
            <tr>
                <td class=" item "></td>
                <td class="tr-final item">TOTAL</td>
                <td class="tr-final item"></td>
                <td class="tr-final item"></td>
                <td class="tr-final item"></td>
                <td class="tr-final item"></td>
                <td class="tr-final item">{{Str::money($data['sueldoOrdinario']??0,'') }}</td>
                <td class="tr-final item">{{Str::money($data['sueldoExtra']??0,'') }}</td>
                <td class="tr-final item"></td>
                <td class="tr-final item"></td>
                <td class="tr-final item">{{Str::money($data['sueldoTotal']??0,'') }}</td>
                <td class="tr-final item">{{Str::money($data['igss']??0,'') }}</td>
                <td class="tr-final item"></td>
                <td class="tr-final item">{{Str::money($data['total_deducciones']??0,'') }}</td>
                <td class="tr-final item">{{Str::money($data['bonos']??0,'') }}</td>
                <td class="tr-final item">{{Str::money($data['bonificacion_incentivo']??0,'') }}</td>
                <td class="tr-final item">{{Str::money($data['sueldoLiquido']??0,'') }}</td>
                <td class=" item" ></td>
                <td class=" item"></td>
            </tr>
        </table>


</main>
</body>

</html>
