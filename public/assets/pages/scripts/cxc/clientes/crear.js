$(function() {
    Contabilidad.validacionGeneral('form-general');

    $(".select2").select2({
        language: "es",
        theme: "bootstrap4"
    });

    $("input[type='number']").inputSpinner();

    $('[data-mask]').inputmask();
});

$('#editar').on('change',function(){
    if ($(this).is(':checked')){
        $(".editable").prop("disabled", false);
    } else {
        $(".editable").prop("disabled", true);
    }
});
