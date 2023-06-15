<table class="table table-striped table-hover" id="tabla-data">
    <thead class="thead-dark">
        <tr>
          <th>Propiedad</th>
          <th>Valor</th>
          <th class="width70">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data->Propiedades as $item)
        <tr>
            <td>{{$item->prop_nombre}}</td>
            <td>{{$item->pivot->adi_valor}}</td>
            <td><a href="{{route('activos.eliminarProp',['id'=> $data->act_id,'prop'=>$item->prop_id,'val'=>$item->pivot->adi_valor])}}"
                class="btn-accion-tabla eliminar-registro" data-toggle="tooltip"
                title="Eliminar este registro">
                <i class="text-danger far fa-trash-alt"></i></a></td>
        </tr>
        @endforeach
    </tbody>
</table>
