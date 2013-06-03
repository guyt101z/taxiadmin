var fValidateRecaudacion = function() {
	var bValid = true;
	return bValid;    
}



$(document).ready(function() {

	$("#recaudacion_km").val('0').focusout( function() { verifico('Debe ingresar un valor de Km válido', $(this).val()); } );
	$("#recaudacion_recaudacion").val('0').focusout( function() { verifico('Debe ingresar un valor de Recaudación válido', $(this).val()); } );
	$("#recaudacion_importeChofer").val('0').focusout( function() { verifico('Debe ingresar un valor válido', $(this).val()); } );
	$("#recaudacion_importeMovil").val('0').focusout( function() { verifico('Debe ingresar un valor válido', $(this).val()); } );
	$("#recaudacion_aporteLeyes").val('0').focusout( function() { verifico('Debe ingresar un válido', $(this).val()); } );
	$("#recaudacion_totalGastos").val('0').focusout( function() { verifico('Debe ingresar un valor válido', $(this).val()); } );
	$("#recaudacion_gasto1").val('0').focusout( function() { verifico('Debe ingresar un valor válido', $(this).val()); } );
	$("#recaudacion_gasto2").val('0').focusout( function() { verifico('Debe ingresar un valor válido', $(this).val()); } );
	$("#recaudacion_gasto3").val('0').focusout( function() { verifico('Debe ingresar un valor válido', $(this).val()); } );
	$("#recaudacion_gasto4").val('0').focusout( function() { verifico('Debe ingresar un valor válido', $(this).val()); } );
	$("#recaudacion_gasto5").val('0').focusout( function() { verifico('Debe ingresar un valor válido', $(this).val()); } );
	$("#recaudacion_gasto6").val('0').focusout( function() { verifico('Debe ingresar un valor válido', $(this).val()); } );
	


	function verifico (msg, valor) {
		if (!$.isNumeric(valor)) {
			alert(msg);
		};
		calculos();
	}

	function calculos() {
		ajustarGastoTotales();
		calcularSueldo();
		aporteLeyes();
		liquidoMovil();
	}

	function ajustarGastoTotales() {
		var total = 0;
		for (var i = 6; i > 0; i--) {
			total += parseInt($("#recaudacion_gasto" + i.toString()).val());
		};
		$("#recaudacion_totalGastos").val(total);
	}

	function calcularSueldo() {
		if(parseInt($("#recaudacion_recaudacion").val()) > 0 ){
			var sueldo = parseInt($("#recaudacion_recaudacion").val()) * 0.29;
			$("#recaudacion_importeChofer").val(Math.round(sueldo));
		}
	}

	function aporteLeyes(){
		var descuento = 0.19621;
		var sueldo = $("#recaudacion_importeChofer").val();
		var aporteLeyes = sueldo * descuento
		$("#recaudacion_importeChofer").val(Math.round(sueldo - aporteLeyes));
		$("#recaudacion_aporteLeyes").val(Math.round(aporteLeyes));

	}

	function liquidoMovil() {
		var liquido = parseInt($("#recaudacion_recaudacion").val());
		liquido -= parseInt($("#recaudacion_totalGastos").val());
		liquido -= parseInt($("#recaudacion_importeChofer").val());
		$("#recaudacion_importeMovil").val(liquido);
	}

});