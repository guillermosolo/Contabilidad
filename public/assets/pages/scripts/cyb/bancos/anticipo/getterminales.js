$(function() {
    Contabilidad.validacionGeneral('form-general');

    $(".select2").select2({
        language: "es",
        theme: "bootstrap4"
    });

    $("#inputcuentabancaria").select2({
        language: "es",
        theme: "bootstrap4"
    });

    const codigocuenta = $("#codigocuenta").val();
    const codigoterminal = $("#codigoterminal").val();

    if (codigocuenta != "") {
        const path = $("#empPath").val() + "/" + codigocuenta + "/Auth";
        llenarTer(path, codigoterminal);
    }

});

$("#inputcuentabancaria").on("change", function (event) {
    const path = $("#empPath").val() + "/" + event.target.value + "/Auth";
    TerminalesCuentaBancariaAuth(path, codigoterminal);
});

function TerminalesCuentaBancariaAuth(path, terminales) {
    var selected = "";
    $.get(path, function (response) {
        var i = 0;
        $("#inputterminal").empty();
        for (const i in response) {
            if (response[i].ter_id == terminales) {
                selected = " selected";
            } else {
                selected = "";
            }
            $("#inputterminal").append(
                "<option value='" + response[i].ter_id + "' " + selected + ">" + response[i].ter_nombre + "</option>"
            );
        }
    });

}
