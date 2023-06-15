$(function() {
    Contabilidad.validacionGeneral('form-general');

    $(".select2").select2({
        language: "es",
        theme: "bootstrap4"
    });

    $("#inputempleados").select2({
        language: "es",
        theme: "bootstrap4"
    });

    const empresa = $("#empresa").val();
    if(empresa!="")
    {
        llenarCtaCon($("#ctaPath").val(),empresa);
    }

    $("input[type='number']").inputSpinner();

    $('[data-mask]').inputmask();
});

$('#editar').on('change',function(){
    if ($(this).is(':checked')){
        $(".editable").prop("disabled", false);
    } else {
        $(".editable").prop("disabled", true);
    }
});

$("#inputempresa").on("change", function () {
    const cta = $("#ctaPath").val();
    if ($(this).val() != null) {
        llenarCtaCon(cta,$(this).val());
    }
});

function llenarCtaCon(path, emp) {
    path = path + "/" + emp +"/responsable"+ "/1";
    let cuenta = $("#cuentaContable").val();
    let selected = ''

    $("#inputcuentacontable").empty();
    $.get(path, function (response) {
        console.log(path)

        console.log(response)

        for (const i in response) {
            if (response[i].cta_id === cuenta) {
                selected = "selected";
            } else {
                selected = "";
            }

            $("#inputcuentacontable").append(
                "<option value='" +
                response[i].cta_id +
                "' " +
                selected +
                ">" +
                response[i].cta_codigo +
                " - " +
                response[i].cta_descripcion +
                "</option>"
            );
        }
    });
}
