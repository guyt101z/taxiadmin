<?php use_helper('JavascriptBase'); ?>
<?php use_javascript('common.js') ?>
<?php use_javascript('dialogs.js') ?>
<?php use_javascript('fValidatePropietario.js') ?>
<?php use_javascript('propietario_show.js') ?>
<?php echo javascript_tag('var url_detalle_propietario = "' . url_for('propietario/detallePropietario?id=' . $propietario->getId()) . '"') ?>

<?php slot('sidebar') ?>

<!-- Barra lateral -->
<div class="sidebar" >

    <div class='path'>
        Propietarios <?php echo EtiquetasFrontEnd::$SEPARADOR_PATH ?> Detalles
    </div>

    <div class="news">
        <h5><label onclick="alert('Funcionalidad no implementada.'); return false;">Imprimir</label></h5>
    </div>
</div>

<?php end_slot() ?>

<div id="barraDetalles">
    <?php include_partial('detallePropietario', array('propietario' => $propietario)) ?>
</div>

<div id="barraBotones">
    <?php echo button_to('Volver', 'propietario/index', 'class= botonDerecho') ?>
    <input class="botonCentro" value="Eliminar" type="button" onclick="showDeleteDialog('Confirmación', '<?php echo url_for('propietario/erase?id=' . $propietario->getId()) ?>', '440', '<?php echo url_for('propietario/delete?id=' . $propietario->getId()) ?>', '<?php echo $csrfToken ?>'); return false;" />
    <input class="botonIzquierdo" value="Modificar" type="button" onclick="showEditDialog('Modificar Propietario', '<?php echo url_for('propietario/edit?id=' . $propietario->getId()) ?>', '400', fValidatePropietario, fOkPropietario); return false;" />
</div>

<div id="barraInfoAdicional"></div>

<div id="tablasAdicionales">
    <h4 class="inner">Empresas</h4>
    <div id="div-tabla-empresas" class="tablaAdicional" >
        <?php include_partial('listaEmpresas', array('propietario' => $propietario)) ?>
    </div>

</div>