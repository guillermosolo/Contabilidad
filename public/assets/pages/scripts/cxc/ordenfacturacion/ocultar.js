function mostrar() {
    div = document.getElementById('flotante');
    div.style.display = '';
}

function cerrar() {
    div = document.getElementById('flotante');
    div.style.display = 'none';
}


$("#ven_fecha").daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    showWeekNumbers: true,
    autoApply: true,
    locale: {
        format: "DD/MM/YYYY",
        separator: " / ",
        applyLabel: "OK",
        cancelLabel: "Cancelar",
        fromLabel: "Desde",
        toLabel: "Hasta",
        customRangeLabel: "Personalizado",
        weekLabel: "S",
        daysOfWeek: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
        monthNames: [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre",
        ],
        firstDay: 1,
    },
    linkedCalendars: false,
    showCustomRangeLabel: false,
    startDate: $("#hemp_inicio").val(),
    minDate: "01/01/1970",
    drops: "up",
});



function copy_address() {
    document.getElementById('ordf_empresa').value = document.getElementById('ven_empresa').value;
     
}
