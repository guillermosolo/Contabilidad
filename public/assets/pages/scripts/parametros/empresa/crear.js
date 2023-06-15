$("input[data-bootstrap-switch]").each(function() {
    $(this).bootstrapSwitch("state", $(this).prop("checked"));
});

$(function() {
    Contabilidad.validacionGeneral('form-general');

    $(".select2").select2({
        language: "es",
        theme: "bootstrap4"
    });

    $(function () {
        bsCustomFileInput.init();
      });

      $('[data-mask]').inputmask();

    $('#emp_inicio').daterangepicker({
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
        "startDate": $('#hemp_inicio').val(),
        "minDate": "01/01/1970",
        "drops": "up"
    });


const muniCod = $("#muniCod").val();
    if (muniCod != "") {
        const muni = $("#muniPath").val() + "/" + muniCod;
        llenar(muni, muniCod);
    }
});

$("#emp_departamento").on('change', function(event) {
    const muni = $("#muniPath").val() + "/" + event.target.value;
    const muniCod = $("#muniCod").val();
    llenar(muni, muniCod);
});

function llenar(muni, muniCod) {
    var selected = "";
    $.get(muni, function(response) {
        var i = 0;
        $("#emp_municipio").empty();
        for (const i in response) {
            if (response[i].dep_id == muniCod) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#emp_municipio").append(
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

