var fValidateGastoEmpresa = function() {
    var bValid = true;
    var fecha = $('#gastoempresa_fecha');
    var costo = $('#gastoempresa_costo');
    var detalle = $('#gastoempresa_detalle');
    var idEmpresa = $('#gastoempresa_idEmpresa');
    var allFields = $([]).add(fecha).add(costo).add(detalle).add(idEmpresa);
    allFields.removeClass('ui-state-error');
    bValid = bValid && checkDate(fecha);
    bValid = bValid && checkLength(costo, 'costo', 1, 17);
    bValid = bValid && checkNumeric(costo);
    bValid = bValid && checkLength(detalle, 'detalle', 1, 300);
    bValid = bValid && checkNumeric(idEmpresa);
    return bValid;    
}