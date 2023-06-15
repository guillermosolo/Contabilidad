$("input[type='number']").inputSpinner();

$(function () {
    Contabilidad.validacionGeneral("form-general");

    porcentaje = $("#cam_categoria").find(":selected").data("porcentaje");
    porcentaje = porcentaje * 100;
    $("#cam_porcentaje").val(porcentaje);
    $("#cam_porcentaje").attr("max", porcentaje);

    $(".select2").select2({
        language: "es",
        theme: "bootstrap4",
    });

    const empCod = $("#empCod").val();
    const terCod = $("#terCod").val();
    if (empCod != "") {
        const emp = $("#empPath").val() + "/" + empCod + "/Auth";
        const cta = $("#ctaPath").val();
        const ctaAcum = $("#ctaPathAcum").val();
        llenarTer(emp, terCod);
        llenarCtaAmort(cta, terCod);
        llenarCtaAmortAcum(ctaAcum, terCod);
    }
});

$("#cam_empresa").on("change", function (event) {
    $("#empCod").val($(this).val());
    const emp = $("#empPath").val() + "/" + event.target.value + "/Auth";
    const ctaAcum = $("#ctaPathAcum").val();
    llenarTer(emp, terCod);
    llenarCtaAmortAcum(ctaAcum, terCod);
});

$("#cam_terminal").on("change", function (event) {
        $("#terCod").val($(this).val());
        const terCod = $("#ctaCod").val();
        const cta = $("#ctaPath").val();
        if ($(this).val() != null) {
            llenarCtaAmort(cta, terCod);
        }
});

$("#cam_categoria").on("change", function (event) {
        porcentaje = $(this).find(":selected").data("porcentaje");
        porcentaje = porcentaje * 100;
        $("#cam_porcentaje").val(porcentaje);
        $("#cam_porcentaje").attr("max", porcentaje);
});

function llenarTer(empresa, terminal) {
    var selected = "";
    $.get(empresa, function (response) {
        var i = 0;
        $("#cam_terminal").empty();
        for (const i in response) {
            if (response[i].ter_id == terminal) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#cam_terminal").append(
                "<option value='" +
                    response[i].ter_id +
                    "' " +
                    selected +
                    ">" +
                    response[i].ter_nombre +
                    "</option>"
            );
        }
        $("#cam_terminal").val(null).trigger("change");
    });
}

function llenarCtaAmort(path, cuenta) {
    emp = $("#cam_empresa").val();
    ter = $("#cam_terminal").val();
    path = path + "/" + emp + "/" + ter + "/1";
    $("#cam_amort").empty();
    $("#cam_amort").append("<option value=''></option>");
    $.get(path, function (response) {
        for (const i in response) {
            if (response[i].cta_id == cuenta) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#cam_amort").append(
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

function llenarCtaAmortAcum(path, cuenta) {
    emp = $("#cam_empresa").val();
    path = path + "/" + emp + "/1";
    $("#cam_amortAcum").empty();
    $("#cam_amortAcum").append("<option value=''></option>");
    $.get(path, function (response) {
        for (const i in response) {
            if (response[i].cta_id == cuenta) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#cam_amortAcum").append(
                "<option value='" +
                    response[i].cta_id +
                    "' " +
                    selected +
                    ">" +
                    response[i].cta_codigo +
                    " - " +
                    response[i].cta_descripcion.replace("(-)", "") +
                    "</option>"
            );
        }
    });
}
