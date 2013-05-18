var fOkChofer = function() {
    showLoader();
    $('#bodyInicial').load(url_lista_choferes, function() {
        hideLoader();
    });
}