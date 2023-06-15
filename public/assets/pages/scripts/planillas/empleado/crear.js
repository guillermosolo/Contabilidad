$("input[data-bootstrap-switch]").each(function() {
    $(this).bootstrapSwitch("state", $(this).prop("checked"));
});

$(function () {
    Contabilidad.validacionGeneral('form-general');
    Contabilidad.validacionGeneral('form-ext');
    $(".select2").select2({
        language: "es",
        theme: "bootstrap4",
    });
    $("#empl_sexo").select2({
        language: "es",
        theme: "bootstrap4",
    });
    $("#idiomas").select2({
        language: "es",
        theme: "bootstrap4",
    });
    $('select[data-select2-id]').on('select2:opening', function (e) {
        if( $(this).attr('readonly') == 'readonly') {
            console.log( 'can not open : readonly' );
            e.preventDefault();
            $(this).select2('close');
            return false;
        }
    });

    const empCod = $("#empCod").val();
    const terCod = $("#terCod").val();
    const muniCod = $("#muniCod").val();
    const idEmpl = $("#idEmpl").val();

    if (empCod != "") {
        const emp = $("#empPath").val() + "/" + empCod + "/Auth";
        llenarTer(emp, terCod);
    }
    if (muniCod != "") {
        const muni = $("#muniPath").val() + "/" + muniCod;
        llenar(muni, muniCod);
    }
    // if (idEmpl != "") {
    //     const idioma = $("#idiomaPath").val() + "/" + idEmpl;
    //     llenarIdioma(idioma, idEmpl);
    // }

    $('#empl_inicio').daterangepicker({
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
    $('#empl_retiro').daterangepicker({
        "singleDatePicker": true,
        "showDropdowns": true,
        "showWeekNumbers": true,
        "autoApply": false,
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
    let val = $("#empl_retiro");
    val.val('');
    val.focusout( function (){
        $("#empl_retiro").val('')
    });
    $('#empl_fecNac').daterangepicker({
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

$("#empl_departamento").on('change', function (event) {
    const muni = $("#muniPath").val() + "/" + event.target.value;
    const muniCod = $("#muniCod").val();
    llenar(muni, muniCod);
});

$("#prod_empresa").on("change", function (event) {
    const emp = $("#empPath").val() + "/" + event.target.value + "/Auth";
    llenarTer(emp, terCod);

});

function llenarTer(empresa, terminal) {
    var selected = "";
    $.get(empresa, function (response) {
        var i = 0;
        $("#prod_terminal").empty();
        for (const i in response) {
            if (response[i].ter_id == terminal) {
                selected = " selected";
            } else {
                selected = "";
            }
            $("#prod_terminal").append(
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
function llenarIdioma(idioma, idEmpl) {
    var selected = "";
    $.get(idioma, function (response) {
        var i = 0;
        $("#idiomas").empty();
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
function setIdioma(){
    $('#empl_idiomas').val($('#idiomas').val())
}
function setNit(){
    if (!($('#empl_docID').val())){
        $('#empl_docID').val('N/A')
    }
    if (!($('#empl_NIT').val())){
        $('#empl_NIT').val('CF')
    }
}
