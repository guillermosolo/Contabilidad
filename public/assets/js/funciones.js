var Contabilidad = (function () {
    return {
        validacionGeneral: function (id, reglas, mensajes) {
            const formulario = $("#" + id);
            formulario.validate({
                rules: reglas,
                messages: mensajes,
                errorElement: "div", //default input error message container
                errorClass: "invalid-feedback", // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "", // validate all fields including form hidden input
                highlight: function (element, errorClass, validClass) {
                    // hightlight error inputs
                    $(element).parent().parent().find('label.requerido').addClass('text-danger');
                    $(element).addClass("is-invalid");
                },
                unhighlight: function (element) {
                    // revert the change done by hightlight
                    $(element).removeClass("is-invalid");
                    $(element).parent().parent().find('label').removeClass('text-danger'); // set error class to the control group
                },
                errorPlacement: function (error, element) {
                    if (
                        $(element).is("select") &&
                        element.hasClass("bs-select")
                    ) {
                        //PARA LOS SELECT BOOSTRAP
                        error.insertAfter(element); //element.next().after(error);
                    } else if (
                        $(element).is("select") &&
                        element.hasClass("select2-hidden-accessible")
                    ) {
                        element.next().after(error);
                    } else if (element.attr("data-error-container")) {
                        error.appendTo(element.attr("data-error-container"));
                    } else {
                        error.insertAfter(element); // default placement for everything else
                    }
                },
                invalidHandler: function (event, validator) {
                    //display error alert on form submit
                },
                submitHandler: function (form) {
                    return true;
                }
            });
        },
        notificacion: function (mensaje, titulo, tipo) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "1000",
                "hideDuration": "1000",
                "timeOut": "2000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
              }
            if (tipo == "error") {
                toastr["error"](mensaje, titulo);
            } else if (tipo == "success") {
                toastr["success"](mensaje, titulo);
            } else if (tipo == "info") {
                toastr["info"](mensaje, titulo);
            } else if (tipo == "warning") {
                toastr["warning"](mensaje, titulo);
            }
        },
}
})();

function validaNumericos(event, tipo,obj=null) {
    if (tipo == "N") {
        if (
            (event.charCode >= 48 && event.charCode <= 57) ||
            event.charCode == 107
        ) {
            return true;
        }
    }
    if (tipo == "P"){
        if (event.charCode >= 48 && event.charCode <= 57){
            return true;
        }
    }
    if (tipo == "D"){
        if (
            (event.charCode >= 48 && event.charCode <= 57) ||
            (event.charCode == 46 && !obj.includes("."))) {
            return true;
        }
    }
    return false;
}
