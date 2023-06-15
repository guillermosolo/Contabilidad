@extends("layout.layout")
@section("titulo")
Reportes CxP
@endsection

@section('styles')
<link href="{{asset("assets/plugins/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css" />
<link href="{{asset("assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css")}}" rel="stylesheet"
    type="text/css" />
<link rel="stylesheet" href="{{asset("assets/plugins/daterangepicker/daterangepicker.css")}}">
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('reportescxp.docrecibidos') }}
@endsection

@section('scripts')
<script src="{{asset("assets/pages/scripts/cxp/reportes/recibidos.js")}}" type="text/javascript"></script>
<script src="{{asset("assets/plugins/select2/js/select2.full.min.js")}}"></script>
<script src="{{asset("assets/plugins/select2/js/i18n/es.js")}}"></script>
<script src="{{asset("assets/plugins/moment/moment.min.js")}}"></script>
<script src="{{asset("assets/plugins/daterangepicker/daterangepicker.js")}}"></script>
@endsection

@section('contenido')
@inject('mon','App\Models\Admin\Moneda')
<input type="hidden" id="routepath" value="{{url('cxp/reportes/recibidos')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.form-error')
                @include('includes.mensaje')
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">Reporte de Documentos Recibidos<small></small></h3>
                    </div>
                    <form action="{{route('cxp.reportes.recibidos.generar')}}" id="form-general" class="form-horizontal"
                        method="POST" autocomplete="off">
                        <div class="card-body">
                            @csrf
                            <div class="form-group row">
                                <label for="empresa"
                                    class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right requerido">Empresa</label>
                                <div class="col-sm-12 col-lg-4">
                                    <select name="empresa[]" id="empresa" multiple="multiple"
                                        class="form-control select2" placeholder="Empresa" required>
                                        @foreach (auth()->user()->Empresas as $item)
                                        <option value="{{$item->emp_id}}">
                                            {{$item->emp_siglas}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="terminal"
                                    class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Teminales</label>
                                <div class="col-sm-12 col-lg-4">
                                    <select name="terminal[]" id="terminal" multiple="multiple"
                                        class="form-control select2" placeholder="Terminales">
                                        @foreach (auth()->user()->Terminales as $item)
                                        <option value="{{$item->ter_id}}">
                                            {{$item->ter_nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="moneda"
                                    class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Moneda</label>
                                <div class="col-sm-12 col-lg-4">
                                    <select name="moneda[]" id="moneda" multiple="multiple" class="form-control select2"
                                        placeholder="Moneda">
                                        @foreach ($mon->all() as $item)
                                        <option value="{{$item->mon_id}}">
                                            {{$item->mon_nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tipoDoc"
                                    class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Tipo de
                                    Documento</label>
                                <div class="col-sm-12 col-lg-4">
                                    <select name="tipoDoc[]" id="tipoDoc" multiple="multiple"
                                        class="form-control select2" placeholder="Moneda">
                                        <option value="F">Factura</option>
                                        <option value="I">Póliza de Importación</option>
                                        <option value="R">Recibo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="fecha"
                                    class="col-sm-12 col-lg-2 control-label text-sm-left text-lg-right">Fecha</label>
                                <div class="input-group col-sm-12 col-lg-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control float-right" id="fecha" name="fecha">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-2 text-center">
                                    <button type="submit" id="submit"
                                        class="btn btn-lg btn-outline-success float-right">Generar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
