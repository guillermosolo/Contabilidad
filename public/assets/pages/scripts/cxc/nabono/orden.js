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
    let detv_producto = $("#detv_producto option:selected").val();
    let detv_producto_text = $("#detv_producto option:selected").text();
    let detv_precioU = $("#detv_precioU").val();
    let detv_cantidad = $("#detv_cantidad").val();
    var subtotaldetalle = $("#detv_precioU").val() * $("#detv_cantidad").val();
    var iva = subtotaldetalle * 0.12;
    var totald = (subtotaldetalle + iva);
    var totalq = totald * $("#ven_tipoCambio").val();

    linea = $("#linea").val();
    linea = +linea + 1;
    $("#linea").val(linea);


    ct = $("#totalcontenedores").val();
    ct = +ct + +detv_cantidad;
    $("#totalcontenedores").val(ct);

    tiva = $("#totaliva").val();
    tiva = +tiva + +iva;
    $("#totaliva").val(tiva);

    tsiva = $("#totalsiniva").val();
    tsiva = +tsiva + +subtotaldetalle;
    $("#totalsiniva").val(tsiva);

    totaltdd = $("#totaldolar").val();
    totaltdd= +totaltdd + +totald;
    $("#totaldolar").val(totaltdd);


    totaltqq = $("#totalquetzal").val();
    totaltqq= +totaltqq + +totalq;
    $("#totalquetzal").val(totaltqq);


    if (detv_cantidad > 0 && detv_precioU > 0) {
        $("#tblInsumos").append(`
                <tr id="tr-${detv_producto}">
                    <td>
                        <input type="hidden" name="detv_producto[]" value="${detv_producto}"/>
                        <input type="hidden" name="detv_cantidad[]" value="${detv_cantidad}"/>
                        <input type="hidden" name="detv_precioU[]" value="${detv_precioU}"/>
                        <input type="hidden" name="subtotaldetlle[]" value="${subtotaldetalle}"/>
                        <input type="hidden" name="iva[]" value="${iva}"/>
                        <input type="hidden" name="totald[]" value="${totald}"/>
                        <input type="hidden" name="totalq[]" value="${totalq}"/>
                        ${detv_producto_text}
                    </td>
                    <td>${detv_cantidad}</td>
                    <td>${detv_precioU}</td>
                    <td>${subtotaldetalle.toFixed(2)}</td>
                    <td>${iva.toFixed(2)}</td>
                    <td>${totald.toFixed(2)}</td>
                    <td>${totalq.toFixed(2)}</td>
                    <td><button type="button" class="btn-danger" onclick="eliminar_insumo(${detv_producto},
                     ${detv_precioU},${subtotaldetalle}, ${iva}, ${totald}, ${totalq})">
                     <i class="far fa-trash-alt"></button></td>
                </tr>
            `);

    }
}

function eliminar_insumo(dof_producto) {

    let detv_cantidad = $("#detv_cantidad").val();
    var subtotaldetalle = $("#detv_precioU").val() * $("#detv_cantidad").val();
    var iva = subtotaldetalle * 0.12;
    var totald = subtotaldetalle + iva;
    var totalq = totald * $("#ven_tipoCambio").val();

    ct = $("#totalcontenedores").val();
    ct = +ct -+detv_cantidad;
    $("#totalcontenedores").val(ct);

    tiva = $("#totaliva").val();
    tiva = +tiva - +iva;
    $("#totaliva").val(tiva);

    tsiva = $("#totalsiniva").val();
    tsiva = +tsiva - +subtotaldetalle;
    $("#totalsiniva").val(tsiva);

    totaltdd = $("#totaldolar").val();
    totaltdd= +totaltdd - +totald;
    $("#totaldolar").val(totaltdd);


    totaltqq = $("#totalquetzal").val();
    totaltqq= +totaltqq - +totalq;
    $("#totalquetzal").val(totaltqq);

    $("#tr-" + dof_producto).remove();

}

