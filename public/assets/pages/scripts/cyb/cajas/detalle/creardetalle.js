$('#inputfecha').daterangepicker({
    "singleDatePicker": true,
    "showDropdowns": true,
    "showWeekNumbers": true,
    "autoApply": true,
    "locale": {
        "format": "DD/MM/YYYY",
        "separator": " / ",
        "applyLabel": "OK",
        "cancelLabel": "Cancelar",
        "fromLabel": "Desde",
        "toLabel": "Hasta",
        "customRangeLabel": "Personalizado",
        "weekLabel": "S",
        "daysOfWeek": [
            "Do",
            "Lu",
            "Ma",
            "Mi",
            "Ju",
            "Vi",
            "Sa"
        ],
        "monthNames": [
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
            "Diciembre"
        ],
        "firstDay": 1
    },
    "linkedCalendars": false,
    "showCustomRangeLabel": false,
    "drops": "up"
});

$(function () {
    Contabilidad.validacionGeneral('form-general');

    $(".select2").select2({
        language: "es",
        theme: "bootstrap4"
    });

    $("#inputproveedor").select2({
        language: "es",
        theme: "bootstrap4"
    });

    $('select[data-select2-id]').on('select2:opening', function (e) {
        if ($(this).attr('readonly') == 'readonly') {
            console.log('can not open : readonly');
            e.preventDefault();
            $(this).select2('close');
            return false;
        }
    });

    $('#empresa').hide()
    $('#combustible').hide()

    $("#checkbox").change(function () {
        if ($('#checkbox').prop('checked')) {
            $('#combustible').show()
        } else {
            $('#combustible').hide()
        }

    });

    const empCod = $("#empCod").val();
    const codigoterminal = $("#codigoterminal").val();
    const cuenta = $("#cuentaContable").val();

    // if (empCod != "") {
    //     const emp = $("#empPath").val() + "/" + empCod + "/Auth";
    //     llenarTer(emp, codigoterminal);
    // }

    if (cuenta != "") {
        const cta = $("#ctaPath").val();
        llenarCtaCon(cta, codigoterminal, empCod, cuenta);
    }

    $("#id_teminal").on("change", function (event) {
        const cta = $("#ctaPath").val();
        if ($(this).val() != null) {
            llenarCtaCon(cta, $(this).val(), empCod, cuenta);
        }
    });

});


function llenarTer(path, terminal) {
    var selected = "";
    $.get(path, function (response) {
        var i = 0;
        $("#inputterminal").empty();
        for (const i in response) {
            if (response[i].ter_id == terminal) {
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


function llenarCtaCon(path, terminal, empresa, cuenta) {
    console.log(terminal + " " + empresa)
    path = path + "/" + empresa + "-" + terminal + "/caja" + "/1";
    let selected = ''
    $("#inputcuentacontable").empty();
    $.get(path, function (response) {
        for (const i in response) {
            if (response[i].cta_id == cuenta) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#inputcuentacontable").append(
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



