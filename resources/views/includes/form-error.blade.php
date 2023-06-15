@if ($errors->any())
<div class="alert alert-time alert-danger {{$errors->first()=='catch' ? '' : 'alert-dismissible'}}" {{$errors->first()=='catch' ? '' : 'data-auto-dismiss=3000'}}>
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4 class="alert-heading"><i class="icon fa fa-ban"></i>Mensaje del Sistema</h4>
    <ul>
        @php
        $esconder=0;
        @endphp
        @foreach ($errors->all() as $error)
        @if ($error=='catch')
                    <li>El registro no se puede borrar debido a una excepción en la base de datos.</li>
                    <div id="collapse16" class="col" style="display:none">
                        @php
                        $esconder = 1;
                        @endphp
        @elseif($error=='catch2')
                    <li>El registro no se puede Insertar/Actualizar debido a una excepción en la base de datos.</li>
                    <div id="collapse16" class="col" style="display:none">
                        @php
                        $esconder = 1;
                        @endphp
        @else
                            @if ($esconder ==1)
                                <p>{!!$error!!}</p>
                            @else
                                <li>{!!$error!!}</li>
                            @endif
        @endif
        @endforeach
        @if ($esconder == 1)
                    </div>
                    <a href="#collapse16" id="leerMas" class="nav-toggle"><b>Leer Mas..</b></a>

        @endif
    </ul>
</div>
@endif
