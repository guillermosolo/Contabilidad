$("input[type='number']").inputSpinner();

$(function () {
    Contabilidad.validacionGeneral("form-general");

        porcentaje = $("#act_categoria").find(":selected").data("porcentaje");
        porcentaje = porcentaje * 100;
        $("#act_porcentaje").val(porcentaje);
        $("#act_porcentaje").attr("max", porcentaje);

        $(".select2").select2({
            language: "es",
            theme: "bootstrap4",
        });

        const empCod = $("#empCod").val();
        const terCod = $("#terCod").val();
        const depCod = $("#depCod").val();
        const acuCod = $("#acuCod").val();
        if (empCod != "") {
            const emp = $("#empPath").val() + "/" + empCod + "/Auth";
            const cta = $("#ctaPath").val();
            const ctaAcum = $("#ctaPathAcum").val();
            llenarTer(emp, terCod);
            llenarCtaDep(cta, depCod);
            llenarCtaDepAcum(ctaAcum, acuCod);
        }
});

$("#act_empresa").on("change", function (event) {
    if ($("#act_depreciar").is(":checked")) {
        $("#empCod").val($(this).val());
        const emp = $("#empPath").val() + "/" + event.target.value + "/Auth";
        const terCod = $("#terCod").val();
        const ctaAcum = $("#ctaPathAcum").val();
        llenarTer(emp, terCod);
        llenarCtaDepAcum(ctaAcum, terCod);
    }
});

$("#act_terminal").on("change", function (event) {
    if ($("#act_depreciar").is(":checked")) {
        $("#terCod").val($(this).val());
        const terCod = $("#ctaCod").val();
        const cta = $("#ctaPath").val();
        if ($(this).val() != null) {
            llenarCtaDep(cta, terCod);
        }
    }
});

$("#act_categoria").on("change", function (event) {
    if ($("#act_depreciar").is(":checked")) {
        porcentaje = $(this).find(":selected").data("porcentaje");
        porcentaje = porcentaje * 100;
        $("#act_porcentaje").val(porcentaje);
        $("#act_porcentaje").attr("max", porcentaje);
    }
});

$("#act_status").on("change", function (event) {
    if ($(this).find(":selected").data("baja") == 1) {
        $("#act_fechaBaja").attr("required", true);
        $('label[for="act_fechaBaja"]').addClass("requerido");
    } else {
        $("#act_fechaBaja").attr("required", false);
        $('label[for="act_fechaBaja"]').removeClass("requerido");
    }
});

$("#act_propio").on("change", function (event) {
    if ($(this).is(":checked")) {
        $("#act_depreciar").prop("checked", false);
        $("#act_depreciar").attr("disabled", true);
        $("#act_depreciar").trigger("change", event);
    } else {
        $("#act_depreciar").attr("disabled", false);
        $("#act_depreciar").prop("checked", true);
        $("#act_depreciar").trigger("change", event);
    }
});

$("#act_depreciar").on("change", function (event) {
    if ($(this).is(":checked")) {
        porcentaje = $("#act_categoria").find(":selected").data("porcentaje");
        porcentaje = porcentaje * 100;
        $("#act_porcentaje").val(porcentaje);
        $("#act_porcentaje").attr("max", porcentaje);
        const ctaAcum = $("#ctaPathAcum").val();
        llenarCtaDepAcum(ctaAcum, terCod);
        const cta = $("#ctaPath").val();
        if ($("#act_terminal").val() != null) {
            llenarCtaDep(cta, terCod);
        }
        $("#act_cuentaDep").next(".select2-container").show();
        $("#act_cuentaDepAcum").next(".select2-container").show();
        $('label[for="act_cuentaDep"]').show();
        $('label[for="act_cuentaDepAcum"]').show();
    } else {
        $("#act_cuentaDep").empty();
        $("#act_cuentaDep").append("<option value='1' selected></option>");
        $("#act_cuentaDepAcum").empty();
        $("#act_cuentaDepAcum").append("<option value='1' selected></option>");
        $("#act_cuentaDep").next(".select2-container").hide();
        $("#act_cuentaDepAcum").next(".select2-container").hide();
        $('label[for="act_cuentaDep"]').hide();
        $('label[for="act_cuentaDepAcum"]').hide();
        $("#act_porcentaje").val(0);
        $("#act_porcentaje").attr("max", 0);
    }
});

function llenarTer(empresa, terminal) {
    var selected = "";
    $.get(empresa, function (response) {
        var i = 0;
        $("#act_terminal").empty();
        for (const i in response) {
            if (response[i].ter_id == terminal) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#act_terminal").append(
                "<option value='" +
                    response[i].ter_id +
                    "' " +
                    selected +
                    ">" +
                    response[i].ter_nombre +
                    "</option>"
            );
        }
        if(!terminal){
            $("#act_terminal").val(null).trigger("change");}
    });
}

function llenarCtaDep(path, cuenta) {
    emp = $("#empCod").val();
    ter = $("#terCod").val();
    nivel1 = "5";
    path = path + "/" + emp + "/" + ter + "/" + nivel1 + "/1";
    $("#act_cuentaDep").empty();
    $("#act_cuentaDep").append("<option value=''></option>");
    $.get(path, function (response) {
        for (const i in response) {
            if (response[i].cta_id == cuenta) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#act_cuentaDep").append(
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

function llenarCtaDepAcum(path, cuenta) {
    emp = $("#act_empresa").val();
    path = path + "/" + emp + "/1";
    $("#act_cuentaDepAcum").empty();
    $("#act_cuentaDepAcum").append("<option value=''></option>");
    $.get(path, function (response) {
        for (const i in response) {
            if (response[i].cta_id == cuenta) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#act_cuentaDepAcum").append(
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
