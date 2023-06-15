@if($item["men_id"]!=99)
@if ($item['submenu']==[])
<tr>
    <td>{{$item["men_nombre"]}}</td>
    <td>
        <center>
            <div class="icheck-midnightblue d-inline">
                @if($item["men_url"]=="#")

                @elseif ($data->hasDirectPermission('ver '.$item['men_url']))
                <i class="fas fa-check-circle text-success" data-toggle="tooltip" title="Asignado Directamente"></i>
                @elseif (in_array('ver '.$item['men_url'],$permisosrol))
                <i class="far fa-check-circle text-dark" data-toggle="tooltip" title="Asignado por Rol"></i>
                @else
                <i class="fas fa-times-circle text-danger" data-toggle="tooltip" title="Sin Permiso"></i>
                @endif
        </center>
    </td>
    <td>
        <center>
            @if($item["men_url"]=="#")

            @elseif ($data->hasDirectPermission('crear '.$item['men_url']))
            <i class="fas fa-check-circle text-success" data-toggle="tooltip" title="Asignado Directamente"></i>
            @elseif (in_array('crear '.$item['men_url'],$permisosrol))
            <i class="far fa-check-circle text-dark" data-toggle="tooltip" title="Asignado por Rol"></i>
            @else
            <i class="fas fa-times-circle text-danger" data-toggle="tooltip" title="Sin Permiso"></i>
            @endif
        </center>
    </td>
    <td>
        <center>
            @if($item["men_url"]=="#")

            @elseif ($data->hasDirectPermission('actualizar '.$item['men_url']))
            <i class="fas fa-check-circle text-success" data-toggle="tooltip" title="Asignado Directamente"></i>
            @elseif (in_array('actualizar '.$item['men_url'],$permisosrol))
            <i class="far fa-check-circle text-dark" data-toggle="tooltip" title="Asignado por Rol"></i>
            @else
            <i class="fas fa-times-circle text-danger" data-toggle="tooltip" title="Sin Permiso"></i>
            @endif
        </center>
    </td>
    <td>
        <center>
            @if($item["men_url"]=="#")

            @elseif ($data->hasDirectPermission('eliminar '.$item['men_url']))
            <i class="fas fa-check-circle text-success" data-toggle="tooltip" title="Asignado Directamente"></i>
            @elseif (in_array('eliminar '.$item['men_url'],$permisosrol))
            <i class="far fa-check-circle text-dark" data-toggle="tooltip" title="Asignado por Rol"></i>
            @else
            <i class="fas fa-times-circle text-danger" data-toggle="tooltip" title="Sin Permiso"></i>
            @endif
        </center>
    </td>
</tr>
@else
<tr>
    <td class="text-bold text-center h4" colspan="5">{{$item["men_nombre"]}}</td>
</tr>
@foreach ($item["submenu"] as $submenu)
@include("parametros.usuario.menu-item2",["item"=>$submenu])
@endforeach
@endif
@endif
