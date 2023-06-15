$(function() {
    Contabilidad.validacionGeneral('form-general');

    $('#datonegociable').hide()

    $("#inputtipo").change(function() {
        let prueba=$('#inputtipo :selected').text().split(' - ').pop()
        if(prueba==='Cheque'){
            $('#datonegociable').show()
        }else{
            $('#datonegociable').hide()
        }
    });
});
