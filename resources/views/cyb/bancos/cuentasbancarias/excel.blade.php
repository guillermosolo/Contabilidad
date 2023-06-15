@inject('empleado','App\Models\Planilla\Empleado')
<table>
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Número de Cuenta</th>
        <th scope="col">Tipo de Cuenta</th>
        <th scope="col">Banco</th>
        <th scope="col">Moneda</th>
        <th scope="col">Cuenta Contable</th>
        <th scope="col">Empresa</th>
        <th scope="col">Contacto</th>
        <th scope="col">Teléfono</th>
    </tr>
    </thead>
    <tbody>
    @foreach($cuentasbancariass as $cuentasbancarias)
        <tr>
            <td scope="row">{{$cuentasbancarias['ctab_id']}}</td>
            <td>{{$cuentasbancarias->ctab_numero}}</td>
            <td>{{$cuentasbancarias->Tipo->tcb_descripcion}}</td>
            <td>{{$cuentasbancarias->Banco->ban_siglas}}</td>
            <td>{{$cuentasbancarias->Moneda->mon_nombre}}</td>
            <td>{{$cuentasbancarias->Contable->cta_descripcion}}</td>
            <td>{{$cuentasbancarias->Empresa->emp_siglas}}</td>
            <td>{{$cuentasbancarias['ctab_contacto']}}</td>
            <td>{{$cuentasbancarias['ctab_telefono']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

