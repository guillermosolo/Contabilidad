$(function () {
    Contabilidad.validacionGeneral("form-general");

    $(".select2").select2({
        language: "es",
        theme: "bootstrap4",
    });

    $("#tipoCombustible").next(".select2-container").hide();

    $("input[type='number']").inputSpinner();

    $("#facturaActivo").next(".select2-container").hide();
    $('label[for="facturaActivo"]').hide();

    const empCod = $("#empCod").val();
    const terCod = $("#terCod").val();
    if (empCod != "") {
        const emp = $("#empPath").val() + "/" + empCod + "/Auth";
        const cta = $("#ctaPath").val();
        llenarTer(emp, terCod);
        llenarCtaCon(cta, terCod);
    }

    $("#poim_fecha").daterangepicker({
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

$("#poim_descripcion").on("change", function (event) {
    $("#descripcion").val($(this).val());
});

$("#poim_moneda").on("change", function (event) {
    $(".rotMoneda").empty();
    $(".rotMoneda").append(
        "(" + $("#poim_moneda option:selected").data("simbolo") + ")"
    );
    if ($(this).val() == 1) {
        $("label[for=poim_tipoCambio]").prop("hidden", true);
        $("#poim_tipoCambio").prop("hidden", true);
        $("#poim_tipoCambio").val("1");
    } else {
        $("label[for=poim_tipoCambio]").prop("hidden", false);
        $("#poim_tipoCambio").prop("hidden", false);
        $("#poim_tipoCambio").val("");
    }
});

$("#poim_empresa").on("change", function (event) {
    const emp = $("#empPath").val() + "/" + event.target.value + "/Auth";
    const terCod = $("#terCod").val();
    llenarTer(emp, terCod);
});

$("#poim_terminal").on("change", function (event) {
    $("#terCod").val($(this).val());
    const terCod = $("#ctaCod").val();
    const cta = $("#ctaPath").val();
    if ($(this).val() != null) {
        llenarCtaCon(cta, terCod);
    }
});

$("#impActivo").on("change", function (event) {
    const terCod = $("#ctaCod").val();
    const cta = $("#ctaPath").val();
    llenarCtaCon(cta, terCod);
});

$("#impGasto").on("change", function (event) {
    const terCod = $("#ctaCod").val();
    const cta = $("#ctaPath").val();
    llenarCtaCon(cta, terCod);
});

$("#agregar").on("click", function () {
    error = 0;
    if ($("#descripcion").val() == "") {
        $("#descripcion").addClass("is-invalid");
        $("label[for='descripcion']").addClass("text-danger");
        error = 1;
    }
    if ($("#cantidad").val() == "") {
        $("#cantidad").addClass("is-invalid");
        $("label[for='cantidad']").addClass("text-danger");
        error = 1;
    }
    if ($("#fob").val() == "") {
        $("#fob").addClass("is-invalid");
        $("label[for='fob']").addClass("text-danger");
        error = 1;
    }
    if ($("#tipoGasto").find(":selected").length == 0) {
        $("#tipoGasto").addClass("is-invalid");
        $("label[for='tipoGasto']").addClass("text-danger");
        error = 1;
    }
    if ($("#flete").val() == "") {
        $("#flete").addClass("is-invalid");
        $("label[for='flete']").addClass("text-danger");
        error = 1;
    }
    if ($("#seguro").val() == "") {
        $("#seguro").addClass("is-invalid");
        $("label[for='seguro']").addClass("text-danger");
        error = 1;
    }
    if ($("#iva").val() == "") {
        $("#iva").addClass("is-invalid");
        $("label[for='iva']").addClass("text-danger");
        error = 1;
    }

    if (error == 0) {
        $("#submit").removeClass("disabled");
        cant = $("#cantidad").val();
        desc = $("#descripcion").val();
        fob = $("#fob").val();
        flete = $("#flete").val();
        seguro = $("#seguro").val();
        iva = $("#iva").val();
        vtG = $("#tipoGasto option:selected").val();
        stG = $("#tipoGasto option:selected").text();
        linea = $("#linea").val();
        linea = +linea + 1;
        $("#linea").val(linea);
        tfob = $("#poim_FOB").val();
        tflete = $("#poim_flete").val();
        tseguro = $("#poim_seguro").val();
        tiva = $("#poim_IVA").val();
        tfob = +tfob + +fob;
        tflete = +tflete + +flete;
        tseguro = +tseguro + +seguro;
        tiva = +tiva + +iva;
        gt = +fob + +flete + +seguro + +iva;
        $("#poim_FOB").val(tfob);
        $("#poim_flete").val(tflete);
        $("#poim_seguro").val(tseguro);
        $("#poim_IVA").val(tiva);
        $("#detCompra").append(`<tr id="tr-${linea}">
                            <td>
                            <input type="hidden" name="detCantidad[]" value="${cant}">
                            <input type="hidden" name="detDescripcion[]" value="${desc}">
                            <input type="hidden" name="detfob[]" value="${fob}">
                            <input type="hidden" name="detflete[]" value="${flete}">
                            <input type="hidden" name="detseguro[]" value="${seguro}">
                            <input type="hidden" name="detiva[]" value="${iva}">
                            <input type="hidden" name="tipoGasto[]" value="${vtG}">
                            </td>
                            <td>${cant}</td>
                            <td>${desc}</td><td>${gt}</td><td>${stG}</td>
                            <td><button type="button" class="btn-sm btn-danger" onclick="eliminar_insumo(${linea},${fob},${flete},${seguro},${iva})">
                            <i class="far fa-trash-alt"></button></td>
                            </tr>
    `);
    }
});

function eliminar_insumo(linea, fob, flete, seguro, iva) {
    gt = $("#poim_FOB").val();
    gt = +gt - +fob;
    $("#poim_FOB").val(gt);
    gt = $("#poim_flete").val();
    gt = +gt - +flete;
    $("#poim_flete").val(gt);
    gt = $("#poim_seguro").val();
    gt = +gt - +seguro;
    $("#poim_seguro").val(gt);
    gt = $("#poim_IVA").val();
    gt = +gt - +iva;
    $("#poim_IVA").val(gt);
    $("#tr-" + linea).remove();
}

function llenarTer(empresa, terminal) {
    var selected = "";
    $.get(empresa, function (response) {
        var i = 0;
        $("#poim_terminal").empty();
        for (const i in response) {
            if (response[i].ter_id == terminal) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#poim_terminal").append(
                "<option value='" +
                    response[i].ter_id +
                    "' " +
                    selected +
                    ">" +
                    response[i].ter_nombre +
                    "</option>"
            );
        }
        if (terminal.length == 0)
            $("#poim_terminal").val(null).trigger("change");
    });
}

function llenarCtaCon(path, cuenta) {
    if ($("#impActivo").is(":checked")) {
        nivel1 = "[1]";
    }
    if ($("#impGasto").is(":checked")) {
        nivel1 = "[5-7]";
    }
    emp = $("#poim_empresa").val();
    ter = $("#poim_terminal").val();
    path = path + "/" + emp + "/" + ter + "/" + nivel1 + "/1";
    $("#tipoGasto").empty();
    $.get(path, function (response) {
        for (const i in response) {
            if (response[i].cta_id == cuenta) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#tipoGasto").append(
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
