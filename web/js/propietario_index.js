var fOkPropietario = function() {
    showLoader();
    $('#bodyInicial').load(url_lista_propietarios, function() {
        hideLoader();
    });
}