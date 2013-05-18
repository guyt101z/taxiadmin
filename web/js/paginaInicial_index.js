var fOkVencimiento = function() {
    showLoader();
    $('#bodyInicial').load(url_lista_vencimientos, function() {
        hideLoader();
    });
}

var fOkMulta = function() {
    alert('Multa ingresada ok.');
    fOkVencimiento();
}

var fOkAccidente = function() {
    alert('Accidente ingresado ok.');
    fOkVencimiento();
}

var fOkRecaudacion = function() {
    alert('Recaudación ingresada ok.');
}