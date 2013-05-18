var fValidateEmpresa = function() {
    var bValid = true;
    var nombre = $('#empresa_nombre');
    var razonSocial = $('#empresa_razonSocial');
    var idBanco = $('#empresa_idBanco');
    var numeroCuenta = $('#empresa_numeroCuenta');
    var allFields = $([]).add(nombre).add(razonSocial).add(idBanco).add(numeroCuenta);
    allFields.removeClass('ui-state-error');
    bValid = bValid && checkLength(nombre, 'nombre', 1, 100);
    bValid = bValid && checkLength(razonSocial, 'razón social', 1, 50);
    bValid = bValid && checkNumeric(idBanco);
    bValid = bValid && checkLength(numeroCuenta, 'número cuenta', 0, 20);
    return bValid;    
}