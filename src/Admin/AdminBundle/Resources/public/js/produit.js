$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('.selectpicker').selectpicker();

    $('[data-toggle="popover"]').popover({
        'html': true,
        trigger: 'hover'
    });

});