$(function () {
    $('#txtPassword').on('keyup',function () {
        $('#strengthMessage').html(checkStrength($('#txtPassword').val()))
    })
    function checkStrength(password) {
        var strength = 0
        if (password.length < 6) {
            $('#strengthMessage').removeClass()
            $('#strengthMessage').addClass('Contraseña Corta text-danger')
            return 'Contraseña Corta'
        }
        if (password.length > 7) strength += 1
        // If password contains both lower and uppercase characters, increase strength value.
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
        // If it has numbers and characters, increase strength value.
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
        // If it has one special character, increase strength value.
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
        // If it has two special characters, increase strength value.
        if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
        // Calculated strength value, we can return messages
        // If value is less than 2
        if (strength < 2) {
            $('#strengthMessage').removeClass()
            $('#strengthMessage').addClass('Contraseña Debil text-danger')
            return 'Contraseña Debil'
        } else if (strength == 2) {
            $('#strengthMessage').removeClass()
            $('#strengthMessage').addClass('Contraseña Aceptable text-warning')
            return 'Contraseña Aceptable'
        } else {
            $('#strengthMessage').removeClass()
            $('#strengthMessage').addClass('Contraseña Fuerte text-success')
            return 'Contraseña Fuerte'
        }
    }

    $("#form-general").on('submit',function( event ) {
        if ( $("#txtPassword").val() == "" && $("#confirmtxtPassword").val()=="") {
            $("#confirmMessage").removeClass();
            $("#confirmMessage").addClass('text-danger');
            $("#confirmMessage").html("<strong>Las contraseñas no deben estar vacías.</strong>");
            event.preventDefault();
        } else{
        if ( $("#txtPassword").val() == $("#confirmtxtPassword").val()) {
          return;
        }
        $("#confirmMessage").removeClass();
            $("#confirmMessage").addClass('text-danger');
            $("#confirmMessage").html("<strong>Las contraseñas no coinciden.</strong>");
        event.preventDefault();
      }});


});



