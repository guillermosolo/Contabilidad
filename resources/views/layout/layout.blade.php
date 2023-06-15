<!DOCTYPE html>
<html lang="es-GT">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('titulo','@@@SIN TITULO@@@') | ADPI</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("assets/plugins/fontawesome-free/css/all.min.css")}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset("assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("assets/dist/css/adminlte.min.css")}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset("assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset("assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css")}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset("assets/plugins/toastr/toastr.min.css")}}">
    @yield('styles')
    <link rel="stylesheet" href="{{asset("assets/css/custom.css")}}">
    <!-- Bootstrap laravel -->

    <!-- Styles -->
    <link href="{{asset('css/app.css') }}" rel="stylesheet">
    <!-- Google Font: Source Sans Pro -->
    <link href="{{asset("assets/css/SansPro.css")}}" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Inicio Header -->
        @include("layout/header")
        <!-- Fin Header  -->
        <!-- Inicio Aside -->
        @include("layout/aside")
        <!-- Fin Aside -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="d-none d-sm-block col-lg-6">
                            <h1 class="m-0 text-dark">@yield('titulo','@@@SIN TITULO@@@')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-12 col-lg-6 ">
                            @yield('breadcrumbs')
                        </div>
                    </div>
                </div>
                @yield('contenido')
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
        </div>
        <!-- Inicio Footer
        @include("layout/footer")
        Fin Footer-->
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset("assets/plugins/jquery-ui/jquery-ui.min.js")}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset("assets/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset("assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}"></script>
    <!-- Bootstrap Switch -->
    <script src="{{asset("assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js")}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset("assets/dist/js/adminlte.js")}}"></script>
    @yield('scriptPlugins')
    <!-- <jQuery Validation -->
    <script src="{{asset("assets/js/jquery-validation/jquery.validate.min.js")}}"> </script>
    <script src="{{asset("assets/js/jquery-validation/localization/messages_es.min.js")}}"> </script>
    <!-- SweetAlert2 -->
    <script src="{{asset("assets/plugins/sweetalert2/sweetalert2.all.min.js")}}"></script>
    <!-- Toastr -->
    <script src="{{asset("assets/plugins/toastr/toastr.min.js")}}"></script>
    <!-- Input Spinner -->
    <script src="{{asset("assets/js/input-spinner/bootstrap-input-spinner.js")}}"></script>

    <script src="{{asset("assets/js/scripts.js")}}"></script>
    <script src="{{asset("assets/js/funciones.js")}}"></script>
    @yield("scripts")





</body>

</html>
