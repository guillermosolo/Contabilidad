<table class="table table-striped table-hover" id="tabla-data">
    <thead class='thead-dark'>
    <tr>
        <th scope="col">Beneficiario</th>
    </thead>
    <tbody>
    <tr>
        <td scope="row">{{$cheque['che_beneficiario']}}</td>
    </tr>
    </tbody>
    <thead class='thead-dark'>
    <tr>
        <th scope="col">Cantidad</th>
    </thead>
    <tbody>
    <tr>
        <td scope="row">Q {{$cheque['che_monto']}}</td>
    </tr>
    </tbody>
</table>
