<fieldset class="border p-2 col-sm-12 col-lg-12 my-3">
    <legend class="d-flex justify-content-between">
        <div>Datos empleo Extranjero</div>
        <div>
            @can('crear planillas/empleados')
                <a data-toggle="modal" data-target="#modalExt"
                   class="btn btn-block btn-success btn-sm"
                   id="crear">
                    Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
            @else
                <a class="btn btn-block btn-success btn-sm disabled">
                    Nuevo registro<i class="fa fa-fw fa-plus-circle pl-1"></i></a>
            @endcan
        </div>
    </legend>
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="tabla-data" cellspacing="0" width="100%">
            <thead class='thead-dark'>
            <tr>
                <th>Ocupacion</th>
                <th>Pais</th>
                <th>Motivo</th>
                <th class="width70">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($dataExt??[] as $data)
                <tr>
                    <td>{{$data->trex_ocupacion}}</td>
                    <td>{{$data->Pais->pai_descripcion}}</td>
                    <td>{{$data->trex_motivo}}</td>
                    <td>
                        @can('eliminar planillas/empleados')
                            <a href="{{route('empleados.eliminarExt',['id'=> $data->trex_id])}}"
                               class="btn-accion-tabla eliminar-registro" data-toggle="tooltip"
                               title="Eliminar este registro">
                                <i class="text-danger far fa-trash-alt"></i></a>
                        @else
                            <a href="{{route('empleados.eliminarExt',['id'=> $data->trex_id])}}"
                               class="btn-accion-tabla eliminar-registro disabled" data-toggle="tooltip"
                               title="Eliminar este registro">
                                <i class="text-danger far fa-trash-alt"></i></a>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</fieldset>
