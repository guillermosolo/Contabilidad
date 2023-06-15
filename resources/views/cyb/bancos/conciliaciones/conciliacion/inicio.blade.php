@extends("layout.layout")

@section("titulo")
    Conciliaciones
@endsection

@section('styles')
    <link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css")}}">
@endsection

@section('scripts')
    <script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
    <script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
    <script src="{{asset("assets/plugins/inputmask/jquery.inputmask.bundle.js")}}"></script>
    <script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
    <script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
    <script src="{{asset("assets/pages/scripts/cyb/bancos/cuentasbancarias/table.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/pages/scripts/cyb/fechasAbajo.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/pages/scripts/cyb/bancos/conciliaciones/conciliar.js")}}" type="text/javascript"></script>

@endsection

@section("scriptPlugins")
    <script src="{{asset("assets/plugins/datatables/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-responsive/js/dataTables.responsive.min.js")}}"></script>
    <script src="{{asset("assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js")}}"></script>
@endsection


@section('breadcrumbs')
    {{ Breadcrumbs::render('conciliaciones') }}
@endsection

@section('contenido')
    <input type="hidden" id="routepath" value="{{url('cyb/bancos/conciliaciones')}}">
    @inject('det','App\Models\cyb\DetalleConciliacion')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @include('includes.mensaje')
                    @include('includes.form-error')
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Conciliaciones Generadas<small></small></h3>
                            <div class="card-tools">
                                @can('crear cyb/bancos/conciliaciones')
                                    <a href="{{route('conciliaciones.crear')}}"
                                       class="btn btn-block btn-success btn-sm">
                                        Nueva Conciliación<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                @else
                                    <a href="{{route('conciliaciones.crear')}}"
                                       class="btn btn-block btn-success btn-sm disabled">
                                        Nueva Conciliación<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
                                @endcan

                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{route('liquidpdf')}}" id="form-general" class="form-horizontal"
                                  method="get">
                                <div class="form-group row">
                                    @csrf
                                    <label for="per_nit"
                                           class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-left requerido">Año</label>
                                    <div class="col-sm-12 col-lg-2">
                                        <select name="search" class="form-control select2" id="inputempleados" required>
                                            <option value=""> Elija el año</option>
                                            <option value="2021"> 2021</option>
                                            <option value="2022"> 2022</option>
                                            <option value="2023"> 2023</option>
                                            <option value="2024"> 2024</option>
                                            <option value="2025"> 2025</option>
                                            <option value="2026"> 2026</option>
                                            <option value="2027"> 2027</option>
                                            <option value="2028"> 2028</option>
                                            <option value="2029"> 2029</option>
                                            <option value="2030"> 2030</option>
                                        </select>
                                    </div>
                                    <label for="con_mes"
                                           class="col-sm-12 col-lg-1 control-label text-sm-left text-lg-left requerido">Mes</label>
                                    <div class="col-sm-12 col-lg-2">
                                        <select name="search2" class="form-control select2" id="inputempresa" required>
                                            <option value=""> Elija un mes</option>
                                            <option value="01"> Enero</option>
                                            <option value="02"> Febrero</option>
                                            <option value="03"> Marzo</option>
                                            <option value="04"> Abril</option>
                                            <option value="05"> Mayo</option>
                                            <option value="06"> Junio</option>
                                            <option value="07"> Julio</option>
                                            <option value="08"> Agosto</option>
                                            <option value="09"> Septiembre</option>
                                            <option value="10"> Octubre</option>
                                            <option value="11"> Noviembre</option>
                                            <option value="12"> Diciembre</option>
                                        </select>
                                    </div>
                                    <div class="card-tools">
                                        <button type="submit " class="btn btn-outline-danger">Imprimir Conciliados<i
                                                class="far fa-file-pdf pl-1"></i></button>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="tabla-data">
                                    <input type="hidden" id="autPath" value="{{url('cyb/bancos/conciliaciones/conciliar')}}">

                                    <thead class='thead-dark'>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Cuenta</th>
                                        <th scope="col">Año</th>
                                        <th scope="col">Mes</th>
                                        <th scope="col">Saldo</th>
                                        <th scope="col">Total Concilado</th>
                                        <th scope="col">Conciliado</th>
                                        <th scope="col">Opciones</th>
                                        <th scope="col">Liquidado</th>
                                    </thead>
                                    <tbody>
                                    @foreach($conciliacion as $conci)
                                        <tr>
                                            <td>{{$conci['con_id']}}</td>
                                            <td>{{$conci->ConciliacionCuenta->ctab_numero}}
                                                - {{$conci->ConciliacionCuenta->Empresa->emp_siglas}}
                                                - {{$conci->ConciliacionCuenta->Moneda->mon_nombre}}</td>
                                            <td>{{$conci['con_anio']}}</td>
                                            <td>
                                                @if($conci['con_mes'] == 1) Enero @elseif($conci['con_mes'] == 2)
                                                    Febrero @elseif($conci['con_mes'] == 3) Marzo
                                                @elseif($conci['con_mes'] == 4) Abril @elseif($conci['con_mes'] == 5)
                                                    Mayo @elseif($conci['con_mes'] == 6) Junio
                                                @elseif($conci['con_mes'] == 7) Julio @elseif($conci['con_mes'] == 8)
                                                    Agosto @elseif($conci['con_mes'] == 9) Septiembre
                                                @elseif($conci['con_mes'] == 10)
                                                    Octubre @elseif($conci['con_mes'] == 11) Noviembre @else
                                                    Diciembre @endif
                                            <td>{{Str::money($conci['con_saldo'], "Q ")}}</td>
                                            <td>{{Str::money($det->totalConciliacion($conci['con_id']), "Q ")}}</td>


                                            <td id="{{$conci['con_id']}}conci">
                                                @if($conci['con_conciliado'] == 0)
                                                    No conciliado
                                                @else
                                                    Conciliado
                                                @endif
                                            </td>
                                            <td>
                                                @if($conci['con_conciliado']==0)
                                                <a href="{{route('conciliaciones.generarExcel',['id'=>$conci['con_id']])}}"
                                                   class="btn-accion-tabla   @can('crear cyb/bancos/conciliaciones') @else disabled @endcan"><i
                                                        data-toggle="tooltip" title="Generar Validacion"
                                                        class="text-success far fa-save"></i></a>&nbsp&nbsp&nbsp&nbsp
                                                @else
                                                    <a href="{{route('conciliaciones.generarExcel',['id'=>$conci['con_id']])}}"
                                                       class="btn-accion-tabla disabled "><i
                                                            data-toggle="tooltip" title="Generar Validacion"
                                                            class="text-success far fa-save"></i></a>&nbsp&nbsp&nbsp&nbsp
                                                    @endif
                                                <a href="{{route('detallesdeconciliaciones',['id'=>$conci['con_id']])}}"
                                                   class="btn-accion-tabla   @can('crear cyb/bancos/conciliaciones') @else disabled @endcan"><i
                                                        data-toggle="tooltip" title="Lista de Detalles"
                                                        class="far fa-eye"></i></a>

                                            </td>
                                            <td align="center">
                                                @can('crear cyb/bancos/conciliaciones')
                                                <div class="icheck-midnightblue d-inline">
                                                    <input type="checkbox" id="{{$conci['con_id']}}A" value="0" @if($conci['con_conciliado']==1) checked @endif onclick="ConciConciliar({{$conci['con_id']}})">
                                                    <label for="{{$conci['con_id']}}A">
                                                    </label>
                                                </div>
                                                    @else
                                                    <div class="icheck-midnightblue d-inline">
                                                        <input type="checkbox" id="" disabled value="0" @if($conci['con_conciliado']==1) checked @endif>
                                                        <label for="">
                                                        </label>
                                                    </div>
                                                    @endcan
                                            </td>
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
