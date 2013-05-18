var fOkEmpresa = function() {
    showLoader();
    $('#barraDetalles').load(url_detalle_empresa, function() {
        hideLoader();
    });
}

var fOkGasto = function() {
    showLoader();
    $('#div-tabla-gastos').load(url_lista_gastos, function() {
        hideLoader();
    });
}

var fOkAgregarPropietario = function() {
    showLoader();
    $('#div-tabla-propietarios').load(url_lista_propietarios, function() {
        hideLoader();
    });
    showLoader();
    $('#barraDetalles').load(url_detalle_empresa, function() {
        hideLoader();
    });
}

var fOkAgregarMovil = function() {
    showLoader();
    $('#div-tabla-moviles').load(url_lista_moviles, function() {
        hideLoader();
    });
    showLoader();
    $('#barraDetalles').load(url_detalle_empresa, function() {
        hideLoader();
    });
}

var fOkAgregarChofer = function() {
    showLoader();
    $('#div-tabla-choferes').load(url_lista_choferes, function() {
        hideLoader();
    });
    showLoader();
    $('#barraDetalles').load(url_detalle_empresa, function() {
        hideLoader();
    });
}