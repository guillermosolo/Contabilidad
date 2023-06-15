<fieldset class="border p-2 col-sm-12 col-lg-12 my-3">
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="tabla-data" cellspacing="0"
               width="100%">
            <thead class='thead-dark'>
            <tr>
                <th>Empleado</th>
                <th>Turnos</th>
                <th>Extras</th>
                <th>Ordinales</th>
            </tr>
            </thead>
            <tbody>
            @foreach (session('dataEmpleadosSeleccionados')??[]  as $data)
                <tr>
                    <td>{{strtoupper($empleado->getNombreCompleto($data['dett_empleado']))}}</td>
                    <td>{{$data['dett_turnos']}}</td>
                    <td>{{$data['dett_extras']}}</td>
                    <td>{{$data['dett_ordinales']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</fieldset>
