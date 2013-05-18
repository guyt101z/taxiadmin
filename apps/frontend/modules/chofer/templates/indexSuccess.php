<?php use_helper('JavascriptBase'); ?>
<?php use_javascript('common.js') ?>
<?php use_javascript('dialogs.js') ?>
<?php use_javascript('fValidateChofer.js') ?>
<?php use_javascript('chofer_index.js') ?>
<?php echo javascript_tag('var url_lista_choferes = "' . url_for('chofer/listaChoferes') . '"') ?>

<?php slot('sidebar') ?>

<!-- Barra lateral -->
<div class="sidebar" >
    <div class='path'>Choferes</div>
    <div class="news">
        <h5>
            <label onclick="showEditDialog('Chofer', '<?php echo url_for('chofer/new') ?>', '500', fValidateChofer, fOkChofer); return false;">Crear nuevo</label>
        </h5>
    </div>
    <div class="news">
        <h5>
            <a href="<?php echo url_for('chofer/imprimirChoferesPDF') ?>"><label>Imprimir</label></a>
        </h5>
    </div>
</div>

<?php end_slot() ?>

<div id="bodyInicial">
    <?php include_partial('listaChoferes', array('choferes' => $pager->getResults())) ?>

    <?php include_partial('paginado', array('pager' => $pager)) ?>
</div>