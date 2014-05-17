$(function() {

    // actualizo el menu activo
    var url = window.location.pathname;

    $('#menu a').each(function() {
        urlRegExp = new RegExp(url.replace(/\/$/, ''));
        if (url.indexOf($(this).attr('href')) == 0) {
            $(this).parent().addClass('active');
        }
    });

    // agrego todos los tooltips
    jQuery('.help-tooltip').tooltip();

    // refresca el modal asi se utiliza uno solo por pagina 
    $('body').on('hidden.bs.modal', '.modal', function() {
        $(this).removeData('bs.modal');
    });

});