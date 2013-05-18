<?php use_helper('JavascriptBase'); ?>
<?php use_javascript('common.js') ?>
<?php use_javascript('dialogs.js') ?>
<?php use_javascript('fValidatePropietario.js') ?>
<?php use_javascript('propietario_index.js') ?>
<?php echo javascript_tag('var url_lista_propietarios = "' . url_for('propietario/listaPropietarios') . '"') ?>

<?php slot('sidebar') ?>

<!-- Barra lateral -->
<div class="sidebar" >

    <div class='path'>Propietarios</div>

    <div class="news">
        <h5>
            <label onclick="showEditDialog('Propietario', '<?php echo url_for('propietario/new') ?>', '400', fValidatePropietario, fOkPropietario); return false;">Crear nuevo</label>
        </h5>
    </div>
    <div class="news">
        <h5>
            <a href="<?php echo url_for('propietario/imprimirPropietariosPDF') ?>"><label>Imprimir</label></a>
        </h5>
    </div>
</div>

<?php end_slot() ?>

<div id="bodyInicial">
    <?php include_partial('listaPropietarios', array('propietarios' => $pager->getResults())) ?>

    <?php include_partial('paginado', array('pager' => $pager)) ?>
</div>