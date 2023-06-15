<input type="hidden" id="usuario_id" name="usuario_id" value="{{$data->id}}">
<table class="table table-striped table-hover" id="tabla">
    <thead class='thead-dark'>
        <tr>
            <th rowspan="2" class="text-center align-middle">Nombre</th>
            <th colspan="4" class="text-center">Permisos</th>
        </tr>
        <tr>
            <th class="text-center">Ver</th>
            <th class="text-center">Crear</th>
            <th class="text-center">Actualizar</th>
            <th class="text-center">Eliminar</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($menu as $item)
        @if ($item['men_padre']!=0)
        @break
        @endif
        @include("parametros.usuario.menu-item",compact('item'))
        @endforeach
    </tbody>
</table>
