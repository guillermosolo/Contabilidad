$("input[data-bootstrap-switch]").each(function () {
    $(this).bootstrapSwitch("state", $(this).prop("checked"));
});

$(function () {
    Contabilidad.validacionGeneral("form-general");
});
