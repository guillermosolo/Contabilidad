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

$("input[data-bootstrap-switch]").each(function() {
    $(this).bootstrapSwitch("state", $(this).prop("checked"));
});

$(function() {
    Contabilidad.validacionGeneral('form-general');

    $(".select2").select2({
        language: "es",
        theme: "bootstrap4"
    });

    const codigocuenta = $("#codigocuenta").val();
    const codigoterminal = $("#codigoterminal").val();

    const codigocuenta2 = $("#codigocuenta2").val();
    const codigoterminal2 = $("#codigoterminal2").val();


    if (codigocuenta != "") {
        const path = $("#empPath").val() + "/" + codigocuenta + "/Auth";
        llenarTer(path, codigoterminal);
    }

    if (codigocuenta2 != "") {
        const path2 = $("#empPath2").val() + "/" + codigocuenta2 + "/Auth";
        llenarTer(path2, codigoterminal2);
    }
    $('#tipointerno').hide()
    $('#monedacambio').hide()

    $("#inputcuentabancariadeb").change(function() {
        let prueba=$('#inputcuentabancariadeb :selected').text().split(' - ').pop()
        if(prueba==='DOLAR'){
            $('#monedacambio').show()
        }else{
            $('#monedacambio').hide()
        }
    });

    $("#inputcuentabancariadeb2").change(function() {
        let prueba=$('#inputcuentabancariadeb2 :selected').text().split(' - ').pop()
        if(prueba==='DOLAR'){
            $('#monedacambio').show()
        }else{
            $('#monedacambio').hide()
        }
    });

});

$("#inputcuentabancaria").on("change", function (event) {
    const path = $("#empPath").val() + "/" + event.target.value + "/Auth";
    llenarTer(path, codigoterminal);
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


    $("#inputcuentabancariadeb2").on("change", function (event) {
        const path2 = $("#empPath2").val() + "/" + event.target.value + "/Auth";
        llenarTer(path2, codigoterminal2);
    });


    function llenarTer(path2, terminal2) {
        var selected = "";
        $.get(path2, function (response) {
            var i = 0;
            $("#inputterminal2").empty();
            for (const i in response) {
                if (response[i].ter_id == terminal2) {
                    selected = " selected";
                } else {
                    selected = "";
                }
                $("#inputterminal2").append(
                    "<option value='" + response[i].ter_id + "' " + selected + ">" + response[i].ter_nombre + "</option>"
                );
            }
        });
    }
}
