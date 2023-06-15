@extends("layout.layout")
@section("titulo")
Empresa
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('empresa.mostrar',$data) }}
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('parametros/empresa')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Mostrar Empresa: {{$data->emp_nombre}}<small></small></h3>
                        <div class="card-tools">
                            <a href="{{route('empresa')}}" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                    <div class="card-body row">
                        <div class="col-lg-7">
                            <div class="row">
                                <label for="" class="col-lg-4 text-sm-left text-lg-right">Nombre</label>
                                <p class="col-lg-8">{{$data->emp_nombre}}</p>
                            </div>
                            <div class="row">
                                <label for="" class="col-lg-4 text-sm-left text-lg-right">Nombre Comercial</label>
                                <p class="col-lg-8">{{$data->emp_nomComercial}}</p>
                            </div>
                            <div class="row">
                                <label for="" class="col-lg-4 text-sm-left text-lg-right">Siglas</label>
                                <p class="col-lg-8">{{$data->emp_siglas}}</p>
                            </div>
                            <div class="row">
                                <label for="" class="col-lg-4 text-sm-left text-lg-right">NIT</label>
                                <p class="col-lg-8">{{Str::nit($data->emp_NIT)}}</p>
                            </div>
                            <div class="row">
                                <label for="" class="col-lg-4 text-sm-left text-lg-right">Municipio</label>
                                <p class="col-lg-8">{{$data->Departamento->getDescLg($data->emp_municipio)}}</p>
                            </div>
                            <div class="row">
                                <label for="" class="col-lg-4 text-sm-left text-lg-right">Código de Actividad
                                    Económica</label>
                                <p class="col-lg-8">{{$data->emp_actividad}}</p>
                            </div>
                            <div class="row">
                                <label for="" class="col-lg-4 text-sm-left text-lg-right">Actividad Económica</label>
                                <p class="col-lg-8">{{$data->emp_descripcion}}</p>
                            </div>
                            <div class="row">
                                <label for="" class="col-lg-4 text-sm-left text-lg-right">Régimen</label>
                                <p class="col-lg-8">{{$data->Regimen->reg_descripcion}}</p>
                            </div>
                            <div class="row">
                                <label for="" class="col-lg-4 text-sm-left text-lg-right">Certificador FEL</label>
                                <p class="col-lg-8">{{$data->FEL->cer_nombre}}</p>
                            </div>
                            <div class="row">
                                <label for="" class="col-lg-4 text-sm-left text-lg-right">Inicio de Actividades</label>
                                <p class="col-lg-8">{{\Carbon\Carbon::parse($data->emp_inicio)->format('d/m/Y')}}</p>
                            </div>
                            <div class="row">
                                <label for="" class="col-lg-4 text-sm-left text-lg-right">Empresa Activa</label>
                                <p class="col-lg-8">{{$data->emp_activa?"SI":"NO"}}</p>
                            </div>
                            <div class="row">
                                <label for="" class="col-lg-4 text-sm-left text-lg-right">CUI</label>
                                <p class="col-lg-8">{{$data->emp_CUI??"-"}}</p>
                            </div>
                            <div class="row">
                                <label for="" class="col-lg-4 text-sm-left text-lg-right">País de Nacionalidad</label>
                                <p class="col-lg-8">{{$data->Pais->pai_descripcion}}</p>
                            </div>
                            <div class="row">
                                <label for="" class="col-lg-4 text-sm-left text-lg-right">Número Patronal IGSS</label>
                                <p class="col-lg-8">{{$data->emp_numeroIGSS??"-"}}</p>
                            </div>
                            <div class="row">
                                <label for="" class="col-lg-4 text-sm-left text-lg-right">Nomenclatura</label>
                                <p class="col-lg-8">{{$data->emp_nomenclatura??"-"}}</p>
                            </div>
                            <div class="row">
                                <label for="" class="col-lg-4 text-sm-left text-lg-right">Sitio Web</label>
                                <p class="col-lg-8">{{$data->emp_sitioWeb??"-"}}</p>
                            </div>
                            <div class="row">
                                <label for="" class="col-lg-4 text-sm-left text-lg-right">Correo Electrónico</label>
                                <p class="col-lg-8">{{$data->emp_email??"-"}}</p>
                            </div>
                            <div class="row">
                                <label for="" class="col-lg-4 text-sm-left text-lg-right">Posee Sindicato</label>
                                <p class="col-lg-8">{{$data->emp_sindicato?"SI":"NO"}}</p>
                            </div>
                            <div class="row">
                                <label for="" class="col-lg-4 text-sm-left text-lg-right">Teléfono</label>
                                <p class="col-lg-8">{{$data->emp_telefono??"-"}}</p>
                            </div>
                            <div class="row">
                                <div class="col-lg-2"></div>
                                <fieldset class="border p-2 col-sm-12 col-lg-8">
                                    <legend class="w-auto">Dirección</legend>
                                    <div class="row">
                                        <label for="" class="col-lg-2 text-sm-left text-lg-right">Ubicación</label>
                                        <p class="col-lg-8">{{$data->emp_direccion??"-"}}</p>
                                    </div>
                                    <div class="row">
                                        <label for="" class="col-lg-2 text-sm-left text-lg-right">Colonia</label>
                                        <p class="col-lg-4">{{$data->emp_colonia??"-"}}</p>

                                        <label for="" class="col-lg-2 text-sm-left text-lg-right">Zona</label>
                                        <p class="col-lg-2">{{$data->emp_zona??"-"}}</p>
                                    </div>
                                    <div class="row">
                                        <label for="" class="col-lg-2 text-sm-left text-lg-right">Calle</label>
                                        <p class="col-lg-4">{{$data->emp_calle??"-"}}</p>

                                        <label for="" class="col-lg-2 text-sm-left text-lg-right">Avenida</label>
                                        <p class="col-lg-2">{{$data->emp_avenida??"-"}}</p>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card card-outline card-secondary">
                                        <div class="card-header">
                                            <h4 class="card-title">Logo</h4>
                                        </div>
                                        <div class="card-body">
                                                @if (file_exists(public_path()."/assets/img/logos/".$data->emp_id.".jpg"))
                                                <img src="{{asset("assets/img/logos/".$data->emp_id.".jpg")}}" alt=""
                                                    class="mx-auto d-block" height="100px">
                                                @elseif (file_exists(public_path()."/assets/img/logos/".$data->emp_id.".png"))
                                                <img src="{{asset("assets/img/logos/".$data->emp_id.".png")}}" alt=""
                                                    class="mx-auto d-block" height="100px">
                                                @else
                                                <img src="{{asset("assets/img/logos/nologo.png")}}" alt=""
                                                    class="mx-auto d-block" height="100px">
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card card-outline card-secondary">
                                        <div class="card-header">
                                            <h4 class="card-title">Representantes y Contadores</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="list-group list-group-flush">
                                                @foreach ($data->Representantes as $item)
                                                @if(is_null($item->pivot->rep_fin)||$item->pivot->rep_fin>date("Y-m-d H:i:s"))
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <b>{{$item->repr_nombre}}</b><span>Finaliza: {{is_null($item->pivot->rep_fin)?"INDEFINIDO":\Carbon\Carbon::parse($item->pivot->rep_inicio)->format('d/m/Y')}}</span>
                                                    <span class="badge badge-primary badge-pill">{{App\Models\Admin\TiposRepresentante::getTipo($item->pivot->rep_tipo)}}</span>
                                              </div>
                                                @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card card-outline card-secondary">
                                        <div class="card-header">
                                            <h4 class="card-title">Operaciones en Terminales</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="list-group list-group-flush">
                                                @foreach ($data->Terminales as $item)
                                                <div class="d-flex justify-content-between align-items-center">
                                                    {{$item->ter_nombre}}
                                                    @if ($item->ter_activo)
                                                    <span class="badge badge-success badge-pill"><i
                                                            class="fas fa-check"></i></span>
                                                    @else
                                                    <span class="badge badge-danger badge-pill"><i
                                                            class="fas fa-times"></i></span>
                                                    @endif
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
