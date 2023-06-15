function ConciConciliar(conciliacion) {
    let cambiar = $('#' + conciliacion + 'conci').html()==="Conciliado"?"pendiente":"conciliado"

    console.log(cambiar)
    var path = $("#autPath").val() + '/' + conciliacion + '/' + cambiar
    $.get(path, function (response) {
        if(cambiar === 'conciliado'){
            $('#' + conciliacion + 'conci').html('Conciliado')
            Contabilidad.notificacion('Conciliacion autorizada con Exito','Conciliaciones','success');
        }else{
            $('#' + conciliacion + 'conci').html('No Conciliado')
            Contabilidad.notificacion('Autorizacion Cancelada con Exito','Conciliaciones','error');
        }
    });

}
