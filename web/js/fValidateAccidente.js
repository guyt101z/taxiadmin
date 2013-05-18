var fValidateAccidente = function() {
    var bValid = true;
    var idChofer = $('#accidente_idChofer');
    var idMovil = $('#accidente_idMovil');
    var fecha = $('#accidente_fecha');
    var responsable = $('#accidente_responsable');
    var esquina = $('#accidente_esquina');
    var heridos = $('#accidente_heridos');
    var descripcion = $('#accidente_descripcion');
    var allFields = $([]).add(idChofer).add(idMovil).add(fecha).add(responsable).add(esquina).add(heridos).add(descripcion);
    allFields.removeClass('ui-state-error');
    bValid = bValid && checkNumeric(idChofer);
    bValid = bValid && checkNumeric(idMovil);
    bValid = bValid && checkDate(fecha);
    bValid = bValid && checkLength(responsable, 'responsable', 0, 100);
    bValid = bValid && checkLength(esquina, 'esquina', 1, 200);
    bValid = bValid && checkLength(heridos, 'heridos', 1, 3);
    bValid = bValid && checkNumeric(heridos);
    bValid = bValid && checkLength(descripcion, 'descripción', 1, 200);
    return bValid;    
}