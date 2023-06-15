$(function() {
    Contabilidad.validacionGeneral('form-general');

    $("#empresa").select2({
        language: "es",
        theme: "bootstrap4",
        placeholder: "Empresa"
    });

    $("#movb_cuentacontable").select2({
        language: "es",
        theme: "bootstrap4",
        placeholder: "Cuenta Contable"
    });

    const moviCod = $("#moviCod").val();
    if (moviCod != "") {
        const movi = $("#moviPath").val() + "/" + moviCod;
        llenar(movi, moviCod);
    }
});

$("#empresa").on('change', function(event) {
    const movi = $("#moviPath").val() + "/" + event.target.value;
    const moviCod = $("#moviCod").val();
    llenar(movi, moviCod);
});

function llenar(movi, moviCod) {
    var selected = "";
    $.get(movi, function(response) {
        var i = 0;
        $("#movb_cuentacontable").empty();
        for (const i in response) {
            if (response[i].cta_id == moviCod) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#movb_cuentacontable").append(
                "<option value='" +
                    response[i].cta_id +
                    "' " +
                    selected +
                    ">" +
                    response[i].cta_descripcion +
                    "</option>"
            );
        }
    });
}
