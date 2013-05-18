var fValidateUsuario = function() {
    var bValid = true;
    var nombre = $('#usuario_nombre');
    var apellidos = $('#usuario_apellidos');
    var celular = $('#usuario_celular');
    var telefono = $('#usuario_telefono');
    var direccion = $('#usuario_direccion');
    var email = $('#usuario_email');
    var clave = $('#usuario_clave');
    var clave2 = $('#usuario_clave2');
    var allFields = $([]).add(nombre).add(apellidos).add(celular).add(telefono).add(direccion).add(email).add(clave).add(clave2);
    allFields.removeClass('ui-state-error');
    bValid = bValid && checkLength(nombre, 'nombre', 1, 20);
    bValid = bValid && checkLength(apellidos, 'apellidos', 1, 30);
    bValid = bValid && checkLength(celular, 'celular', 0, 15);
    bValid = bValid && checkLength(telefono, 'telefono', 0, 15);
    bValid = bValid && checkLength(direccion, 'direccion', 1, 100);
    bValid = bValid && checkRegexp(email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, 'Ej. jrodriguez@gmail.com');
    bValid = bValid && checkLength(clave, 'clave', 1, 20);
    bValid = bValid && checkLength(clave2, 'clave2', 1, 20);
    bValid = bValid && checkEquals(clave, clave2, 'Clave');
    return bValid;
}