$("input[data-bootstrap-switch]").each(function () {
    $(this).bootstrapSwitch("state", $(this).prop("checked"));
});

$(function () {
    Contabilidad.validacionGeneral("form-general");
});

$("#tip_referencia").on("switchChange.bootstrapSwitch", function (event) {
    if ($(this).is(":checked")) {
        $("#accionCarga").attr("disabled", false);
        $("#accionCarga").attr("checked", true);
        $("#accionAbona").attr("disabled", false);
        $("#accionAbona").attr("checked", false);
    } else {
        $("#accionCarga").attr("disabled", true);
        $("#accionCarga").attr("checked", false);
        $("#accionAbona").attr("disabled", true);
        $("#accionAbona").attr("checked", false);
    }
});
