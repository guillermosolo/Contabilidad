function detalleEstado(detalle, cambiar) {
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

function antLiquidar(liquidacion) {
    let cambiar = $('#' + liquidacion + 'anticipo').html()==="Liquidado"?"pendiente":"liquidado"

    console.log(cambiar)
    var path = $("#autPath").val() + '/' + liquidacion + '/' + cambiar
    $.get(path, function (response) {
        if(cambiar === 'liquidado'){
            $('#' + liquidacion + 'anticipo').html('Liquidado')
            Contabilidad.notificacion('Anticipo Autorizado Correctamente','Anticipos','success');
        }else{
            $('#' + liquidacion + 'anticipo').html('No Liquidado')
            Contabilidad.notificacion('El Anticipo ha sido Rechazado','Anticipos','error');
        }
    });

}
