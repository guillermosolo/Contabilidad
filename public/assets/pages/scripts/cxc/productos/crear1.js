$(function () {
    Contabilidad.validacionGeneral("form-general");

    $(".select2").select2({
        language: "es",
        theme: "bootstrap4",
    });
    $("input[type='number']").inputSpinner();

    const empCod = $("#empCod").val();
    const terCod = $("#terCod").val();
    if (empCod != "") {
        const emp = $("#empPath").val() + "/" + empCod + "/Auth";
        const cta = $("#ctaPath").val();
        const cta1 = $("#produPath").val();
        const cta2=  $("#productoPath").val();
        llenarTer(emp, terCod);
        llenarCtaCon(cta, terCod);
        llenarCategoria(cta1, terCod);
        llenarSubCategoria(cta2, cta1);

    }
});


$( function() {
    $("#prod_padre").change( function() {
        if ($(this).val() === "0") {
            $("#prod_codigo").prop("disabled", true);
        } else {
            $("#prod_codigo").prop("disabled", false);
        }


    $("#prod_padre1").change( function() {
        if ($(this).val() === "0") {
            $("#prod_codigo").prop("disabled", true);
        } else {
            $("#prod_codigo").prop("disabled", false);
        }
     

    $("#prod_cuentacontable").change( function() {
        if ($(this).val() === "0") {
            $("#prod_codigo").prop("disabled", true);
        } else {
            $("#prod_codigo").prop("disabled", false);
        }
    });
});
});
});


$("#prod_empresa").on("change", function (event) {
    const emp = $("#empPath").val() + "/" + event.target.value + "/Auth";
    const ctaCod = $("#ctaCod").val();
    llenarTer(emp, terCod);
});

$("#prod_terminal").on("change", function (event) {
    $("#terCod").val($(this).val());
    const terCod = $("#ctaCod").val();
    const cta = $("#ctaPath").val();
    const cta1 = $("#produPath").val();

    if ($(this).val() != null) {
        llenarCtaCon(cta, terCod);
        llenarCategoria(cta1, terCod);
    }
});


$("#prod_padre1").on("change", function (event) {
    const cta1 = $("#produPath").val();
    const cta2=  $("#productoPath").val();
    if ($(this).val() != null) {
        llenarSubCategoria(cta2, cta1);
    }
});


function llenarTer(empresa, terminal) {
    var selected = "";
    $.get(empresa, function (response) {
        var i = 0;
        $("#prod_terminal").empty();
        for (const i in response) {
            if (response[i].ter_id == terminal) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#prod_terminal").append(
                "<option value='" +
                    response[i].ter_id +
                    "' " +
                    selected +
                    ">" +
                    response[i].ter_nombre +
                    "</option>"
            );
        }
        $("#prod_terminal").val(null).trigger("change");
    });
}

function llenarCtaCon(path, cuenta) {
    if ($("#prod_cuentacontable")) {
        nivel1 = "[4]";
    }
    emp = $("#prod_empresa").val();
    ter = $("#prod_terminal").val();
    path = path + "/" + emp + "/" + ter + "/" + nivel1 + "/1";
    $("#prod_cuentacontable").empty();
    $("#prod_cuentacontable").append(' <option value="1">SIN CUENTA CONTABLE</option> ');
    $.get(path, function (response) {
        for (const i in response) {
            if (response[i].cta_id == cuenta) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#prod_cuentacontable").append(
                "<option value='" +
                    response[i].cta_id +
                    "' " +
                    selected +
                    ">" +
                    response[i].cta_codigo +
                    "  " +
                    selected +
                    " - " +
                    response[i].cta_descripcion +
                    "</option>"
            );
        }
    });
}

function llenarCategoria(path, cuenta) {
    emp = $("#prod_empresa").val();
    ter = $("#prod_terminal").val();
    path = path + "/" + emp + "/"+ ter + "/";
    $("#prod_padre1").empty();
    $("#prod_padre1").append(' <option value="0">SIN CATEGORIA</option> ');

    $.get(path, function (response) {
        for (const i in response) {
            if (response[i].prod_id == cuenta) {
                selected = "selected";
            } else {
                selected = "";
            }
            $("#prod_padre1").append(
                "<option value='" +
                    response[i].prod_id +
                    "' " +
                    selected +
                    ">" +
                    response[i].prod_desc_lg +
                    "</option>"
            );
        }

    });
}


function llenarSubCategoria(path, cuenta) {
    var selected = "";
  cta1=  $("#prod_padre1").val();
    path = path + "/" + cta1 + "/";
    $("#prod_padre").empty();
    $("#prod_padre").append(' <option value="0">SIN  SUBCATEGORIA</option> ');
    $.get(path, function (response) {
        for (const i in response) {
              $("#prod_padre").append(
                "<option value='" +
                    response[i].prod_id +
                    "' " +
                    selected +
                    ">" +
                    response[i].prod_desc_lg +
                    "</option>"
            );
        }
    });
}

