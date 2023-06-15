@extends("layout.layout")
@section("titulo")
Depreciaciones
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('depreciaciones.mostrar',$activo) }}
@endsection

@section('contenido')
<input type="hidden" id="routepath" value="{{url('activos/depreciacion')}}">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline card-dark">
                    <div class="card-header">
                        <h3 class="card-title">Mostrar Activo: <small>{{$activo->act_descripcion}}</small></h3>
                        <div class="card-tools">
                            <a href="{{route('depreciaciones')}}" class="btn btn-block btn-info btn-sm">
                                Volver a Listado<i class="fas fa-arrow-circle-left pl-1"></i></a>
                        </div>
                    </div>
                    <div class="card-body row">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tabla-data">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Año</th>
                                        <th>Ene</th>
                                        <th>Feb</th>
                                        <th>Mar</th>
                                        <th>Abr</th>
                                        <th>May</th>
                                        <th>Jun</th>
                                        <th>Jul</th>
                                        <th>Ago</th>
                                        <th>Sep</th>
                                        <th>Oct</th>
                                        <th>Nov</th>
                                        <th>Dic</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $i = 0;
                                    @endphp
                                    <tr>
                                        @foreach ($tabla as $item)
                                        @if ($i==0)
                                        <th scope="row">{{$item->tab_anio}}</th>
                                        @for($i=1;$i<$item->tab_mes;$i++)
                                            <td></td>
                                            @endfor
                                            @endif
                                            @if ($item->tab_operado)
                                            <td class="text-success">{{Str::money($item->tab_monto,'Q.')}}</td>
                                            @else
                                            <td class="text-danger">{{Str::money($item->tab_monto,'Q.')}}</td>
                                            @endif
                                            @if ($item->tab_mes==12)
                                    </tr>
                                    <tr>
                                        <th scope="row">{{$item->tab_anio+1}}</th>
                                        @endif
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
