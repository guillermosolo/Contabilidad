$('.empresa').on('change', function () {
    var data = {
        usuario_id: $('input[name=usuario]').val(),
        empresa_id: $(this).val(),
        _token: $('input[name=_token]').val()
    };
    if ($(this).is(':checked')){
        data.estado = 1
    } else {
        data.estado = 0
    }
    ajaxRequest('/parametros/empresa/usuario', data);
});

function ajaxRequest (url,data){
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function (respuesta){
            if (data.estado == 1){
            Contabilidad.notificacion('La empresa se asignó correctamente','Contabilidad','success');
            } else {
            Contabilidad.notificacion('La empresa se desasignó correctamente','Contabilidad','error');
            }
        }
    });
}
