var fValidateTrabajoTaller = function() {
    var bValid = true;
    var idMovil = $('#trabajotaller_idMovil');
    var idTaller = $('#trabajotaller_idTaller');
    var motivoIngreso = $('#trabajotaller_motivoIngreso');
    var costoMateriales = $('#trabajotaller_costoMateriales');
    var costoManoObra = $('#trabajotaller_costoManoObra');
    var detalleTrabajo = $('#trabajotaller_detalleTrabajo');
    var responsable = $('#trabajotaller_responsable');
    var tipoPago = $('#trabajotaller_tipoPago');
    var totalTrabajo = $('#trabajotaller_totalTrabajo');
    var numeroFactura = $('#trabajotaller_numeroFactura');
    var allFields = $([]).add(idMovil).add(idTaller).add(motivoIngreso).add(costoMateriales).add(costoManoObra).add(detalleTrabajo).add(responsable).add(tipoPago).add(totalTrabajo).add(numeroFactura);
    allFields.removeClass('ui-state-error');
    bValid = bValid && checkNumeric(idMovil);
    bValid = bValid && checkNumeric(idTaller);
    bValid = bValid && checkLength(motivoIngreso, 'Motivo Ingreso', 0, 200);
    bValid = bValid && checkLength(costoMateriales, 'Costo materiales', 0, 17);
    bValid = bValid && checkNumeric(costoMateriales);
    bValid = bValid && checkLength(costoManoObra, 'Costo mano de obra', 0, 17);
    bValid = bValid && checkNumeric(costoManoObra);
    bValid = bValid && checkLength(detalleTrabajo, 'Detalle Trabajo', 0, 200);
    bValid = bValid && checkLength(responsable, 'Responsable', 0, 150);
    bValid = bValid && checkLength(tipoPago, 'Tipo de pago', 0, 150);
    bValid = bValid && checkLength(totalTrabajo, 'Total trabajo', 0, 17);
    bValid = bValid && checkNumeric(totalTrabajo);
    bValid = bValid && checkLength(numeroFactura, 'Número factura', 0, 50);
    return bValid;    
}