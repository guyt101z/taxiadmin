var fOkPropietario = function() {
    showLoader();
    $('#barraDetalles').load(url_detalle_propietario, function() {
        hideLoader();
    });
}