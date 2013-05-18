var fOkMovil = function() {
    showLoader();
    $('#bodyInicial').load(url_lista_moviles, function() {
        hideLoader();
    });
}