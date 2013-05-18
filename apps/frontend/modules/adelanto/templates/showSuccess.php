<?php use_helper('JavascriptBase'); ?>
<?php use_javascript('common.js') ?>
<?php use_javascript('dialogs.js') ?>
<?php use_javascript('adelanto_show.js') ?>
<?php use_javascript('fValidatePagoAdelanto.js') ?>
<?php echo javascript_tag('var url_detalles = "' . url_for('adelanto/detalles?idAdelanto=' . $adelanto->getId() . '?idChofer=' . $idChofer ) . '"') ?>

<?php slot('sidebar') ?>

<!-- Barra lateral -->
<div class="sidebar" >

    <div class='path'>
        Adelanto <?php echo EtiquetasFrontEnd::$SEPARADOR_PATH ?> Detalles
    </div>

    <div class="news">
        <h5><a href="<?php echo url_for('chofer/show?id=' . $idChofer) ?>"><label>Volver al Chofer</label></a></h5>
    </div>

    <div class="news">
        <h5><label onclick="showEditDialog('Agregar Pago de Adelanto', '<?php echo url_for('pagoAdelanto/new?idAdelanto='. $adelanto->getId()) ?>', '350', fValidatePagoAdelanto, fOkPagoAdelanto); return false;">Ingresar Pago</label></h5>
    </div>
    <div class="news">
        <h5><label onclick="alert('Funcionalidad no implementada.'); return false;">Imprimir</label></h5>
    </div>
</div>

<?php end_slot() ?>

<div id="bodyInicial">

        <?php include_partial('detallesAdelanto', array('adelanto' => $adelanto, 'csrfToken' => $csrfToken)) ?>

</div>