<html>
@inject('empleado','App\Models\Planilla\Empleado')

<link rel="stylesheet" href="{{asset("css/table.css")}}">
<table>
    <thead>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <th colspan="1" class="item" ></th>
        <th colspan="3" class="item">LIQUIDACION DE CAJA CHICA #{{$caja->cch_id}} {{$caja->Empresa->emp_siglas}} {{$caja->Empresa->emp_empresa}} {{$caja->cch_nombre}}</th>
    </tr>
    <tr>
        <th scope="col" class="item" style="border: 1px solid">#</th>
        <th scope="col" class="item">Factura</th>
        <th scope="col" class="item">Fecha</th>
        <th scope="col" class="item">Proveedor</th>
        <th scope="col" class="item">Monto</th>
        <th scope="col" class="item">Descripcion</th>
        <th scope="col" class="header-pdf">Estado</th>
    </thead>
    <tbody>
    @foreach($detalles as $detalle)
        <tr>
            <td class="item">{{$detalle['dlcc_id']}}</td>
            <td class="item">{{$detalle['dlcc_numerodoc']}}</td>
            <td class="item">{{$detalle['dlcc_fecha']}}</td>
            <td class="tr_item item" style="text-align: center;">{{$detalle->ProveedorDetalle->Persona->per_nombre}}</td>
            <td class="item" style="text-align: justify;">{{Str::money($detalle['dlcc_monto'], "Q ")}}</td>
            <td class="item">{{$detalle['dlcc_descripcion']}}</td>
            <td class="item">@if($detalle['dlcc_status']=='P')
                    Pendiente
                @elseif($detalle['dlcc_status']=='L')
                    Liquidado
                @else
                    Rechazado
                @endif</td>
        </tr>
    @endforeach
    <tr>
        <td style="text-align: center;"></td>
        <td style="text-align: center;">--------------------</td>
        <td  style="text-align: center;">--------------------</td>
        <td  style="text-align: center;">----------------------------------------ÚLTIMA LÍNEA-----------------------------------------</td>
        <td  style="text-align: center;">-----------------------</td>
        <td  style="text-align: center;">----------------------------------------------------------------</td>
        <td  style="text-align: center;">-----------------</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td class="item tr-final">TOTAL GENERAL DE DETALLES</td>
        <td class="item tr-final">{{Str::money($anterior, "Q ")}}</td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td class="item tr-final">TOTAL A REINTEGRAR</td>
        <td class="item tr-final">{{Str::money($total, "Q ")}}</td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <td></td>
        <td>______________________________________</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td>{{$empleado->getNombreCompleto( $caja->Responsable->empl_id)}}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
</table>

</html>
