$('.permiso').on('change', function () {
    var data = {
        usuario_id: $('input[name=usuario_id]').val(),
        permiso: $(this).val(),
        _token: $('input[name=_token]').val()
    };
    if ($(this).is(':checked')){
        data.estado = 1
    } else {
        data.estado = 0
    }
    console.log(data);
    ajaxRequest('/parametros/rol/permisoUsuario', data);
});

function ajaxRequest (url,data){
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        success: function (respuesta){
            if (data.estado == 1){
            Contabilidad.notificacion('El permiso se asignó correctamente','Contabilidad','success');
            } else {
            Contabilidad.notificacion('El permiso se desasignó correctamente','Contabilidad','error');
            }
        }
    });
}
