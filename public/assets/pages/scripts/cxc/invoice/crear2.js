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

    $("#ven_fecha").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        showWeekNumbers: true,
        autoApply: true,
        locale: {
            format: "DD/MM/YYYY",
            separator: " / ",
            applyLabel: "OK",
            cancelLabel: "Cancelar",
            fromLabel: "Desde",
            toLabel: "Hasta",
            customRangeLabel: "Personalizado",
            weekLabel: "S",
            daysOfWeek: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            monthNames: [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre",
            ],
            firstDay: 1,
        },
        linkedCalendars: false,
        showCustomRangeLabel: false,
        startDate: $("#hemp_inicio").val(),
        minDate: "01/01/1970",
        drops: "up",
    });

    $("#ven_fechaCert").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        showWeekNumbers: true,
        autoApply: true,
        locale: {
            format: "DD/MM/YYYY",
            separator: " / ",
            applyLabel: "OK",
            cancelLabel: "Cancelar",
            fromLabel: "Desde",
            toLabel: "Hasta",
            customRangeLabel: "Personalizado",
            weekLabel: "S",
            daysOfWeek: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            monthNames: [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre",
            ],
            firstDay: 1,
        },
        linkedCalendars: false,
        showCustomRangeLabel: false,
        startDate: $("#hemp_inicio").val(),
        minDate: "01/01/1970",
        drops: "up",
    });
    });

$("#ven_empresa").on("change", function (event) {
    const emp = $("#empPath").val() + "/" + event.target.value + "/Auth";
    const ctaCod = $("#ctaPath").val();
    llenarTer(emp, terCod);
    llenarCtaCon(emp,ctaCod);

});


$("#ven_terminal").on("change", function (event) {
    $("#terCod").val($(this).val());
    const terCod = $("#ctaPath").val();
    const cta = $("#ctaPath").val();
    if ($(this).val() != null) {
        llenarCtaCon(cta, terCod);

    }
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

function llenarCtaCon(path, cuenta) {

    if ($("#detv_producto")) {
        nivel1 = "[4]";
    }
    emp = $("#ven_empresa").val();
    ter = $("#ven_terminal").val();
    path = path + "/" + emp + "/" + ter + "/"+ nivel1 + "/4";
    $("#detv_producto").empty();

    $.get(path, function(response){
        for (const i in response) {
            if (response[i].prod_id == cuenta) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#detv_producto").append(
                "<option value='" +
                    response[i].prod_id +
                    "' " +
                    selected +
                    ">" +
                    response[i].prod_desc_lg +
                    "</option>"
            );

        }
    });
}


function llenarCtaCon(path, cuenta) {

    if ($("#detv_producto")) {
        nivel1 = "[4]";
    }
    emp = $("#ven_empresa").val();
    ter = $("#ven_terminal").val();
    path = path + "/" + emp + "/" + ter + "/"+ nivel1 + "/4";
    $("#detv_producto").empty();

    $.get(path, function(response){
        for (const i in response) {
            if (response[i].prod_id == cuenta) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#detv_producto").append(
                "<option value='" +
                    response[i].prod_id +
                    "' " +
                    selected +
                    ">" +
                    response[i].prod_desc_lg +
                    "</option>"
            );

        }
    });
}








