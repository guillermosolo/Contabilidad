$(function () {
    $("#tablas").DataTable({
        "columnDefs": [
            {
                "orderable": false,
                "searchable": false,
                "targets": 2
            }
        ],
        "responsive": true,
        "autoWidth": false,
        "language": {
            "decimal":        "",
            "emptyTable":     "No hay datos disponibles para la tabla",
            "info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty":      "Mostrando 0 a 0 de 0 registros",
            "infoFiltered":   "(filtrado de _MAX_ registros totales)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Mostrando _MENU_ registros por página",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando...",
            "search":         "Búsqueda:",
            "zeroRecords":    "No se encontraron registros que cumplan el criterio",
            "paginate": {
                "first":      "Primero",
                "last":       "Último",
                "next":       "Siguiente",
                "previous":   "Previo"
            },
            "aria": {
                "sortAscending":  ": Activar ordenamiento ascendente",
                "sortDescending": ": Activar ordenamiento descendente"
            }
        }
    });

});
