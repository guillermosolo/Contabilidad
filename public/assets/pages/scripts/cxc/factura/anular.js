$('.eliminar-factura').on('click',function(event){
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
        title: '¿Está seguro que desea anular la factura?',
        text: "¡Esta acción no se puede deshacer!",
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Anular'
    }).then((result)=>{
        if (result.value){
            window.location.href = url;
        } else {
            window.location.href = url2;
        }
    });
});
