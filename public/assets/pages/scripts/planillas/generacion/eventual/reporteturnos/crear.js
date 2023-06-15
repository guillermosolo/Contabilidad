$(function () {
    Contabilidad.validacionGeneral('form-general');
    $(".select2").select2({
        language: "es",
        theme: "bootstrap4",
    });
    const empCod = $("#empCod").val();
    const terCod = $("#terCod").val();
    const plaCod = $("#planillaCod").val();

    if (empCod != "") {
        const emp = $("#empPath").val() + "/" + empCod + "/Auth";
        llenarTer(emp, terCod);
    }
    if (plaCod != "") {
        const path = $("#planillaPath").val()+"/"+$("#rept_empresa").val() + "/" + terCod+"/"+ $("#rept_fecha").val();
        llenarPlanilla(path, plaCod);
    }
    $('#rept_fecha').daterangepicker({
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

$("#rept_empresa").on("change", function (event) {
    const emp = $("#empPath").val() + "/" + event.target.value + "/Auth";
    llenarTer(emp, terCod);

});
$("#rept_terminal").on("change", function (event) {
    const path = $("#planillaPath").val()+"/"+$("#rept_empresa").val() + "/" + event.target.value+"/"+ moment($("#rept_fecha").val(), 'DD-MM-YYYY').valueOf();
    llenarPlanilla(path, $("#planillaCod").val());
});

$("#rept_fecha").on("change", function (event) {
    const path = $("#planillaPath").val()+"/"+$("#rept_empresa").val() + "/" + $("#rept_terminal").val()+"/"+ moment($("#rept_fecha").val(), 'DD-MM-YYYY').valueOf();
    llenarPlanilla(path, $("#planillaCod").val());
});
function llenarTer(empresa, terminal) {
    var selected = "";
    $.get(empresa, function (response) {
        var i = 0;
        $("#rept_terminal").empty();
        $("#rept_terminal").append(
            "<option value=''></option>"
        );
        for (const i in response) {
            if (response[i].ter_id == terminal) {
                selected = " selected";
            } else {
                selected = "";
            }
            $("#rept_terminal").append(
                "<option value='" + response[i].ter_id + "' " + selected + ">" + response[i].ter_nombre + "</option>"
            );
        }
    });
}
function llenarPlanilla(path, planilla) {
    var selected = "";
    $.get(path, function (response) {
        console.log(response)
        var i = 0;
        $("#rept_planilla").empty();
        $("#rept_planilla").append(
            "<option value=''></option>"
        );
            for (const i in response) {
            if (response[i].pla_id == planilla) {
                selected = " selected";
            } else {
                selected = "";
            }
            $("#rept_planilla").append(
                "<option value='" + response[i].pla_id + "' " + selected + ">" + response[i].pla_id +  ' - '+ response[i].pla_descripcion+"</option>"
            );
        }
    });
}
