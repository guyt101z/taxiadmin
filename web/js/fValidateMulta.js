var fValidateMulta = function() {
    var bValid = true;
    var idChofer = $('#multa_idChofer');
    var idMovil = $('#multa_idMovil');
    var fecha = $('#multa_fecha');
    var descripcion = $('#multa_descripcion');
    var esquina = $('#multa_esquina');
    var responsable = $('#multa_responsable');
    var costo = $('#multa_costo');
    var fechaVencimiento = $('#multa_fechaVencimiento');
    var allFields = $([]).add(idChofer).add(idMovil).add(fecha).add(descripcion).add(esquina).add(responsable).add(costo).add(fechaVencimiento);
    allFields.removeClass('ui-state-error');
    bValid = bValid && checkNumeric(idChofer);
    bValid = bValid && checkNumeric(idMovil);
    bValid = bValid && checkDate(fecha);
    bValid = bValid && checkLength(descripcion, 'descripción', 0, 200);
    bValid = bValid && checkLength(esquina, 'esquina', 0, 200);
    bValid = bValid && checkLength(responsable, 'responsable', 0, 100);
    bValid = bValid && checkLength(costo, 'costo', 0, 17);
    bValid = bValid && checkNumeric(costo);
    bValid = bValid && checkDate(fechaVencimiento);
    return bValid;    
}