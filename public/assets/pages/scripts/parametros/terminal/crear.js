$("input[data-bootstrap-switch]").each(function() {
    $(this).bootstrapSwitch("state", $(this).prop("checked"));
});

$(function() {
    Contabilidad.validacionGeneral('form-general');

    $(".select2").select2({
        language: "es",
        theme: "bootstrap4"
    });

const muniCod = $("#muniCod").val();
    if (muniCod != "") {
        const muni = $("#muniPath").val() + "/" + muniCod;
        llenar(muni, muniCod);
    }
});

$("#ter_departamento").on('change', function(event) {
    const muni = $("#muniPath").val() + "/" + event.target.value;
    const muniCod = $("#muniCod").val();
    llenar(muni, muniCod);
});

function llenar(muni, muniCod) {
    var selected = "";
    $.get(muni, function(response) {
        var i = 0;
        $("#ter_municipio").empty();
        for (const i in response) {
            if (response[i].dep_id == muniCod) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#ter_municipio").append(
                "<option value='" +
                    response[i].dep_id +
                    "' " +
                    selected +
                    ">" +
                    response[i].dep_descripcion +
                    "</option>"
            );
        }
    });
}