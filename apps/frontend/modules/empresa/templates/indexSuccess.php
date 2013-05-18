<?php use_helper('JavascriptBase'); ?>
<?php use_javascript('common.js') ?>
<?php use_javascript('dialogs.js') ?>
<?php use_javascript('fValidateEmpresa.js') ?>
<?php use_javascript('empresa_index.js') ?>
<?php echo javascript_tag('var url_lista_empresas = "' . url_for('empresa/listaEmpresas') . '"') ?>

<?php slot('sidebar') ?>

<!-- Barra lateral -->
<div class="sidebar" >

    <div class='path'>Empresas</div>

    <div class="news">
        <h5>
            <label onclick="showEditDialog('Empresa', '<?php echo url_for('empresa/new') ?>', '400', fValidateEmpresa, fOkEmpresa); return false;">Crear nueva</label>
        </h5>
    </div>
    <div class="news">
        <h5>
            <a href="<?php echo url_for('empresa/imprimirEmpresasPDF') ?>"><label>Imprimir</label></a>
        </h5>
    </div>

</div>

<?php end_slot() ?>

<div id="bodyInicial">
    <?php include_partial('listaEmpresas', array('empresas' => $pager->getResults())) ?>

    <?php include_partial('paginado', array('pager' => $pager)) ?>
</div>
