var fValidateRecaudacion = function() {
	var bValid = true;
	return bValid;    
}

function validarRecaudacion(){
	// la recaudación no puede ser cero
	if($("#recaudacion_recaudacion").val() <= 0){
		alert('Tiene que ingresar una Recaudación');	
		return false;
	}
	// los kms no pueden ser cero
	if($("#recaudacion_km").val() <= 0){
		alert('Tiene que ingresar un kilometraje mayor a cero');	
		return false;
	}

	// tiene que haber seleccionado un chofer
	if($("#recaudacion_idChofer").val() == "" || $("#recaudacion_idChofer").val() == undefined ){
		alert('Debe seleccionar un Chofer');	
		return false;
	}
	// tiene que haber seleccionado un móvil
	if($("#recaudacion_idMovil").val() == "" || $("#recaudacion_idMovil").val() == undefined ){
		alert('Debe seleccionar un Móvil');
		return false;
	}
	return true;
}


$(document).ready(function() {

	// no permito agregar recaudaciones para días mayores que hoy
	$("#recaudacion_fecha").datepicker({ maxDate: "0" });

	// hacemos que al modificar el chofer si modifique el combo con el porcentaje de aporte
	// de esta manera lo obtenemos para hacer el calculo
	$('#recaudacion_idChofer').change(function() {
		// seteo la selección en los demás combos ocultos
    	$('#recaudacion_listaAporteLeyes').val($(this).val());
    	$('#recaudacion_listaPLiquidacion').val($(this).val());
    	// seteo el valor en los span para mostrarle al usuario
    	$('#p_chofer').text($('#recaudacion_listaPLiquidacion option:selected').html().substring(0,5) + '%');
    	$('#p_aporte').text($('#recaudacion_listaAporteLeyes option:selected').html().substring(0,6) + '%');
	});

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
		if(parseInt($("#recaudacion_recaudacion").val()) > 0 ){
			ajustarGastoTotales();
			calcularSueldo();
			aporteLeyes();
			liquidoMovil();
		}
	}

	function ajustarGastoTotales() {
		var total = 0;
		for (var i = 6; i > 0; i--) {
			total += parseInt($("#recaudacion_gasto" + i.toString()).val());
		};
		$("#recaudacion_totalGastos").val(total);
	}

	function calcularSueldo() {
		var pLiquidacion = parseFloat($('#recaudacion_listaPLiquidacion option:selected').html());
		pLiquidacion = pLiquidacion / 100;
		var sueldo = parseInt($("#recaudacion_recaudacion").val()) * pLiquidacion;
		$("#recaudacion_importeChofer").val(Math.round(sueldo));
	}

	function aporteLeyes(){
		var descuento = parseFloat($('#recaudacion_listaAporteLeyes option:selected').html());
		descuento = descuento / 100;
		var sueldo = $("#recaudacion_importeChofer").val();
		var aporteLeyes = sueldo * descuento;
		$("#recaudacion_importeChofer").val(Math.round(sueldo - aporteLeyes));
		$("#recaudacion_aporteLeyes").val(Math.round(aporteLeyes));

	}

	function liquidoMovil() {
		var liquido = parseFloat($('#recaudacion_recaudacion').val());
		liquido -= parseInt($("#recaudacion_totalGastos").val());
		liquido -= parseInt($("#recaudacion_importeChofer").val());
		liquido -= parseInt($("#recaudacion_aporteLeyes").val());
		$("#recaudacion_importeMovil").val(liquido);
	}

});