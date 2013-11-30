$(function(){

	// actualizo el menu activo
	var url = window.location.pathname, urlRegExp = new RegExp(url.replace(/\/$/,''));
	$('#menu a').each(function(){
		if(urlRegExp.test($(this).attr('href'))){
			$(this).parent().addClass('active');
		}
	});
});