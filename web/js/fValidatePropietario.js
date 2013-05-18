var fValidatePropietario = function() {
    var bValid = true;
    var cedula = $('#propietario_cedula');
    var nombre = $('#propietario_nombre');
    var apellidos = $('#propietario_apellidos');
    var direccion = $('#propietario_direccion');
    var telefono = $('#propietario_telefono');
    var celular = $('#propietario_celular');
    var email = $('#propietario_email');
    var allFields = $([]).add(cedula).add(nombre).add(apellidos).add(direccion).add(telefono).add(celular).add(email);
    allFields.removeClass('ui-state-error');
    bValid = bValid && checkLength(cedula, 'cédula', 8, 8);
    bValid = bValid && checkNumeric(cedula);
    bValid = bValid && checkLength(nombre, 'nombre', 1, 50);
    bValid = bValid && checkLength(apellidos, 'apellidos', 1, 50);
    bValid = bValid && checkLength(direccion, 'dirección', 0, 100);
    bValid = bValid && checkLength(telefono, 'teléfono', 0, 15);
    bValid = bValid && checkLength(celular, 'celular', 0, 15);
    bValid = bValid && checkLength(email, 'email', 0, 100);
    if(email.val().length > 0) {
        bValid = bValid && checkRegexp(email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, 'Ej. jrodriguez@gmail.com');
    }
    return bValid;    
}