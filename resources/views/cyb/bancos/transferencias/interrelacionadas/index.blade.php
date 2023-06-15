@extends("layout.layout")

@section("titulo")
    Transferencias a Relacionados
@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
@endsection

@section("scriptPlugins")
    <script src="{{asset("assets/plugins/datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}"></script>
@endsection

@section('scripts')
    <script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
    <script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cyb/bancos/cuentasbancarias/table.js")}}" type="text/javascript"></script>
@endsection

@section('breadcrumbs')

    {{ Breadcrumbs::render('relacionadas') }}

@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/bancos/transferencias/relacionadas')}}">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Lista de Transferencias<small></small></h3>
                            <div class="card-tools">
                                @can('crear cyb/bancos/transferencias/relacionadas')
                                    <a href="{{route('relacionadas.crear')}}" class="btn btn-block btn-success btn-sm">
                                        Nueva Transferencia<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                @else
                                    <a href="{{route('relacionadas.crear')}}" class="btn btn-block btn-success btn-sm disabled">
                                        Nueva Transferencia<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                @endcan

                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('derelacionadas')}}" class="form-horizontal">
                                <div class="row">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-4 text-center">
                                        <div class="col-lg-12">
                                            <fieldset class="border p-2 col-sm-12 col-lg-12">
                                                <button type="button" class="btn btn-dark active">A Relacionadas</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                <button type="submit" class="btn btn-outline-dark">De Relacionadas</button>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tabla-data" cellspacing="0" width="100%">
                                    <thead class='thead-dark'>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Número&nbspde&nbspCuenta</th>
                                        <th scope="col">Numero&nbspReferencial</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Beneficiario</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Tipo de Transacción</th>
                                        <th scope="col">Cambio</th>
                                    </thead>
                                    <tbody>
                                        @foreach($internas as $internas)
                                            <tr>
                                                <td scope="row">{{$internas['che_id']}}</td>
                                                <td>{{$internas->CuentasBancarias->ctab_numero}}</td>
                                                <td>{{$internas['che_numero']}}</td>
                                                <td>{{$internas['che_fecha']}}</td>
                                                <td>{{Str::money($internas['che_monto'],"Q ")}}</td>
                                                <td>{{$internas['che_beneficiario']}}</td>
                                                <td>{{$internas['che_descripcion']}}</td>
                                                <td>@if($internas->che_tipo =='TR')
                                                        A Relacionados
                                                    @else
                                                    @endif</td>
                                                <td>{{Str::money($internas['che_tc'],"Q ")}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
