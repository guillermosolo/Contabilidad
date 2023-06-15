$("#crear").on("click", function (event) {
    event.preventDefault();
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
            title: "Ingrese el NIT del Cliente",
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
        })
        .then((result) => {
            if (result.value) {
                if ($('input[id="nit"]').val() == "") {
                    window.location.href = url.replace(
                        "#","CF");
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
