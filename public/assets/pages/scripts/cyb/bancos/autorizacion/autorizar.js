function cambiarstatusxd(detalle, cambiar) {
    var path = $("#autPath").val() + '/' + detalle + '/' + cambiar
    $.get(path, function (response) {
        let segundo = cambiar === 'liquidado' ? detalle + 'R' : detalle + 'L';
        if ($('#' + segundo).prop('checked')) {
            $('#' + segundo).prop('checked', false)
        }
        if(cambiar === 'liquidado'){
            $('#' + detalle + 'status').html('Liquidado')
            Contabilidad.notificacion('Detalle Liquidado Correctamente','CajaChica','success');
        }else{
            $('#' + detalle + 'status').html('Rechazado')
            Contabilidad.notificacion('El Detalle ha sido Rechazado','CajaChica','error');
        }
    });
}

function liquidar(liquidacion) {
    let checkbox = $('#' +liquidacion+"checkbox").prop('checked');
    let cambiar = checkbox?'liquidar':'pendiente'
    var path = $("#autPath").val() + '/' + liquidacion + '/' + cambiar
    $.get(path, function () {
        if(cambiar === 'liquidar'){
            $('#' + liquidacion + 'liquid').html('Liquidada - Terminada')
            Contabilidad.notificacion('Liquidación Autorizada Correctamente','CajaChica','success');
        }else{
            $('#' + liquidacion + 'liquid').html('Pendiente - Activa')
            Contabilidad.notificacion('La Liquidación ha sido Rechazada','CajaChica','error');
        }
    });

}

function autorizar(id_detalle) {
    let checkbox = $('#' +id_detalle+ 'L').prop('checked');
    let cambiar = checkbox?'liquidar':'pendiente'
    if ($('#' +id_detalle+ 'R').prop('checked')){
        cambiar = "liquidar"
    }
    var path = $("#autPath").val() + '/' + id_detalle + '/' + cambiar
    $.get(path, function () {
        $('#' + +id_detalle+ 'R').prop('checked', false)
        if (cambiar==='liquidar') {
            $('#' + id_detalle + 'status').html('Liquidado')
            Contabilidad.notificacion('Detalle Autorizado Correctamente','CajaChica','success');
        }else{
            $('#' + id_detalle + 'status').html('Pendiente')
            Contabilidad.notificacion('La Autorizacion ha sido Cancelada','CajaChica','warning');
        }
    });

}

function rechazar(id_detalle) {
    let checkbox = $('#' +id_detalle+ 'R').prop('checked');
    let cambiar = checkbox?'rechazar':'pendiente'
    if ($('#' +id_detalle+ 'L').prop('checked')){
        cambiar = "rechazar"
    }
    var path = $("#autPath").val() + '/' + id_detalle + '/' + cambiar
    $.get(path, function () {
        $('#' + +id_detalle+ 'L').prop('checked', false)
        if (cambiar==='pendiente') {
            $('#' + id_detalle + 'status').html('Pendiente')
            Contabilidad.notificacion('El Rechazo ha sido Cancelado','CajaChica','warning');
        }else{
            $('#' + id_detalle + 'status').html('Rechazado')
            Contabilidad.notificacion('Detalle Rechazado correctamente ','CajaChica','error');
        }
    });

}
