$(function(){

	// actualizo el menu activo
	var url = window.location.pathname, urlRegExp = new RegExp(url.replace(/\/$/,''));
	$('#menu a').each(function(){
		if(urlRegExp.test($(this).attr('href'))){
			$(this).parent().addClass('active');
		}
	});

	// agrego todos los tooltips
	jQuery('.help-tooltip').tooltip();

	// refresca el modal asi se utiliza uno solo por pagina 
	$('body').on('hidden.bs.modal', '.modal', function () {
		$(this).removeData('bs.modal');
	});

});