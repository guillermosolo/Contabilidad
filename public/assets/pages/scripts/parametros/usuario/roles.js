$(".asignaRoles").on("change", function () {
    const url2 = window.location.href;
    var data = {
        usuario_id: $("input[name=usuario]").val(),
        rol_name: $(this).val(),
        _token: $("input[name=_token]").val(),
    };
    if ($(this).is(":checked")) {
        data.estado = 1;
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-lg btn-outline-success mr-5",
                cancelButton: "btn btn-lg btn-outline-danger",
            },
            buttonsStyling: false,
        });
        swalWithBootstrapButtons
            .fire({
                title: "Ingrese el nombre de quien autoriza asignar este rol",
                input: "text",
                inputAttributes: {
                    autocapitalize: "off",
                },
                inputValidator: (value) => {
                    return !value && "El nombre no puede ser nulo.";
                },
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonText: "Asignar",
            })
            .then((val) => {
                if (val.value) {
                    data.autorizo = val.value;
                    ajaxRequestRole("/parametros/rol/rolGuardar", data);
                } else {
                    window.location.href = url2;
                }
            });
    } else {
        data.estado = 0;
        ajaxRequestRole("/parametros/rol/rolGuardar", data);
    }
});

function ajaxRequestRole(url, data) {
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        success: function (respuesta) {
            if (data.estado == 1) {
                Contabilidad.notificacion(
                    "El rol se asignó correctamente",
                    "Contabilidad",
                    "success"
                );
            } else {
                Contabilidad.notificacion(
                    "El rol se desasignó correctamente",
                    "Contabilidad",
                    "error"
                );
            }
        },
        error: function (resp) {
            console.log(resp);
        },
    });
}
