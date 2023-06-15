function autorizarConcilicacion(transacion,id_item,asignar) {

    var path = $("#authPath").val() + '/' + transacion + '/' + (asignar?1:0)
    $.get(path, function () {
        let checkbox2 = $('#' + id_item);
        let segundo = asignar === 'Conciliado' ? id_item + 0 : id_item + 1;
        if (checkbox2.prop('checked')) {
            checkbox2.prop('checked', false)
        }
        if(asignar){
            $('#' + transacion + 'status').html('Conciliado')
            Contabilidad.notificacion('Transaccion Autorizada con exito','Bancos','success');
        }else{
            $('#' + transacion + 'status').html('No Conciliado')
            Contabilidad.notificacion('Transaccion Rechazada con exito','Bancos','error');
        }
    });

}
