function agregar_insumo() {
    let dpol_ctaContable = $("#dpol_ctaContable option:selected").val();
    let dpol_ctaContable_text = $("#dpol_ctaContable option:selected").text();
    let dpol_monto = $("#dpol_monto").val();
    var flexRadioDefault = $("input:radio[name=flexRadioDefault]:checked").val();

    
    
    if (flexRadioDefault == 'D') {
        $("#ddpol_monto1").val();
      

    } else if (flexRadioDefault =='H') {
        
        $("#ddpol_monto2").val();
    }


    cw = $("#debe").val();
    cw = +cw + +dpol_monto;
    $("#debe").val(cw);

    cw = $("#haber").val();
    cw = +cw + +dpol_monto;
    $("#haber").val(cw);

    linea = $("#linea").val();
    linea = +linea + 1;
    $("#linea").val(linea);

    $("#tblInsumos").append(`
                <tr id="tr-${dpol_ctaContable}">
                    <td>
                        <input type="hidden" name="dpol_ctaContable[]" value="${dpol_ctaContable}"/>
                        <input id="debe" type="hidden" name="dpol_monto[]" value="${dpol_monto}"/>
                        <input type="hidden" name="dpol_monto[]" value="${dpol_monto}"/>
                        <input type="hidden" name="flexRadioDefault[]" value="${flexRadioDefault}"/>
                        ${dpol_ctaContable_text}
                    </td>
                    <td>${dpol_monto}</td>
                    <td></td>
                    <td><button type="button" class="btn-danger" onclick="eliminar_insumo(${dpol_ctaContable},${dpol_monto})">
                     <i class="far fa-trash-alt"></button></td>
                </tr>
            `);


             
}

function eliminar_insumo(dof_producto) {
    let dpol_ctaContable = $("#dpol_ctaContable option:selected").val();
    let dpol_ctaContable_text = $("#dpol_ctaContable option:selected").text();
    let dpol_monto = $("#dpol_monto").val();
    var flexRadioDefault = $(
        "input:radio[name=flexRadioDefault]:checked"
    ).val();

    linea = $("#linea").val();
    linea = +linea + 1;
    $("#linea").val(linea);

    cw = $("#debe").val();
    cw = +cw + -+dpol_monto;
    $("#debe").val(cw);

    cw = $("#haber").val();
    cw = +cw + -+dpol_monto;
    $("#haber").val(cw);

    $("#tr-" + dof_producto).remove();
}
