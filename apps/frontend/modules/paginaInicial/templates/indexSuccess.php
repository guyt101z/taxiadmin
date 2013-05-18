<?php use_helper('JavascriptBase'); ?>
<?php use_javascript('common.js') ?>
<?php use_javascript('dialogs.js') ?>
<?php use_javascript('fValidateMulta.js') ?>
<?php use_javascript('fValidateAccidente.js') ?>
<?php use_javascript('fValidateRecaudacion.js') ?>
<?php use_javascript('paginaInicial_index.js') ?>
<?php echo javascript_tag('var url_lista_vencimientos = "' . url_for('paginaInicial/listaVencimientos') . '"') ?>

<?php slot('sidebar') ?>

<!-- Barra lateral -->
<div class="sidebar" >

    <div class='path'>Inicio</div>

    <div class="news">
        <h5>
            <a href="<?php echo url_for('paginaInicial/index') ?>"><label>Vencimientos</label></a>
        </h5>
    </div>
    <div class="news">    
        <h5>
            <a href="<?php echo url_for('paginaInicial/imprimirVencimientosPDF') ?>"><label>Imprimir Vencimientos</label></a>
            <!-- <label onclick="alert('Funcionalidad no implementada.'); return false;">Imprimir Vencimientos</label> -->
        </h5>
    </div>
    <div class="news">
        <h5>
            <label onclick="showEditDialog('Ingresar Recaudación', '<?php echo url_for('recaudacion/new') ?>', '800', fValidateRecaudacion, fOkRecaudacion); return false;">Ingresar Recaudación</label>
        </h5>
    </div>
    <div class="news">
        <h5>
            <label onclick="showEditDialog('Ingresar Multa', '<?php echo url_for('multa/new') ?>', '400', fValidateMulta, fOkMulta); return false;">Ingresar Multa</label>
        </h5>
    </div>
    <div class="news">
        <h5>
            <label onclick="showEditDialog('Ingresar Accidente', '<?php echo url_for('accidente/new') ?>', '400', fValidateAccidente, fOkAccidente); return false;">Ingresar Accidente</label>
        </h5>
    </div>
    <div class="news">
        <h5>
            <label onclick="alert('Funcionalidad no implementada.'); return false;">Notas</label>
        </h5>
    </div>
    <div class="news">
        <h5>
            <!-- <a href="<?php echo url_for('paginaInicial/calendario') ?>"><label>Calendario</label></a> -->
            <label onclick="alert('Funcionalidad no implementada.'); return false;">Calendario</label>
        </h5>
    </div>
    <div class="news">
        <h5>
            <!-- <label onclick="alert('Funcionalidad no implementada.'); return false;">Gráficas</label> -->
            <label onclick="alert('Funcionalidad no implementada.'); return false;">Gráficas</label>
        </h5>
    </div>
</div>
<?php end_slot() ?>

<div id="bodyInicial">
    <?php include_partial('listaVencimientos', array('multas' => $multas, 'choferesLibretaConducir' => $choferesLibretaConducir, 'choferesCarneSalud' => $choferesCarneSalud)) ?>
</div>