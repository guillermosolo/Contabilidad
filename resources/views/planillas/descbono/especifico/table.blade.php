<fieldset class="border p-2 col-sm-12 col-lg-12 my-3">
    <legend>Seleccione los empleados para aplicar {{$tipo=='D'?'el Descuento':'la Bonificacion'}}</legend>
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="tabla-data" cellspacing="0"
               width="100%">
            <thead class='thead-dark'>
            <tr>
                <th>ID</th>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Doc.ID</th>
                <th>Tipo&nbsp;Salario</th>
                <th>Empresa&nbsp;Terminal</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($empleados ??[] as $data)
                <tr>
                    <td>{{$data->empl_id}}</td>
                    <td>{{$data->empl_codigo}}</td>
                    <td>{{strtoupper($empleado->getNombreCompleto($data->empl_id))}}</td>
                    <td>{{$data->empl_tipoDocID==1 ? 'DPI' : ($data->empl_tipoDocID==2 ? 'PARTIDA DE NACIMIENTO' : 'PASAPORTE')}}:&nbsp;{{$data->empl_docID}}</td>
                    <td>{{$data->empl_tipoSalario=='T'?'POR TURNOS':'MENSUAL'}}: {{$data->empl_salario}}</td>
                    <td>{{$data->Empresa->emp_siglas}}&nbsp;{{$data->Terminal->ter_abreviatura}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</fieldset>
