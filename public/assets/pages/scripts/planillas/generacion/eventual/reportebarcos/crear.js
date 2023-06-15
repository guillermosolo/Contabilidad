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

    $('#retb_fecha').daterangepicker({
        "singleDatePicker": false,
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
    if (terCod != "") {
        let [from, to] = $("#retb_fecha").val().split(' / ');
        const path = $("#planillaPath").val() + "/" + empCod + "/" + terCod + "/" + moment(from, 'DD-MM-YYYY').valueOf() + ',' + moment(to, 'DD-MM-YYYY').valueOf();
        llenarPlanilla(path, plaCod);
        const pathEmpleado = $("#empleadoPath").val() + "/" + empCod + "/" + terCod + '/T'
        llenarEmpleados(pathEmpleado, $("#empleadoCod").val());
    }
});

$("#retb_empresa").on("change", function (event) {
    const emp = $("#empPath").val() + "/" + event.target.value + "/Auth";
    llenarTer(emp, terCod);

});
$("#retb_terminal").on("change", function (event) {
    let empresa = $("#retb_empresa").val();
    let [from, to] = $("#retb_fecha").val().split(' / ');
    const path = $("#planillaPath").val() + "/" + empresa + "/" + event.target.value + "/" + moment(from, 'DD-MM-YYYY').valueOf() + ',' + moment(to, 'DD-MM-YYYY').valueOf();
    llenarPlanilla(path, $("#planillaCod").val());
    llenarEmpleados($("#empleadoPath").val() + "/" + empresa + "/" + event.target.value + '/T');
});

$("#retb_fecha").on("change", function (event) {

    let [from, to] = $("#retb_fecha").val().split(' / ');
    const path = $("#planillaPath").val() + "/" + $("#retb_empresa").val() + "/" + $("#retb_terminal").val() + "/" + moment(from, 'DD-MM-YYYY').valueOf() + ',' + moment(to, 'DD-MM-YYYY').valueOf();
    llenarPlanilla(path, $("#planillaCod").val());

});

function llenarTer(empresa, terminal) {
    var selected = "";
    $.get(empresa, function (response) {
        var i = 0;
        $("#retb_terminal").empty();
        $("#retb_terminal").append(
            "<option value=''></option>"
        );
        for (const i in response) {
            if (response[i].ter_id == terminal) {
                selected = " selected";
            } else {
                selected = "";
            }
            $("#retb_terminal").append(
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
        $("#retb_planilla").empty();

        for (const i in response) {
            if (response[i].pla_id == planilla) {
                selected = " selected";
            } else {
                selected = "";
            }
            $("#retb_planilla").append(
                "<option value=''></option>"
            );
            $("#retb_planilla").append(
                "<option value='" + response[i].pla_id + "' " + selected + ">" + response[i].pla_id +  ' - '+ response[i].pla_descripcion+"</option>"
            );
        }
    });
}

function llenarEmpleados(path, empleado) {
    var selected = "";
    $.get(path, function (response) {
        $("#retb_empleado").empty();
        for (const i in response) {
            if (response[i].empl_id == empleado) {
                selected = " selected";
            } else {
                selected = "";
            }
            $("#retb_empleado").append(
                "<option value='' ></option>"
            );
            $("#retb_empleado").append(
                "<option value='" + response[i].empl_id + "' " + selected + ">" + response[i].empl_nom1 + '  ' + response[i].empl_nom2 + '  ' + response[i].empl_ape1 + '  ' + response[i].empl_ape2 +' '+ (response[i].empl_codigo==="null"?response[i].empl_codigo:'') + " </option>"
            );
        }
    });
}

