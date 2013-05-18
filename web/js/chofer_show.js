var fOkChofer = function() {
    showLoader();
    $('#barraDetalles').load(url_detalle_chofer, function() {
        hideLoader();
    });
}

var fOkMulta = function() {
    showLoader();
    $('#div-tabla-multas').load(url_lista_multas, function() {
        hideLoader();
    });
}

var fOkAccidente = function() {
    showLoader();
    $('#div-tabla-accidentes').load(url_lista_accidentes, function() {
        hideLoader();
    });
}

var fOkAdelanto = function() {
    showLoader();
    $('#div-tabla-adelantos').load(url_lista_adelantos, function() {
        hideLoader();
    });
}

var fOkRecaudacion = function() {
    showLoader();
    $('#div-tabla-ultimas-recaudaciones').load(url_lista_ultimas_recaudaciones, function() {
        hideLoader();
    });
}

var fOkPagoAdelanto = function() {
    showLoader();
    $('#div-tabla-pago-adelantos').load(url_lista_adelantos, function() {
        hideLoader();
    });
    showLoader();
    $('#div-tabla-adelantos').load(url_lista_adelantos, function() {
        hideLoader();
    });
}