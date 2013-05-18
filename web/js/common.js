$(function() {
    $('.fecha').livequery(function(){ 
        $(this).datepicker($.datepicker.regional['es']);
    });
    $("tr:odd").livequery(function() {
        $(this).addClass("odd-row");
    });
});

function showLoader() {
    $('#image-loader').show();
}

function hideLoader() {
    $('#image-loader').hide();
}

function showMessage(text) {
    var message = $('#mensaje');
        
    message.text(text)
    message.addClass('ui-state-highlight');
    
    setTimeout(function() {
        message.removeClass('ui-state-highlight');
        message.text('');
    }, 5000);
}
