$("#ordf_moneda").on("change", function (event) {
    $(".rotMoneda").empty();
    $(".rotMoneda").append(
        "(" + $("#ordf_moneda option:selected").data("simbolo") + ")"
    );

    if ($(this).val() == 1) {
        $("label[for=ordf_tipoCambio]").prop("hidden", true);
        $("#ordf_tipoCambio").prop("hidden", true);
        $("#ordf_tipoCambio").val("1");

    } else {
        $("label[for=dof_tipoCambio]").prop("hidden", false);
        $("#ordf_tipoCambio").prop("hidden", false);
        $("#ordf_tipoCambio").val("");
    }
});



function agregar_insumo() {

    let dof_producto = $("#dof_producto option:selected").val();
    let dof_producto_text = $("#dof_producto option:selected").text();
    let dof_tarifa = $("#dof_tarifa").val();
    let dof_cantidad = $("#dof_cantidad").val();
    var subtotaldetalle = $("#dof_tarifa").val() * $("#dof_cantidad").val();
    var iva1 = subtotaldetalle /1.12;//53.57
    var iva = subtotaldetalle-iva1;//6.43
    var totald = (iva1 + iva);//60
    var totalq = totald * $("#ordf_tipoCambio").val();




    linea = $("#linea").val();
    linea = +linea + 1;
    $("#linea").val(linea);


    ct = $("#totalcontenedores").val();
    ct = +ct + +dof_cantidad;
    $("#totalcontenedores").val(ct);

    tiva = $("#totaliva").val();
    tiva = ((+tiva + +iva1).toFixed(2));
    $("#totaliva").val(tiva);

    totiva = $("#civa").val();
    totiva = ((+totiva + +iva).toFixed(2));
    $("#civa").val(totiva);



    totaltdd = $("#totaldolar").val();
    totaltdd= ((+totaltdd + +totald).toFixed(2));
    $("#totaldolar").val(totaltdd);


    totaltqq = $("#totalquetzal").val();
    totaltqq= ((+totaltqq + +totalq).toFixed(2));
    $("#totalquetzal").val(totaltqq);

    total =$("#ordf_total").val();
    total =totaltqq;
    $("#ordf_total").val(total);

    totaliva =$("#ven_iva").val();
    totaliva =totiva;
    $("#ven_iva").val(totaliva);

    totalsiva =$("#ven_siva").val();
    totalsiva =tiva;
    $("#ven_siva").val(totalsiva);


    if (dof_cantidad > 0 && dof_tarifa > 0) {
        $("#tblInsumos").append(`
                <tr align="right"  id="tr-${dof_producto}">
                    <td >
                        <input  style="text-align:center" type="hidden" name="dof_producto[]" value="${dof_producto}"/>
                        <input   type="hidden" name="dof_cantidad[]" value="${dof_cantidad}"/>
                        <input   type="hidden" name="dof_tarifa[]" value="${dof_tarifa}"/>
                        <input   type="hidden" name="iva[]" value="${iva1}"/>
                        <input   type="hidden" name="ivac[]" value="${iva}"/>
                        <input   type="hidden" name="totald[]" value="${totald}"/>
                        <input   type="hidden" name="totalq[]" value="${totalq}"/>


                        ${dof_producto_text}
                    </td>
                    <td>${dof_cantidad}</td>
                    <td>${dof_tarifa}</td>
                    <td>${iva1.toFixed(2)}</td>
                    <td>${iva.toFixed(2)}</td>
                    <td>${totald.toFixed(2)}</td>
                    <td>${totalq.toFixed(2)}</td>

                    <td><button type="button" class="btn-danger" onclick="eliminar_insumo(${dof_producto},
                     ${dof_tarifa}, ${iva1},${iva},${totald}, ${totalq}, ${total},${totaliva},${totalsiva})">
                     <i class="far fa-trash-alt"></button></td>
                </tr>
            `);
    }
}

function eliminar_insumo(dof_producto) {

    let dof_cantidad = $("#dof_cantidad").val();
    var subtotaldetalle = $("#dof_tarifa").val() * $("#dof_cantidad").val();
    var iva1 = subtotaldetalle /1.12;//53.57
    var iva = subtotaldetalle-iva1;//6.43
    var totald = (iva1 + iva);//60
    var totalq = totald * $("#ordf_tipoCambio").val();

    ct = $("#totalcontenedores").val();
    ct = +ct - +dof_cantidad;
    $("#totalcontenedores").val(ct);

    tiva = $("#totaliva").val();
    tiva = ((+tiva - +iva1).toFixed(2));
    $("#totaliva").val(tiva);

    tsiva = $("#totalsiniva").val();
    tsiva = ((+tsiva - +subtotaldetalle).toFixed(2));
    $("#totalsiniva").val(tsiva);

    totiva = $("#civa").val();
totiva = ((+totiva - +iva).toFixed(2));
$("#civa").val(totiva);

    totaltdd = $("#totaldolar").val();
    totaltdd= ((+totaltdd - +totald).toFixed(2));
    $("#totaldolar").val(totaltdd);


    totaltqq = $("#totalquetzal").val();
    totaltqq= ((+totaltqq - +totalq).toFixed(2));
    $("#totalquetzal").val(totaltqq);


    total =$("#ordf_total").val();
    total =totaltqq;
    $("#ordf_total").val(total);

    totaliva =$("#ven_iva").val();
    totaliva =totiva;
    $("#ven_iva").val(totaliva);

    totalsiva =$("#ven_siva").val();
    totalsiva =tiva;
    $("#ven_siva").val(totalsiva);

    $("#tr-" + dof_producto).remove();

}






