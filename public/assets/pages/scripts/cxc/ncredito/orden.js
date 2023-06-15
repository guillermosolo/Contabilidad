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



 