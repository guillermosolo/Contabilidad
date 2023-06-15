    function forzarSeptimo(empleado,planilla) {

        let tipo =$('#checkbox' + empleado).prop('checked')? 1: 0
        var path = $("#authPath").val() + '/' + empleado+"/"+planilla+"/"+tipo
        $.get(path, function () {
            if ($('#checkbox' + empleado).prop('checked')) {
                Contabilidad.notificacion('Septimo forzado con exito','Planillas','success');
            }else{
                Contabilidad.notificacion('Septimo no forzado con exito','Planillas','error');
            }
        });
    }
