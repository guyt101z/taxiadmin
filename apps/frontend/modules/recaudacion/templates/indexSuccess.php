<?php use_helper('JavascriptBase'); ?>
<?php use_javascript('common.js') ?>
<?php use_javascript('dialogs.js') ?>
<?php use_javascript('fValidateRecaudacion.js') ?>
<?php use_javascript('recaudacion_index.js') ?>
<?php echo javascript_tag('var url_lista_recaudaciones = "' . url_for('recaudacion/listaRecaudaciones') . '"') ?>

<?php slot('sidebar') ?>

<!-- Barra lateral -->
<div class="sidebar" >

    <div class='path'>Recaudaciones</div>

    <div class="news">
        <h5>
            <!-- <label onclick="showEditDialog('Ingresar Recaudación', '<?php echo url_for('recaudacion/new') ?>', '800', fValidateRecaudacion, fOkRecaudacion); return false;">Ingresar Recaudación</label> -->
            <a href="<?php echo url_for('recaudacion/new') ?>"><label>Ingresar Recaudación</label></a>
        </h5>
    </div>
    <div class="news">
        <h5>
            <label onclick="alert('Funcionalidad no implementada.'); return false;">Imprimir</label>
        </h5>
    </div>
</div>

<?php end_slot() ?>

<div id="bodyInicial">
    <?php include_partial('listaRecaudaciones', array('recaudaciones' => $pager->getResults(), 'csrfToken' => $csrfToken, 'movil' => $movil, 'chofer' => $chofer)) ?>

    <?php include_partial('paginado', array('pager' => $pager, 'idMovil' => $idMovil, 'idChofer' => $idChofer)) ?>
</div>
