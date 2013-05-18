var fValidateGastoMovil = function() {
    var bValid = true;
    var fecha = $('#gastomovil_fecha');
    var costo = $('#gastomovil_costo');
    var detalle = $('#gastomovil_detalle');
    var idMovil = $('#gastomovil_idMovil');
    var allFields = $([]).add(fecha).add(costo).add(detalle).add(idMovil);
    allFields.removeClass('ui-state-error');
    bValid = bValid && checkDate(fecha);
    bValid = bValid && checkLength(costo, 'costo', 1, 17);
    bValid = bValid && checkNumeric(costo);
    bValid = bValid && checkLength(detalle, 'detalle', 1, 300);
    bValid = bValid && checkNumeric(idMovil);
    return bValid;    
}