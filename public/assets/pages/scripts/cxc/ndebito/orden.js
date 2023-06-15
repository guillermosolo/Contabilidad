function cambiomoneda() {
    var monedaseleccionada = document.getElementById("ven_moneda").value;
    if (monedaseleccionada !== "1") {
        document.getElementById("ven_tipoCambio").removeAttribute("readonly");
        document
            .getElementById("ven_tipoCambio")
            .setAttribute("required", "true");
    } else {
        document.getElementById("ven_tipoCambio").readOnly = true;
    }
}

function agregar_insumo() {

    var subtotaldetalle = $("#ven_total").val();//60
    var iva1 = subtotaldetalle /1.12;//53.57
    var iva = subtotaldetalle-iva1;//6.43
    var totald = (iva1 + iva);//60
    var totalq = totald * $("#ven_tipoCambio").val();

    $("#ven_siva").val("3");

}

$(function(){

    $('#ven_total').on('input', function() {
      calculate();
    });

    function calculate(){
        var pPos = parseInt($('#ven_total').val());
        var perc="";
        perc = ((pPos) /1.12).toFixed(3);
        $('#ven_siva').val(perc);

        var pPos = parseInt($('#ven_total').val());
        var perc1="";
        perc1 = ((pPos) -perc).toFixed(3);
        $('#ven_iva').val(perc1);

    }

});

