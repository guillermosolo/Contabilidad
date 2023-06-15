$(document).ready(function () {
    $("#show_hide_password a").on("click", function (event) {
      event.preventDefault();
      $("#show_hide_password i").toggleClass('fa-eye fa-eye-slash');
      if ($("#show_hide_password input").attr("type") == "text") {
        $("#show_hide_password input").attr("type", "Password");
      } else if ($("#show_hide_password input").attr("type") == "Password") {
        $("#show_hide_password input").attr("type", "text");
      }
    });
  });


