function showViewDialog(titulo, url, width) {
    showLoader();
    var div = $('<div hidden="hidden" title="' + titulo + '"></div>');
    div.load(url, function(response, status, xhr) {
        if(xhr.status == '401') {
            window.location.href = xhr.statusText;
        } else {
            div.dialog({
                autoOpen: false,
                modal: true,
                width: width,
                position: 'center',
                resizable: false,
                buttons: {
                    'Cerrar': function() {
                        div.dialog('close');
                    }
                },
                close: function() {
                    div.remove();
                }
            }).dialog('open');
            hideLoader();
        }
    });
}

function showEditDialog(titulo, url, width, fValidate, fOk) {
    showLoader();
    var div = $('<div hidden="hidden" title="' + titulo + '"></div>');
    div.load(url, function(response, status, xhr) {
        if(xhr.status == '401') {
            window.location.href = xhr.statusText;
        } else {
            div.dialog({
                autoOpen: false,
                modal: true,
                width: width,
                position: 'center',
                resizable: false,
                closeOnEscape: false,
                buttons: {
                    'Aceptar': function() {
                        if (fValidate()) {
                            var url_action = $('#form').attr('action');
                            var form_data = $('#form').serialize();
                            var request = $.ajax({
                                'type': 'POST', 
                                'url': url_action,
                                'dataType': 'json',
                                'data': form_data
                            });

                            request.done(function(data) {
                                if (data.ok == 'true') {
                                    if(data.url) {
                                        window.location.href = data.url;
                                    } else {
                                        fOk();
                                        if(data.message) {
                                            showMessage(data.message);
                                        }
                                    }
                                    div.dialog('close');
                                } else {
                                    updateTips(data.tip);
                                }
                            });
                    
                            request.fail(function(jqXHR, textStatus) {
                                if(jqXHR.status == '401') {
                                    window.location.href = jqXHR.statusText;
                                } else {
                                    updateTips('Error al conectar al servidor.');
                                }
                            });
                        }
                    },
                    'Cancelar': function() {
                        div.dialog('close');
                    }
                },
                close: function() {
                    div.remove();
                }
            }).dialog('open');
            hideLoader();
        }
    });
    
    div.keypress(function(e) {
        if (e.keyCode == $.ui.keyCode.ENTER) {
            $(this).parent().find('.ui-dialog-buttonpane button:first').click();
        }
    });
}

function showDeleteDialog(titulo, url, width, urlDelete, csrfToken, fOk) {
    showLoader();
    var div = $('<div hidden="hidden" title="' + titulo + '"></div>');
    div.load(url, function(response, status, xhr) {
        if(xhr.status == '401') {
            window.location.href = xhr.statusText;
        } else {
            div.dialog({
                autoOpen: false,
                modal: true,
                width: width,
                position: 'center',
                resizable: false,
                buttons: {
                    "Eliminar" : function() {
                        var request = $.ajax({
                            'type': 'POST', 
                            'url': urlDelete,
                            'dataType': 'json',
                            'data': 'sf_method=delete&_csrf_token=' + csrfToken
                        });

                        request.done(function(data) {
                            if (data.ok == 'true') {
                                if(data.url) {
                                    window.location.href = data.url;
                                } else {
                                    fOk();
                                    if(data.message) {
                                        showMessage(data.message);
                                    }
                                }
                                div.dialog('close');
                            }
                        });
                    
                        request.fail(function(jqXHR, textStatus) {
                            if(jqXHR.status == '401') {
                                window.location.href = jqXHR.statusText;
                            } else {
                                updateTips('Error al conectar al servidor.');
                            }
                        });
                    },
                    'Cancelar': function() {
                        div.dialog('close');
                    }
                },
                close: function() {
                    div.remove();
                }
            }).dialog('open');
            hideLoader();
        }
    });
}

var fValidateNone = function() {
    return true;    
}

var fOkNone = function() {
    return true;    
}

function updateTips(text) {
    var tips = $('.validateTips');
        
    tips.text(text)
    tips.addClass('ui-state-highlight');
    
    setTimeout(function() {
        tips.removeClass('ui-state-highlight', 1500);
    }, 500);
}

function checkLength(o, n, min, max) {
    if (o.val().length > max || o.val().length < min) {
        o.addClass('ui-state-error');
        updateTips('El largo de  ' + n + ' debe ser entre ' + min + ' y ' + max + '.');
        return false;
    }
    return true;
}

function checkNumeric(obj) {
    if(isNaN(obj.val())) {
        obj.addClass('ui-state-error');
        updateTips('El valor debe ser numérico.');
        return false;
        
    }
    return true;
}

function checkDate(obj) {
    if(!Date.parse(obj.val())) {
        obj.addClass('ui-state-error');
        updateTips('Formato de fecha incorrecto.');
        return false;
    }
    return true;
}

function checkRegexp(o, regexp, n) {
    if (!(regexp.test(o.val()))) {
        o.addClass( 'ui-state-error' );
        updateTips(n);
        return false;
    }
    return true;
}

function checkEquals(uno, dos, campo) {
    if (uno.val() != dos.val()) {
        uno.addClass('ui-state-error');
        dos.addClass('ui-state-error');
        updateTips('Los campos  ' + campo + ' no coinciden.');
        return false;
    }
    return true;
}