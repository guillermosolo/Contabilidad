$(function () {
    Contabilidad.validacionGeneral("form-general");

    $(".select2").select2({
        language: "es",
        theme: "bootstrap4",
    });

    const empCod = $("#empCod").val();
    const terCod = $("#terCod").val();
    if (empCod != "") {
        const emp = $("#empPath").val() + "/" + empCod + "/Auth";
        const cta = $("#ctaPath").val();
        llenarTer(emp, terCod);
        llenarCtaCon(cta, terCod);
    }

    $("#rec_fecha").daterangepicker({
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

$("#rec_moneda").on("change", function (event){
    if($(this).val()==1){
        $("label[for=rec_tipoCambio]").prop("hidden",true);
        $("#rec_tipoCambio").prop("hidden",true);
    }else{
        $("label[for=rec_tipoCambio]").prop("hidden",false);
        $("#rec_tipoCambio").prop("hidden",false);
        $("#rec_tipoCambio").val("1");
    }
});

$("#rec_empresa").on("change", function (event) {
    const emp = $("#empPath").val() + "/" + event.target.value + "/Auth";
    const terCod = $("#terCod").val();
    llenarTer(emp, terCod);
});

$("#rec_terminal").on("change", function (event) {
    $("#terCod").val($(this).val());
    const terCod = $("#ctaCod").val();
    const cta = $("#ctaPath").val();
    if ($(this).val() != null) {
        llenarCtaCon(cta, terCod);
    }
});


function llenarTer(empresa, terminal) {
    var selected = "";
    $.get(empresa, function (response) {
        var i = 0;
        $("#rec_terminal").empty();
        for (const i in response) {
            if (response[i].ter_id == terminal) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#rec_terminal").append(
                "<option value='" +
                    response[i].ter_id +
                    "' " +
                    selected +
                    ">" +
                    response[i].ter_nombre +
                    "</option>"
            );
        }
        if(terminal.length==0)
            $("#rec_terminal").val(null).trigger("change");
    });
}

function llenarCtaCon(path, cuenta) {
        nivel1 = "[5-7]";
    emp = $("#rec_empresa").val();
    ter = $("#rec_terminal").val();
    path = path + "/" + emp + "/" + ter + "/" + nivel1 + "/1";
    $("#rec_tipoGasto").empty();
    $.get(path, function (response) {
        for (const i in response) {
            if (response[i].cta_id == cuenta) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#rec_tipoGasto").append(
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

