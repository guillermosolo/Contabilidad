@extends("layout.layout")
@section("titulo")
    Imprimir Catalogos
@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
@endsection

@section('scripts')
    <script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cyb/bancos/cuentasbancarias/crear.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
    <script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cxc/nabono\orden.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('cuentasbancarias.catalogo') }}
@endsection


@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/bancos/catalogo')}}">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.form-error')
                    @include('includes.mensaje')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Cuentas de Empresas<small></small></h3>
                            <div class="card-tools">
                                <a href="{{route('cuentasbancarias')}}" class="btn btn-block btn-info btn-sm">
                                    Ver el catalogo completo<i class="fas fa-arrow-circle-left pl-1"></i></a>
                            </div>
                        </div>

                        <form action="{{route('cuentasbancarias.imprimir')}}" id="form-general" class="form-horizontal" method="get">
                            <div class="card-body">
                                <div class="form-group row"
                                @csrf
                                <label for="per_nit" class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Empresa</label>
                                <div class="col-sm-12 col-lg-8">
                                        <select name="search" type="search" class="form-control select2" id="inputempresa">
                                                <option value="0">Todas las Empresas</option>
                                                @foreach (auth()->user()->Empresas as $item)
                                                    <option value="{{$item->emp_id}}">{{$item->emp_siglas}}</option>
                                                @endforeach
                                        </select>
                                </div>
                                <div class="card-tools">
                                    @if(count(auth()->user()->Empresas)>0)
                                    <button type="submit "class="btn btn-outline-primary">Buscar</button>
                                        @else()
                                        <button type="submit "class="btn btn-outline-primary disabled">Buscar</button>
                                        @endif
                                </div>
                            </div>
                            </div>
                            <div class="card-footer">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
