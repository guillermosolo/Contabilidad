@role('Super Administrador')
@if ($item['submenu']==[])
<li
    class="nav-item {{(((auth()->user()->getAllPermissions()->pluck('name')->contains('ver '.$item['men_url'])||auth()->user()->can('ver '.$item['men_url']))||$item['men_url']=="#"))?'':'disabled'}}">
    <a href="{{url($item['men_url'])}}"
        class="nav-link {{getMenuActivo($item['men_url'])}}
    {{(((auth()->user()->getAllPermissions()->pluck('name')->contains('ver '.$item['men_url'])||auth()->user()->can('ver '.$item['men_url']))||$item['men_url']=="#"))?'':'disabled'}}">
        <i class="nav-icon {{$item["men_icono"]? :"fas fa-circle"}}"></i>
        <p>{{$item["men_nombre"]}}</p>
    </a>
</li>
@else
<li
    class="nav-item has_treeview {{(((auth()->user()->getAllPermissions()->pluck('name')->contains('ver '.$item['men_url'])||auth()->user()->can('ver '.$item['men_url']))||$item['men_url']=="#"))?'':'disabled'}}">
    <a href="#"
        class="nav-link {{(((auth()->user()->getAllPermissions()->pluck('name')->contains('ver '.$item['men_url'])||auth()->user()->can('ver '.$item['men_url']))||$item['men_url']=="#"))?'font-weight-bold':'disabled'}}">
        <i class="nav-icon {{$item["men_icono"]? :"fas fa-circle"}}"></i>
        <p>
            {{$item["men_nombre"]}}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        @foreach ($item["submenu"] as $submenu)
        @include("layout.menu-item",["item"=>$submenu])
        @endforeach
    </ul>
</li>
@endif
@else
@if($item["men_id"]!=99)
@if ($item['submenu']==[])
<li
    class="nav-item {{(($item['men_deshabilitado']!=1)&&(auth()->user()->getAllPermissions()->pluck('name')->contains('ver '.$item['men_url'])||$item['men_url']=="#"))?'':'disabled'}}">
    <a href="{{url($item['men_url'])}}"
        class="nav-link {{getMenuActivo($item['men_url'])}}
    {{(($item['men_deshabilitado']!=1)&&(auth()->user()->getAllPermissions()->pluck('name')->contains('ver '.$item['men_url'])||$item['men_url']=="#"))?'':'disabled'}}">
        <i class="nav-icon {{$item["men_icono"]? :"fas fa-circle"}}"></i>
        <p>{{$item["men_nombre"]}}</p>
    </a>
</li>
@else
<li
    class="nav-item has_treeview {{(($item['men_deshabilitado']!=1)&&(auth()->user()->getAllPermissions()->pluck('name')->contains('ver '.$item['men_url'])||$item['men_url']=="#"))?'':'disabled'}}">
    <a href="#"
        class="nav-link {{(($item['men_deshabilitado']!=1)&&(auth()->user()->getAllPermissions()->pluck('name')->contains('ver '.$item['men_url'])||$item['men_url']=="#"))?'font-weight-bold':'disabled'}}">
        <i class="nav-icon {{$item["men_icono"]? :"fas fa-circle"}}"></i>
        <p>
            {{$item["men_nombre"]}}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        @foreach ($item["submenu"] as $submenu)
        @include("layout.menu-item",["item"=>$submenu])
        @endforeach
    </ul>
</li>
@endif
@endif
@endrole
