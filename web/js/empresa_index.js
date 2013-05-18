var fOkEmpresa = function() {
    showLoader();
    $('#bodyInicial').load(url_lista_empresas, function() {
        hideLoader();
    });
}