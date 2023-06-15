
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
        const cta = $("#notPath").val();
        llenarTer(emp, terCod);
        llenarCtaCon(cta, terCod);

    }

    $("#docv_fecha").daterangepicker({
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


$("#docv_empresa").on("change", function (event) {
    const emp = $("#empPath").val() + "/" + event.target.value + "/Auth";
    const terCod = $("#terCod").val();
    const cta = $("#notPath").val();
    llenarCtaCon(cta);
    llenarTer(emp, terCod);

});


$("#docv_terminal").on("change", function (event) {
    $("#terCod").val($(this).val());
        const terCod = $("#ctaCod").val();
});

function llenarTer(empresa, terminal) {
    var selected = "";
    $.get(empresa, function (response) {
        var i = 0;
        $("#docv_terminal").empty();
        for (const i in response) {
            if (response[i].ter_id == terminal) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#docv_terminal").append(
                "<option value='" +
                    response[i].ter_id +
                    "' " +
                    selected +
                    ">" +
                    response[i].ter_nombre +
                    "</option>"
            );
        }
        $("#docv_terminal").val(null).trigger("change");
    });
}

function llenarCtaCon(path, cuenta) {

    emp = $("#docv_empresa").val();

    path = path + "/" + emp + "/";
    $("#detr_factura").empty();
    $.get(path, function (response) {
        for (const i in response) {
            if (response[i].ven_id == cuenta) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#detr_factura").append(
                "<option value='" +
                    response[i].ven_id +
                    "' " +
                    selected +
                    ">" +
                    response[i].ven_serie +
                    " - " +
                    response[i].ven_numDoc +
                    " - " +
                    response[i].ven_total,

                    "</option>"
            );
        }
    });
 }
