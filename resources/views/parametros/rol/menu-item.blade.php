@if($item["men_id"]!=99)
@if ($item['submenu']==[])
<tr>
    <td>{{$item["men_nombre"]}}</td>
    <td>
        <center>
            <div class="icheck-midnightblue d-inline">
                <input type="checkbox" class="permiso" id="permisos[1][{{$item["men_id"]}}]"
                    value="{{'ver '. $item["men_url"]}}" {{$item['men_url']!="#"?($data->hasPermissionTo('ver '.$item['men_url'])?'checked':''):'disabled'}}>
                <label for="permisos[1][{{$item["men_id"]}}]">
                </label>
        </center>
    </td>
    <td>
        <center>
            <div class="icheck-midnightblue d-inline">
                <input type="checkbox" class="permiso" id="permisos[2][{{$item["men_id"]}}]"
                    value="{{'crear '. $item["men_url"]}}" {{$item['men_url']!="#"?($data->hasPermissionTo('crear '.$item['men_url'])?'checked':''):'disabled'}}>
                <label for="permisos[2][{{$item["men_id"]}}]">
                </label>
        </center>
    </td>
    <td>
        <center>
            <div class="icheck-midnightblue d-inline">
                <input type="checkbox" class="permiso" id="permisos[3][{{$item["men_id"]}}]"
                    value="{{'actualizar '. $item["men_url"]}}" {{$item['men_url']!="#"?($data->hasPermissionTo('actualizar '.$item['men_url'])?'checked':''):'disabled'}}>
                <label for="permisos[3][{{$item["men_id"]}}]">
                </label>
        </center>
    </td>
    <td>
        <center>
            <div class="icheck-midnightblue d-inline">
                <input type="checkbox" class="permiso" id="permisos[4][{{$item["men_id"]}}]"
                    value="{{'eliminar '. $item["men_url"]}}" {{$item['men_url']!="#"?($data->hasPermissionTo('eliminar '.$item['men_url'])?'checked':''):'disabled'}}>
                <label for="permisos[4][{{$item["men_id"]}}]">
                </label>
        </center>
    </td>
</tr>
@else
<tr>
    <td class="text-bold text-center h4" colspan="5">{{$item["men_nombre"]}}</td>
</tr>
@foreach ($item["submenu"] as $submenu)
@include("parametros.rol.menu-item",["item"=>$submenu])
@endforeach
@endif
@endif
