<!DOCTYPE html>
<html lang="es">
<head>
    <title>Hola Mundo!</title>
    <link rel="stylesheet" href="pages/scripts/cyb/bancos/cuentasbancarias/app2.css">
</head>
<body>
@inject('empleado','App\Models\Planilla\Empleado')
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="tabla-data">
            <thead class='thead-dark'>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Responsable</th>
                <th scope="col">Cuenta Contable</th>
                <th scope="col">Empresa</th>&nbsp
                <th scope="col">Monto</th>
                <th scope="col">Opciones</th>

            </thead>
            <tbody>
            @foreach($cajachicas as $cajachica)
                <tr>
                    <td scope="row">{{$cajachica['cch_id']}}</td>
                    <td>{{$cajachica['cch_nombre']}}</td>
                    <td>{{$empleado->getNombreCompleto($cajachica->cch_responsable)}}</td>
                    <td>{{$cajachica->CuentaContable->cta_descripcion}}</td>
                    <td>{{$cajachica->Empresa->emp_siglas}}</td>
                    <td>{{Str::money($cajachica['cch_monto'],"Q ")}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
