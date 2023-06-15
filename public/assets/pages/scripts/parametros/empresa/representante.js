$(function () {
    Contabilidad.validacionGeneral('form-especial');

    $(".select2").select2({
        language: "es",
        theme: "bootstrap4"
    });

    $("#rep_inicio").daterangepicker({
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
        "startDate": $('#hemp_inicio').val(),
        minDate: "01/01/1970",
        drops: "down",
    });

    $("#rep_fin").daterangepicker({
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
        "startDate": $('#hemp_fin').val(),
        minDate: moment($('#hemp_inicio').val(),"DD/MM/YYYY").add(1,'d'),
        drops: "down",
    });

    $("#rep_inicio").on('change', function () {
        var drp = $('#rep_fin').data('daterangepicker');
        drp.setMinDate(moment($(this).val(),"DD/MM/YYYY").add(1,'d'));
    });
});


$('#habilita').on('change', function () {
    if ($(this).is(':checked')){
        $('#rep_fin').removeClass('disabled');
    } else {
        $('#rep_fin').addClass('disabled');
    }
});

