var url=$("#routepath").val();
/*Alert Autodismiss
$(".alert-time").fadeTo(1000, 500).slideUp(3000, function(){
    $(".alert-dismissible").alert('close');
}); */
/* Resolve conflict in jQuery UI tooltip with Bootstrap tooltip */
$.widget.bridge('uibutton', $.ui.button);
/* para ver los tooltips */
$(function () {$('[data-toggle="tooltip"]').tooltip()});
/* menu activo */
$('ul.nav-treeview a').filter(function() {
    return this.href == url;
}).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
/*collapse error base de datos */
    $('#leerMas').click(function () {
        var collapse_content_selector = $('#collapse16');
        var toggle_switch = $(this);
        $(collapse_content_selector).toggle(function () {
            if ($(this).css('display') == 'none') {
                toggle_switch.html('Leer Mas...');
            } else {
                toggle_switch.html('');
            }
        });
    });

$('.eliminar-registro').on('click',function(event){
    event.preventDefault();
    const url = $(this).attr('href');
    const url2 = $('#routepath').val();
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-lg btn-outline-success mr-5',
          cancelButton: 'btn btn-lg btn-outline-danger'
        },
        buttonsStyling: false
      });
      swalWithBootstrapButtons.fire({
        title: '¿Está seguro que desea eliminar el registro?',
        text: "¡Esta acción no se puede deshacer!",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Eliminar'
    }).then((result)=>{
        if (result.value){
            window.location.href = url;
        } else {
            window.location.href = url2;
        }
    });
});

