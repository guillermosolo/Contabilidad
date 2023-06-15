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
    var iva = subtotaldetalle * 0.12;
    var totald = subtotaldetalle + iva;
    var totalq = totald * $("#ordf_tipoCambio").val();


    linea = $("#linea").val();
    linea = +linea + 1;
    $("#linea").val(linea);


    ct = $("#totalcontenedores").val();
    ct = +ct + +dof_cantidad;
    $("#totalcontenedores").val(ct);

    tiva = $("#totaliva").val();
    tiva = ((+tiva + +iva).toFixed(5));
    $("#totaliva").val(tiva);

    tsiva = $("#totalsiniva").val();
    tsiva = ((+tsiva + +subtotaldetalle).toFixed(5));
    $("#totalsiniva").val(tsiva);

    totiva = $("#civa").val();
    totiva = ((+totiva + +subtotaldetalle).toFixed(5));
    $("#civa").val(totiva);

    totaltdd = $("#totaldolar").val();
    totaltdd= ((+totaltdd + +totald).toFixed(5));
    $("#totaldolar").val(totaltdd);


    totaltqq = $("#totalquetzal").val();
    totaltqq= ((+totaltqq + +totalq).toFixed(5));
    $("#totalquetzal").val(totaltqq);

    total =$("#ordf_total").val();
    total =totaltqq;
    $("#ordf_total").val(total);



        $("#tblInsumos").append(`
                <tr id="tr-${linea}">
                    <td>
                        <input type="hidden" name="dof_producto[]" value="${dof_producto}"/>
                        <input type="hidden" name="dof_cantidad[]" value="${dof_cantidad}"/>
                        <input type="hidden" name="dof_tarifa[]" value="${dof_tarifa}"/>
                        <input type="hidden" name="subtotaldetlle[]" value="${subtotaldetalle}"/>
                        <input type="hidden" name="iva[]" value="${iva}"/>
                        <input type="hidden" name="totald[]" value="${totald}"/>
                        <input type="hidden" name="totalq[]" value="${totalq}"/>


                        ${dof_producto_text}
                    </td>
                    <td>${dof_cantidad}</td>
                    <td>${dof_tarifa}</td>
                    <td>${subtotaldetalle.toFixed(2)}</td>
                    <td>${iva.toFixed(2)}</td>
                    <td>${totald.toFixed(2)}</td>
                    <td>${totalq.toFixed(2)}</td>

                    <td><button type="button" class="btn-danger" onclick="eliminar_insumo(${linea},${dof_producto},
                     ${dof_tarifa},${subtotaldetalle}, ${iva}, ${totald}, ${totalq}, ${total})">
                     <i class="far fa-trash-alt"></button></td>
                </tr>
            `);

}



function eliminar_insumo(dof_producto) {

    let dof_cantidad = $("#dof_cantidad").val();
    var subtotaldetalle = $("#dof_tarifa").val() * $("#dof_cantidad").val();
    var iva = subtotaldetalle * 0.12;
    var totald = subtotaldetalle + iva;
    var totalq = totald * $("#ordf_tipoCambio").val();

    ct = $("#totalcontenedores").val();
    ct = +ct -+dof_cantidad;
    $("#totalcontenedores").val(ct);

    tiva = $("#totaliva").val();
    tiva = ((+tiva - +iva).toFixed(5));
    $("#totaliva").val(tiva);

    tsiva = $("#totalsiniva").val();
    tsiva = ((+tsiva - +subtotaldetalle).toFixed(5));
    $("#totalsiniva").val(tsiva);

    totaltdd = $("#totaldolar").val();
    totaltdd= ((+totaltdd - +totald).toFixed(5));
    $("#totaldolar").val(totaltdd);


    totaltqq = $("#totalquetzal").val();
    totaltqq= ((+totaltqq - +totalq).toFixed(5));
    $("#totalquetzal").val(totaltqq);

    total =$("#ordf_total").val();
    total =totaltqq;
    $("#ordf_total").val(total);

    totiva = $("#civa").val();
    totiva = ((+totiva -+subtotaldetalle).toFixed(5));
    $("#civa").val(totiva);

    $("#tr-" + dof_producto).remove();

}



