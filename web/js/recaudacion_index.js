var fOkRecaudacion = function() {
    showLoader();
    $('#bodyInicial').load(url_lista_recaudaciones, function() {
        hideLoader();
    });
}