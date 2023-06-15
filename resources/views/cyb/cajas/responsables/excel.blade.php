@inject('empleado','App\Models\Planilla\Empleado')
<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Responsable</th>
        <th>Cuenta Contable</th>
        <th>Empresa</th>
        <th>Monto</th>
    </tr>
    </thead>
    <tbody>
        @foreach($cajachicas as $cajachica)
            <tr>
                <td >{{$cajachica['cch_id']}}</td>
                <td>{{$cajachica['cch_nombre']}}</td>
                <td>{{$empleado->getNombreCompleto($cajachica->cch_responsable)}}</td>
                <td>{{$cajachica->CuentaContable->cta_descripcion}}</td>
                <td>{{$cajachica->Empresa->emp_siglas}}</td>
                <td>{{$cajachica['cch_monto']}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
