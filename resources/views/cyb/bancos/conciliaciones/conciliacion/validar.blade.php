@extends("layout.layout")
@section("titulo")
    Crear Conciliación
@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
@endsection

@section('scripts')
    <script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
    <script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cxc/nabono\orden.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cyb/bancos/conciliaciones/validar.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js")}}"></script>
    <script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
@endsection
@section('breadcrumbs')
    {{ Breadcrumbs::render('conciliaciones.crear') }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/bancos/debitos')}}">
    <input type="hidden" id="authPath" value="{{url('cyb/bancos/autorizacion/autorizar')}}">

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Conciliaciónes<small></small></h3>
                            <div class="card-tools">
                                <a href="{{route('conciliaciones')}}" class="btn btn-block btn-info btn-sm">
                                    Volver a Conciliaciónes<i class="fas fa-arrow-circle-left pl-1"></i></a>
                            </div>
                        </div>
                        <br>
                        <div class="card-body row">
                            <div class="table-responsive">
                                <h4 class="text-center">Transacciones que no coinciden</h4>
                                <table class="table table-striped table-hover" id="tabla">
                                    <thead class='thead-dark'>
                                    <tr>
                                        <th colspan="6" class="text-center">Local</th>
                                        <th colspan="5" class="text-center">Excel</th>
                                    </tr>
                                    <tr>

                                        <th class="text-center">Cuenta bancaria</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Referencia</th>
                                        <th class="text-center">Concepto</th>
                                        <th class="text-center">Monto</th>
                                        <th class="text-center border-right">Autorizar - Rechazar</th>
                                        <th class="text-center">Cuenta bancaria</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Referencia</th>
                                        <th class="text-center">Concepto</th>
                                        <th class="text-center">Monto</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($noValidado as $item)
                                        <tr>

                                            <th class="text-center">{{$item['local']->cuenta_bancaria}}</th>
                                            <th class="text-center">{{$item['local']->fecha}}</th>
                                            <th class="text-center">{{$item['local']->referencia}}</th>
                                            <th class="text-center">{{$item['local']->concepto}}</th>
                                            <th class="text-center">{{$item['local']->monto}}</th>
                                            <th class="text-center d-flex justify-content-around">
                                                <div class="icheck-green">
                                                    <input type="checkbox" id="{{$item['local']->trab_id}}checkboxAuth"
                                                           value="0"
                                                           onclick="autorizarConcilicacion('{{$item['local']->trab_id."-".$item['local']->dcon_linea}}','{{$item['local']->trab_id."checkboxDen"}}', true)">
                                                    <label for="{{$item['local']->trab_id}}checkboxAuth">
                                                    </label>
                                                </div>
                                                <div class="icheck-red">
                                                    <input type="checkbox" id="{{$item['local']->trab_id}}checkboxDen"
                                                           value="0"
                                                           onclick="autorizarConcilicacion('{{$item['local']->trab_id."-".$item['local']->dcon_linea}}','{{$item['local']->trab_id."checkboxAuth"}}', false)">
                                                    <label for="{{$item['local']->trab_id}}checkboxDen">
                                                    </label>
                                                </div>
                                            </th>
                                            <th class="text-center">{{$item['exterior']['cuenta_bancaria']}}</th>
                                            <th class="text-center">{{$item['exterior']['fecha']}}</th>
                                            <th class="text-center">{{$item['exterior']['referencia']}}</th>
                                            <th class="text-center">{{$item['exterior']['concepto']}}</th>
                                            <th class="text-center">{{$item['exterior']['monto']}}</th>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive col-6">
                                <h4 class="text-center">Transacciones que no se pudieron validar</h4>
                                <table class="table table-striped table-hover" id="tabla">
                                    <thead class='thead-dark'>
                                    <tr>
                                        <th class="text-center">Cuenta bancaria</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Referencia</th>
                                        <th class="text-center">Concepto</th>
                                        <th class="text-center">Monto</th>
                                        <th class="text-center">Autorizar - Rechazar</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($transacciones as $item)
                                        <tr>
                                            <th class="text-center">{{$item->cuenta_bancaria}}</th>
                                            <th class="text-center">{{$item->fecha}}</th>
                                            <th class="text-center">{{$item->referencia}}</th>
                                            <th class="text-center">{{$item->concepto}}</th>
                                            <th class="text-center">{{$item->monto}}</th>
                                            <th class="text-center d-flex justify-content-around">
                                                <div class="icheck-green">
                                                    <input type="checkbox" id="{{$item->trab_id}}checkboxAuthNo"
                                                           value="0"
                                                           onclick="autorizarConcilicacion('{{$item->trab_id."-".$item->dcon_linea}}','{{$item->trab_id."checkboxDenNo"}}', true)">
                                                    <label for="{{$item->trab_id}}checkboxAuthNo">
                                                    </label>
                                                </div>
                                                <div class="icheck-red">
                                                    <input type="checkbox" id="{{$item->trab_id}}checkboxDenNo"
                                                           value="0"
                                                           onclick="autorizarConcilicacion('{{$item->trab_id ."-". $item->dcon_linea}}','{{$item->trab_id."checkboxAuthNo"}}', false)">
                                                    <label for="{{$item->trab_id}}checkboxDenNo">
                                                    </label>
                                                </div>
                                            </th>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="table-responsive col-6">
                                <h4 class="text-center">Transacciones que no corresponden al sistema(Excel)</h4>
                                <table class="table table-striped table-hover" id="tabla">
                                    <thead class='thead-dark'>
                                    <tr>
                                        <th class="text-center">Cuenta bancaria</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Referencia</th>
                                        <th class="text-center">Concepto</th>
                                        <th class="text-center">Monto</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($excel as $item)
                                        <tr>
                                            <th class="text-center">{{$item['cuenta_bancaria']}}</th>
                                            <th class="text-center">{{$item['fecha']}}</th>
                                            <th class="text-center">{{$item['referencia']}}</th>
                                            <th class="text-center">{{$item['concepto']}}</th>
                                            <th class="text-center">{{$item['monto']}}</th>
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

