<div class="table-responsive">
    <table class="table table-striped table-hover" id="tabla-data" cellspacing="0"
           width="100%">
        <thead class='thead-dark'>
        <tr>
            <th>No.</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Descripcion</th>
            <th>Tipo</th>
            <th>Liquidacion</th>
            <th class="width70">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{$data->pla_id}}</td>
                <td>{{Carbon\Carbon::parse($data->pla_inicio)->format('Y/m/d')}}</td>
                <td>{{Carbon\Carbon::parse($data->pla_fin)->format('Y/m/d')}}</td>
                <td>{{$data->pla_descripcion}}</td>
                <td>{{$data->pla_tipo=='E'?'EVENTUAL':'ORDINARIA'}}</td>
                <td>{{$data->pla_liquidacion?'SI':'NO'}}</td>
                <td>


                    @if($data->pla_tipo=='E')
                        @if($data->verificarDetalles($data->pla_id))
                            <a href="{{route('planillas-eventual.show',['id'=> $data->pla_id])}}"
                               class="btn-accion-tabla   @can('crear planillas/generacion') @else disabled @endcan"
                               data-toggle="tooltip"
                               title="Ver planilla">
                                <i class="far fa-eye"></i></a>
                        @else
                            <a href="{{route('planillas-eventual.generar',['planilla'=> $data->pla_id])}}"
                               class="btn-accion-tabla   @can('crear planillas/generacion') @else disabled @endcan"><i
                                    data-toggle="tooltip" title="Generar Planilla" class="text-success far fa-save"></i></a>

                        @endif
                        @if($data->pla_estado=='C')
                            <a href="{{route('planillas-eventual.eliminar',['id'=> $data->pla_id])}}"
                               class="btn-accion-tabla eliminar-registro "
                               data-toggle="tooltip"
                               title="Eliminar este registro">
                                <i class="text-danger far fa-trash-alt"></i></a>
                        @endif

                    @else
                        <a href="{{route('planillas-mensual.show',['id'=> $data->pla_id])}}"
                           class="btn-accion-tabla   @can('crear planillas/generacion') @else disabled @endcan"
                           data-toggle="tooltip"
                           title="Ver planilla">
                            <i class="far fa-eye"></i></a>
                        @if($data->pla_estado=='C')
                            <a href="{{route('planillas-mensual.eliminar',['id'=> $data->pla_id])}}"
                               class="btn-accion-tabla eliminar-registro "
                               data-toggle="tooltip"
                               title="Eliminar este registro">
                                <i class="text-danger far fa-trash-alt"></i></a>
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
