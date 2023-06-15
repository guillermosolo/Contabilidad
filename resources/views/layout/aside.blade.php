<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{route('home')}}" class="brand-link">
    <img src="" alt="Logo"
      class="brand-image img-circle logo-img">
    <span class="brand-text font-weight-light">Contabilidad</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" id="mprincipal" data-accordion="true">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-header">MENÚ PRINCIPAL</li>
        @foreach ($menusComposer as $key=>$item)
          @if ($item['men_padre']!=0)
            @break
          @endif
          @include("layout.menu-item",compact('item'))
        @endforeach
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
