var fOkMovil = function() {
    showLoader();
    $('#barraDetalles').load(url_detalle_movil, function() {
        hideLoader();
    });
}

var fOkGasto = function() {
    showLoader();
    $('#div-tabla-gastos').load(url_lista_gastos, function() {
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

var fOkTrabajoTaller = function() {
    showLoader();
    $('#div-tabla-trabajosTaller').load(url_lista_trabajosTaller, function() {
        hideLoader();
    });
}

var fOkRecaudacion = function() {
    showLoader();
    $('#div-tabla-ultimas-recaudaciones').load(url_lista_ultimas_recaudaciones, function() {
        hideLoader();
    });
}