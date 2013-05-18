var fValidatePagoAdelanto = function() {
    var bValid = true;
    var fecha = $('#pagoadelanto_fecha');
    var monto = $('#pagoadelanto_monto');
    var detalle = $('#pagoadelanto_detalle');
    var allFields = $([]).add(fecha).add(monto).add(detalle);
    allFields.removeClass('ui-state-error');
    bValid = bValid && checkDate(fecha);
    bValid = bValid && checkLength(monto, 'monto', 1, 17);
    bValid = bValid && checkNumeric(monto);
    bValid = bValid && checkLength(detalle, 'detalle', 0, 150);
    return bValid;    
}