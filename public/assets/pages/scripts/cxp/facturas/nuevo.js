$("#proveedores").on("click", function (event) {
    event.preventDefault();
    console.log("si es aqui");
    const url = $(this).attr("href");
    const url2 = $("#routepath").val();
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-lg btn-outline-success mr-5",
            cancelButton: "btn btn-lg btn-outline-danger",
        },
        buttonsStyling: false,
    });
    swalWithBootstrapButtons
        .fire({
            title: "Ingrese el NIT del proveedor",
            icon: "question",
            html: '<p> «ENTER» si es Consumidor Final </p><input type="text" class="form-control" id="nit" onkeypress="return validaNumericos(event,\'N\');">',
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonText: "Crear",
            onOpen: () => {
                swalWithBootstrapButtons
                    .getContent()
                    .querySelector("#nit")
                    .focus();
            },
            preConfirm: (value) => {
                nit = $('input[id="nit"]').val();
                verificador = nit[nit.length -1];
                if (verificador=='k' || verificador=='K')
                    numVerificador = 10;
                else
                    numVerificador = parseInt(verificador);
                invertidos = nit.substring(0,nit.length-1).split("").reverse().join("");
                suma = 0;
                for (var i=0;i<invertidos.length;i++)
                    suma += parseInt(invertidos[i]) * (i + 2);
                modulo = suma % 11;
                total = 11 - modulo;
                total = total % 11;
                if (total != verificador) {
                    Swal.showValidationMessage("El NIT no es válido.");
                }
            },
        })
        .then((result) => {
            if (result.value) {
                if ($('input[id="nit"]').val() == "") {
                    window.location.href = url.replace("#", "CF");
                } else {
                    window.location.href = url.replace(
                        "#",
                        $('input[id="nit"]').val()
                    );
                }
            } else {
                window.location.href = url2;
            }
        });
    $(document).on("keyup", "#nit", function (event) {
        if (event.key === "Enter") {
            swalWithBootstrapButtons.clickConfirm();
        }
    });
});
