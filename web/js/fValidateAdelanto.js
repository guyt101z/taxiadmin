var fValidateAdelanto = function() {
    var bValid = true;
    var fecha = $('#adelanto_fecha');
    var monto = $('#adelanto_monto');
    var detalle = $('#adelanto_detalle');
    var idChofer = $('#adelanto_idChofer');
    var allFields = $([]).add(fecha).add(monto).add(detalle).add(idChofer);
    allFields.removeClass('ui-state-error');
    bValid = bValid && checkDate(fecha);
    bValid = bValid && checkLength(monto, 'monto', 1, 17);
    bValid = bValid && checkNumeric(monto);
    bValid = bValid && checkLength(detalle, 'detalle', 0, 150);
    bValid = bValid && checkNumeric(idChofer);
    return bValid;    
}