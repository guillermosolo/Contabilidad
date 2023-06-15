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
        llenarCtaCon(cta, terCod);

    }
    });

$("#prod_empresa").on("change", function (event) {
    const emp = $("#empPath").val() + "/" + event.target.value + "/Auth";
    const ctaCod = $("#ctaCod").val();
    llenarTer(emp, terCod);
});

$("#prod_terminal").on("change", function (event) {
    $("#terCod").val($(this).val());
    const terCod = $("#ctaCod").val();
    const cta = $("#ctaPath").val();

});

function llenarTer(empresa, terminal) {
    var selected = "";
    $.get(empresa, function (response) {
        var i = 0;
        $("#prod_terminal").empty();
        for (const i in response) {
            if (response[i].ter_id == terminal) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#prod_terminal").append(
                "<option value='" +
                    response[i].ter_id +
                    "' " +
                    selected +
                    ">" +
                    response[i].ter_nombre +
                    "</option>"
            );
        }
        $("#prod_terminal").val(null).trigger("change");
    });
}


function llenarCtaCon(path, cuenta) {
    if ($("#prod_cuentacontable")) {
        nivel1 = "[4]";
    }
    emp = $("#prod_empresa").val();
    ter = $("#prod_terminal").val();
    path = path + "/" + emp + "/" + ter + "/" + nivel1 + "/1";
    $("#prod_cuentacontable").empty();

    $.get(path, function (response) {
        for (const i in response) {
            if (response[i].cta_id == cuenta) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#prod_cuentacontable").append(
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

function llenarCtaCon1(path, cuenta) {
    if ($("#prod_padre")) {
        nivel1 = "[4]";
    }
    emp = $("#prod_empresa").val();
    ter = $("#prod_terminal").val();
    path = path + "/" + emp + "/" + ter + "/" + nivel1 + "/1";
    $("#prod_padre").empty();

    $.get(path, function (response) {
        for (const i in response) {
            if (response[i].cta_id == cuenta) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#prod_padre").append(
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


