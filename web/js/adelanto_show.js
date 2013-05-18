    
var fOkPagoAdelanto = function() {
    showLoader();
    $('#bodyInicial').load(url_detalles, function() {
        hideLoader();
    });
}
