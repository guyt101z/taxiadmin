<?php use_helper('JavascriptBase'); ?>
<?php use_javascript('common.js') ?>
<?php use_javascript('dialogs.js') ?>
<?php use_javascript('fValidateChofer.js') ?>
<?php use_javascript('fValidateMulta.js') ?>
<?php use_javascript('fValidateAccidente.js') ?>
<?php use_javascript('fValidateAdelanto.js') ?>
<?php use_javascript('fValidateRecaudacion.js') ?>
<?php use_javascript('fValidatePagoAdelanto.js') ?>
<?php use_javascript('chofer_show.js') ?>
<?php echo javascript_tag('var url_detalle_chofer = "' . url_for('chofer/detalleChofer?id=' . $chofer->getId()) . '"') ?>
<?php echo javascript_tag('var url_lista_multas = "' . url_for('chofer/listaMultas?id=' . $chofer->getId()) . '"') ?>
<?php echo javascript_tag('var url_lista_accidentes = "' . url_for('chofer/listaAccidentes?id=' . $chofer->getId()) . '"') ?>
<?php echo javascript_tag('var url_lista_adelantos = "' . url_for('chofer/listaAdelantos?id=' . $chofer->getId()) . '"') ?>
<?php echo javascript_tag('var url_lista_ultimas_recaudaciones = "' . url_for('chofer/listaUltimasRecaudaciones?id=' . $chofer->getId()) . '"') ?>

<?php slot('sidebar') ?>

<!-- Barra lateral -->
<div class="sidebar" >

    <div class='path'>
        Choferes <?php echo EtiquetasFrontEnd::$SEPARADOR_PATH ?> Detalles
    </div>

    <div class="news">
        <!-- <h5><label onclick="showEditDialog('Ingresar Recaudación', '<?php echo url_for('recaudacion/new?idChofer=' . $chofer->getId()) ?>', '800', fValidateRecaudacion, fOkRecaudacion); return false;">Ingresar Recaudación</label></h5> -->
    </div>
    <div class="news">
        <h5><a href="<?php echo url_for('recaudacion/index?idChofer=' . $chofer->getId()) ?>"><label>Ver Recaudaciones</label></a></h5>
    </div>
    <div class="news">
        <h5><label onclick="showEditDialog('Ingresar Multa', '<?php echo url_for('multa/new?idChofer=' . $chofer->getId()) ?>', '400', fValidateMulta, fOkMulta); return false;">Ingresar Multa</label></h5>
    </div>
    <div class="news">
        <h5><label onclick="showEditDialog('Ingresar Accidente', '<?php echo url_for('accidente/new?idChofer=' . $chofer->getId()) ?>', '400', fValidateAccidente, fOkAccidente); return false;">Ingresar Accidente</label></h5>
    </div>
    <div class="news">
        <h5><label onclick="showEditDialog('Ingresar Adelanto', '<?php echo url_for('adelanto/new?idChofer=' . $chofer->getId()) ?>', '350', fValidateAdelanto, fOkAdelanto); return false;">Ingresar Adelanto de Sueldo</label></h5>
    </div>
    <div class="news">
        <h5><label onclick="alert('Funcionalidad no implementada.'); return false;">Imprimir</label></h5>
    </div>
</div>

<?php end_slot() ?>


<div id="barraDetalles">
    <?php include_partial('detalleChofer', array('chofer' => $chofer)) ?>
</div>

<div id="barraBotones">
    <?php echo button_to('Volver', 'chofer/index', 'class= botonDerecho') ?>
    <input class="botonCentro" value="Eliminar" type="button" onclick="showDeleteDialog('Confirmación', '<?php echo url_for('chofer/erase?id=' . $chofer->getId()) ?>', '440', '<?php echo url_for('chofer/delete?id=' . $chofer->getId()) ?>', '<?php echo $csrfToken ?>'); return false;" />
    <input class="botonIzquierdo" value="Modificar" type="button" onclick="showEditDialog('Modificar Chofer', '<?php echo url_for('chofer/edit?id=' . $chofer->getId()) ?>', '525', fValidateChofer, fOkChofer); return false;" />
</div>

<div id="barraInfoAdicional">
    <h4 class="inner">Últimas recaudaciones</h4>
    <div id="div-tabla-ultimas-recaudaciones" class="tablaAdicional" >
        <?php include_partial('listaUltimasRecaudaciones', array('chofer' => $chofer)) ?>
    </div>
</div>

<div id="tablasAdicionales">
    <h4 class="inner">Empresas en las que trabaja</h4>
    <div id="div-tabla-empresas" class="tablaAdicional" >
        <?php include_partial('listaEmpresas', array('chofer' => $chofer)) ?>
    </div>

    <h4 class="inner">Multas</h4>
    <div id="div-tabla-multas" class="tablaAdicional" >
        <?php include_partial('listaMultas', array('chofer' => $chofer, 'csrfToken' => $csrfToken)) ?>
    </div>

    <h4 class="inner">Accidentes</h4>
    <div id="div-tabla-accidentes" class="tablaAdicional" >
        <?php include_partial('listaAccidentes', array('chofer' => $chofer, 'csrfToken' => $csrfToken)) ?>
    </div>

    <h4 class="inner">Adelantos de sueldo solicitados</h4>
    <div id="div-tabla-adelantos" class="tablaAdicional" >
        <?php include_partial('listaAdelantos', array('chofer' => $chofer, 'csrfToken' => $csrfToken)) ?>
    </div>

</div>