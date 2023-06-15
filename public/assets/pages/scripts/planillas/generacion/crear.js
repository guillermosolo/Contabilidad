$("input[data-bootstrap-switch]").each(function() {
    $(this).bootstrapSwitch("state", $(this).prop("checked"));
});

$(function () {
    Contabilidad.validacionGeneral('form-general');
    $(".select2").select2({
        language: "es",
        theme: "bootstrap4",
    });


    const empCod = $("#empCod").val();
    const terCod = $("#terCod").val();
    if (empCod != "") {
        const emp = $("#empPath").val() + "/" + empCod + "/Auth";
        llenarTer(emp, terCod);
    }

    if ($("#pla_tipo").val()==='O'){
        $("[name='pla_liquidacion']").bootstrapSwitch('disabled',true);
    }


    $('#pla_fecha').daterangepicker({
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
});

$("#pla_tipo").on("change", function (event) {
    let button = $("[name='pla_liquidacion']");
    if ($(this).val()==='E'){
        button.bootstrapSwitch('disabled',false);
    }else{
        button.bootstrapSwitch('state', false);
        button.bootstrapSwitch('disabled',true);
    }
});

$("#pla_empresa").on("change", function (event) {
    const emp = $("#empPath").val() + "/" + event.target.value + "/Auth";
    llenarTer(emp, terCod);

});

function llenarTer(empresa, terminal) {
    var selected = "";
    $.get(empresa, function (response) {
        var i = 0;
        $("#pla_terminal").empty();
        for (const i in response) {
            if (response[i].ter_id == terminal) {
                selected = " selected";
            } else {
                selected = "";
            }
            $("#pla_terminal").append(
                "<option value='" + response[i].ter_id + "' " + selected + ">" + response[i].ter_nombre + "</option>"
            );
        }
    });
}

function llenar(muni, muniCod) {
    var selected = "";
    $.get(muni, function (response) {
        var i = 0;
        $("#empl_lugNac").empty();
        for (const i in response) {
            if (response[i].dep_id == muniCod) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#empl_lugNac").append(
                "<option value='" +
                response[i].dep_id +
                "' " +
                selected +
                ">" +
                response[i].dep_descripcion +
                "</option>"
            );
        }
    });
}
