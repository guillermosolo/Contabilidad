$("input[data-bootstrap-switch]").each(function() {
    $(this).bootstrapSwitch("state", $(this).prop("checked"));
});

$(function () {
    Contabilidad.validacionGeneral("form-general");

    $(".select2").select2({
        language: "es",
        theme: "bootstrap4",
    });

    $("input[type='number']").inputSpinner();


    const empCod = $("#empCod").val();
    const terCod = $("#terCod").val();
    if (empCod != "") {
        const emp = $("#empPath").val() + "/" + empCod + "/Auth";
        const cta = $("#ctaPath").val();
        llenarTer(emp, terCod);
    }

$("#ven_empresa").on("change", function (event) {
    const emp = $("#empPath").val() + "/" + event.target.value + "/Auth";
    const ctaCod = $("#ctaCod").val();
    llenarTer(emp, terCod);
});

$("#ven_terminal").on("change", function (event) {
    $("#terCod").val($(this).val());
    const terCod = $("#ctaCod").val();
    const cta = $("#ctaPath").val();
    if ($(this).val() != null) {
        llenarCtaCon(cta, terCod);
    }
});


});

function llenarTer(empresa, terminal) {
    var selected = "";
    $.get(empresa, function (response) {
        var i = 0;
        $("#ven_terminal").empty();
        for (const i in response) {
            if (response[i].ter_id == terminal) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#ven_terminal").append(
                "<option value='" +
                    response[i].ter_id +
                    "' " +
                    selected +
                    ">" +
                    response[i].ter_nombre +
                    "</option>"
            );
        }
        $("#ven_terminal").val(null).trigger("change");
    });
}
