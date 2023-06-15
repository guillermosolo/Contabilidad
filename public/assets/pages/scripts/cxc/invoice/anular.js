


swal({
    title: "Anular Factura",
    text: "Está seguro de anular Factura",
    type: "warning",
    showCancelButton: true,
    confirmButtonClass: "btn-danger",
    confirmButtonText: "Si, Anular",
    cancelButtonText: "No",
    closeOnConfirm: false,
    closeOnCancel: false
  },
  function(isConfirm) {
    if (isConfirm) {
      swal("Deleted!", "La factura ha sido anulada.", "success");
    } else {
      swal("Cancelled", "Cancelado :)", "error");
    }
  });
