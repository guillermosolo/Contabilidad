@inject('empleado','App\Models\Planilla\Empleado')

<table class="table table-striped table-hover" cellspacing="0"
       width="100%">
    <thead class='thead-dark'>
    <tr>
        <th></th>
        <th>NOMBRE</th>
        <th>TOTAL</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($datas as $index => $data)
        <tr>
            <td >{{$index+1}}</td>
            <td>{{strtoupper($empleado->getNombreCompleto($data->empleado))}}</td>
            <td>{{$data->monto}}</td>
        </tr>
    @endforeach
    <tr>
        <td class="tr-final"></td>
        <td class="tr-final">TOTAL GENERAL</td>
        <td class="tr-final">{{$total}}</td>
    </tr>
    </tbody>
</table>
