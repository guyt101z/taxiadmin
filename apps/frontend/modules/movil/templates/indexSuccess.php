<?php use_helper('JavascriptBase'); ?>
<?php use_javascript('common.js') ?>
<?php use_javascript('dialogs.js') ?>
<?php use_javascript('fValidateMovil.js') ?>
<?php use_javascript('movil_index.js') ?>
<?php echo javascript_tag('var url_lista_moviles = "' . url_for('movil/listaMoviles') . '"') ?>

<?php slot('sidebar') ?>

<!-- Barra lateral -->
<div class="sidebar" >

    <div class='path'>Móviles</div>

    <div class="news">
        <h5>
            <label onclick="showEditDialog('Móvil', '<?php echo url_for('movil/new') ?>', '400', fValidateMovil, fOkMovil); return false;">Crear nuevo</label>
        </h5>
    </div>
    <div class="news">
        <h5>
            <a href="<?php echo url_for('movil/imprimirMovilesPDF') ?>"><label>Imprimir</label></a>
        </h5>
    </div>
</div>

<?php end_slot() ?>

<div id="bodyInicial">
    <?php include_partial('listaMoviles', array('moviles' => $pager->getResults())) ?>

    <?php include_partial('paginado', array('pager' => $pager)) ?>
</div>
