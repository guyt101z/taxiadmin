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

	// verifico que no tengan valor, en caso de no tener le seteo el cero
	if($("#recaudacion_km").val() == undefined || $("#recaudacion_km").val() == "")	$("#recaudacion_km").val('0');
	if($("#recaudacion_recaudacion").val() == undefined || $("#recaudacion_recaudacion").val() == "")	$("#recaudacion_recaudacion").val('0');
	if($("#recaudacion_importeChofer").val() == undefined || $("#recaudacion_importeChofer").val() == "")	$("#recaudacion_importeChofer").val('0');
	if($("#recaudacion_importeMovil").val() == undefined || $("#recaudacion_importeMovil").val() == "")	$("#recaudacion_importeMovil").val('0');
	if($("#recaudacion_aporteLeyes").val() == undefined || $("#recaudacion_aporteLeyes").val() == "")	$("#recaudacion_aporteLeyes").val('0');
	if($("#recaudacion_totalGastos").val() == undefined || $("#recaudacion_totalGastos").val() == "")	$("#recaudacion_totalGastos").val('0');
	if($("#recaudacion_Gas-Oil").val() == undefined || $("#recaudacion_Gas-Oil").val() == "")	$("#recaudacion_Gas-Oil").val('0');
	if($("#recaudacion_Aceite").val() == undefined || $("#recaudacion_Aceite").val() == "")	$("#recaudacion_Aceite").val('0');
	if($("#recaudacion_Gomeria").val() == undefined || $("#recaudacion_Gomeria").val() == "")	$("#recaudacion_Gomeria").val('0');
	if($("#recaudacion_Lavado").val() == undefined || $("#recaudacion_Lavado").val() == "")	$("#recaudacion_Lavado").val('0');
	if($("#recaudacion_Viaticos").val() == undefined || $("#recaudacion_Viaticos").val() == "")	$("#recaudacion_Viaticos").val('0');
	if($("#recaudacion_Otros").val() == undefined || $("#recaudacion_Otros").val() == "")	$("#recaudacion_Otros").val('0');

	$("#recaudacion_km").focusout( function() { verifico('Debe ingresar un valor de Km válido', $(this).val()); } );
	$("#recaudacion_recaudacion").focusout( function() { verifico('Debe ingresar un valor de Recaudación válido', $(this).val()); } );
	$("#recaudacion_importeChofer").focusout( function() { verifico('Debe ingresar un valor válido', $(this).val()); } );
	$("#recaudacion_importeMovil").focusout( function() { verifico('Debe ingresar un valor válido', $(this).val()); } );
	$("#recaudacion_aporteLeyes").focusout( function() { verifico('Debe ingresar un válido', $(this).val()); } );
	$("#recaudacion_totalGastos").focusout( function() { verifico('Debe ingresar un valor válido', $(this).val()); } );
	$("#recaudacion_Gas-Oil").focusout( function() { verifico('Debe ingresar un valor válido', $(this).val()); } );
	$("#recaudacion_Aceite").focusout( function() { verifico('Debe ingresar un valor válido', $(this).val()); } );
	$("#recaudacion_Gomeria").focusout( function() { verifico('Debe ingresar un valor válido', $(this).val()); } );
	$("#recaudacion_Lavado").focusout( function() { verifico('Debe ingresar un valor válido', $(this).val()); } );
	$("#recaudacion_Viaticos").focusout( function() { verifico('Debe ingresar un valor válido', $(this).val()); } );
	$("#recaudacion_Otros").focusout( function() { verifico('Debe ingresar un valor válido', $(this).val()); } );
	

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

		total += parseInt($("#recaudacion_Gas-Oil").val());
		total += parseInt($("#recaudacion_Aceite").val());
		total += parseInt($("#recaudacion_Gomeria").val());
		total += parseInt($("#recaudacion_Lavado").val());
		total += parseInt($("#recaudacion_Viaticos").val());
		total += parseInt($("#recaudacion_Otros").val());
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