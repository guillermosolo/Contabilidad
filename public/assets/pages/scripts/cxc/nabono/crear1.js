$("#ven_empresa").on("change", function (event) {
    $("#ven_empresa").next(".select2-container").show();
       if ($(this).val() == 1) {
        $('label[for="ven_iiud"]').hide();
        $("#ven_iiud").hide();
        $('label[for="ven_fechaCert"]').hide();
        $("#ven_fechaCert").hide();
        $('div[for="ven_fechaCert"]').hide();
        $("#ven_fechaCert").hide();
        $('label[for="ven_serie"]').hide();
        $("#ven_serie").val("1");
        $("#ven_serie").hide();
        $('label[for="ven_numDoc"]').hide();
        $("#ven_numDoc").val("1");
        $("#ven_numDoc").hide();

    } else if ($(this).val() ==2) {
        $('label[for="ven_iiud"]').hide();
        $("#ven_iiud").hide();
        $('label[for="ven_fechaCert"]').hide();
        $("#ven_fechaCert").hide();
        $('div[for="ven_fechaCert"]').hide();
        $("#ven_fechaCert").hide();
        $('label[for="ven_serie"]').hide();
        $("#ven_serie").hide();
        $('label[for="ven_numDoc"]').hide();
        $("#ven_numDoc").hide();

    } else if ($(this).val() == 3) {
        $('label[for="ven_iiud"]').hide();
        $("#ven_iiud").hide();
        $('label[for="ven_fechaCert"]').hide();
        $("#ven_fechaCert").hide();
        $('div[for="ven_fechaCert"]').hide();
        $("#ven_fechaCert").hide();

    } else if ($(this).val() ==7) {
        $('label[for="ven_iiud"]').hide();
        $("#ven_iiud").hide();
        $('label[for="ven_fechaCert"]').hide();
        $("#ven_fechaCert").hide();
        $('div[for="ven_fechaCert"]').hide();
        $("#ven_fechaCert").hide();

    }else if ($(this).val()) {
        $('label[for="ven_iiud"]').show();
        $("#ven_iiud").show();
        $('label[for="ven_fechaCert"]').show();
        $("#ven_fechaCert").show();
        $('div[for="ven_fechaCert"]').show();
        $("#ven_fechaCert").show();
        $('label[for="ven_serie"]').show();
        $("#ven_serie").show();
        $('label[for="ven_numDoc"]').show();
        $("#ven_numDoc").show();

    }
});


$(function () {
    Contabilidad.validacionGeneral("form-general");

    $(".select2").select2({
        language: "es",
        theme: "bootstrap4",
    });
    $("input[type='number']").inputSpinner();


    const empCod = $("#empCod").val();
    const terCod = $("#terCod").val();
    const cliCod = $("#cliCod").val();
    if (empCod != "") {
        const emp = $("#empPath").val() + "/" + empCod + "/Auth";
        const cta = $("#notPath").val();
        const cliCod = $("#cliCod").val();

        llenarTer(emp, terCod);
        llenarFactura(cta, terCod,cliCod);
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
        const terCod = $("#terCod").val();

        llenarTer(emp, terCod);

    });

$("#ven_persona").on("change", function (event) {
    $("#cliCod").val($(this).val());
    const terCod = $("#ctaCod").val();
    const cta = $("#notPath").val();
    const cliCod = $("#cliCod").val();
    llenarFactura(cta, terCod, cliCod);
});

$("#abf_referencia").on("change", function (event) {
    ct = $("#UUID").val($("#abf_referencia option:selected").data("UUID"));
    $("#SERIE").val($("#abf_referencia option:selected").data("SERIE"));
    $("#NUMDOC").val($("#abf_referencia option:selected").data("NUMDOC"));
    $("#FECHACERT").val($("#abf_referencia option:selected").data("FECHACERT"));
    $("#ven_total").val($("#abf_referencia option:selected").data("TOTAL"));
    $("#ven_tipoCambio").val(
        $("#abf_referencia option:selected").data("TIPOCAMBIO")
    );
    $("#ven_moneda").val($("#abf_referencia option:selected").data("MONEDA"));
});
    $("#ven_terminal").on("change", function (event) {
        $("#terCod").val($(this).val());
        const terCod = $("#ctaCod").val();
        const cta = $("#notPath").val();
        const cliCod = $("#cliCod").val();
        llenarFactura(cta, terCod, cliCod);

    });

    $("#abf_referencia").on("change", function (event){
    ct= $("#UUID").val($("#abf_referencia option:selected").data('UUID'));
    $("#SERIE").val($("#abf_referencia option:selected").data('SERIE'));
    $("#NUMDOC").val($("#abf_referencia option:selected").data('NUMDOC'));
    $("#FECHACERT").val($("#abf_referencia option:selected").data('FECHACERT'));
    $("#ven_total").val($("#abf_referencia option:selected").data('TOTAL'));
    $("#ven_tipoCambio").val($("#abf_referencia option:selected").data('TIPOCAMBIO'));
    $("#ven_moneda").val($("#abf_referencia option:selected").data('MONEDA'));

    });

    var mostrarValor = function(x) {
        document.getElementById('cliente').value=x;
    }


    function PasarValor()
    {
    document.getElementById("uuid").value = document.getElementById("UUID").value;
    document.getElementById("fechacert").value = document.getElementById("FECHACERT").value;
    document.getElementById("serie").value = document.getElementById("SERIE").value;
    document.getElementById("numdoc").value = document.getElementById("NUMDOC").value;
    document.getElementById("total").value = document.getElementById("TOTAL").value;
    document.getElementById("tipoCambio").value = document.getElementById("TIPOCAMBIO").value;
    document.getElementById("moneda").value = document.getElementById("MONEDA").value;

    }



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

function llenarFactura(path, cuenta) {

    emp = $("#ven_empresa").val();
    ter= $("#ven_terminal").val();
    cli= $("#ven_persona").val();


    path = path + "/" + emp + "/"+ ter + "/"+ cli + "/";
    $("#abf_referencia").empty();
    $.get(path, function (response) {
        for (const i in response) {
            if (response[i].ven_moneda == 1)
                moneda = "Q";
            else
                moneda = "$";
            $("#abf_referencia").append(
                $("<option>", {
                    value: response[i].ven_id,

                    text:
                        response[i].ven_serie +
                        " - " +
                        response[i].ven_numDoc +
                        " - " +
                        moneda  +
                        " - " +
                        response[i].ven_total,
                    data: {
                        UUID: response[i].ven_iiud,
                        SERIE: response[i].ven_serie,
                        NUMDOC: response[i].ven_numDoc,
                        FECHACERT: response[i].ven_fechaCert,
                        TIPOCAMBIO: response[i].ven_tipoCambio,
                        TOTAL: response[i].ven_total,
                        MONEDA: response[i].ven_moneda,


                      }}));
        }
        $("#UUID").val($("#abf_referencia option:selected").data('UUID'));
        $("#SERIE").val($("#abf_referencia option:selected").data('SERIE'));
        $("#NUMDOC").val($("#abf_referencia option:selected").data('NUMDOC'));
        $("#FECHACERT").val($("#abf_referencia option:selected").data('FECHACERT'));
        $("#ven_total").val($("#abf_referencia option:selected").data('TOTAL'));
        $("#ven_tipoCambio").val($("#abf_referencia option:selected").data('TIPOCAMBIO'));
        $("#ven_moneda").val($("#abf_referencia option:selected").data('MONEDA'));

    });
}




