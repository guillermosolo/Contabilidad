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
    if (terCod != "") {
        const path = $("#empleadoPath").val()+"/"+$("#empresa").val() + "/" + terCod +'/M';
        llenarEmpleados(path, $("#empleadoCod").val());
    }
    $('#ree_fecha').daterangepicker({
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

$("#empresa").on("change", function (event) {
    const emp = $("#empPath").val() + "/" + event.target.value + "/Auth";
    llenarTer(emp, terCod);

});
$("#terminal").on("change", function (event) {
    const path = $("#empleadoPath").val()+"/"+$("#empresa").val() + "/" + event.target.value+'/M' ;
    llenarEmpleados(path, $("#empleadoCod").val());
});

function llenarTer(empresa, terminal) {
    var selected = "";
    $.get(empresa, function (response) {
        var i = 0;
        $("#terminal").empty();
        $("#terminal").append(
            "<option value=''></option>"
        );
        for (const i in response) {
            if (response[i].ter_id == terminal) {
                selected = " selected";
            } else {
                selected = "";
            }
            $("#terminal").append(
                "<option value='" + response[i].ter_id + "' " + selected + ">" + response[i].ter_nombre + "</option>"
            );
        }
    });
}
function llenarEmpleados(path, empleado) {
    var selected = "";
    $.get(path, function (response) {
        var i = 0;
        $("#ree_empleado").empty();
        for (const i in response) {
            if (response[i].empl_id == empleado) {
                selected = " selected";
            } else {
                selected = "";
            }
            $("#ree_empleado").append(
                "<option value='' ></option>"
            );
            $("#ree_empleado").append(
                "<option value='" + response[i].empl_id + "' " + selected + ">" + response[i].empl_nom1 + '  ' + response[i].empl_nom2 + '  ' + response[i].empl_ape1 + '  ' + response[i].empl_ape2 +' '+ (response[i].empl_codigo==="null"?response[i].empl_codigo:'') + " </option>"
            );
        }
    });
}
