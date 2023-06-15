<div class="modal fade" id="modalExt" tabindex="-1" role="dialog" aria-labelledby="modalExtTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{route('empleados.guardarExt',['id'=>$empleado->empl_id])}}" method="POST" id="form-ext">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExtLongTitle">Extranjero</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('planillas.empleados.extranjero.form')
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
