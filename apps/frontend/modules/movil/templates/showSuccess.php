<?php use_helper('JavascriptBase'); ?>
<?php use_javascript('common.js') ?>
<?php use_javascript('dialogs.js') ?>
<?php use_javascript('fValidateMovil.js') ?>
<?php use_javascript('fValidateGastoMovil.js') ?>
<?php use_javascript('fValidateMulta.js') ?>
<?php use_javascript('fValidateAccidente.js') ?>
<?php use_javascript('fValidateTrabajoTaller.js') ?>
<?php use_javascript('fValidateRecaudacion.js') ?>
<?php use_javascript('movil_show.js') ?>
<?php echo javascript_tag('var url_detalle_movil = "' . url_for('movil/detalleMovil?id=' . $movil->getId()) . '"') ?>
<?php echo javascript_tag('var url_lista_gastos = "' . url_for('movil/listaGastos?id=' . $movil->getId()) . '"') ?>
<?php echo javascript_tag('var url_lista_multas = "' . url_for('movil/listaMultas?id=' . $movil->getId()) . '"') ?>
<?php echo javascript_tag('var url_lista_accidentes = "' . url_for('movil/listaAccidentes?id=' . $movil->getId()) . '"') ?>
<?php echo javascript_tag('var url_lista_trabajosTaller = "' . url_for('movil/listaTrabajosTaller?id=' . $movil->getId()) . '"') ?>
<?php echo javascript_tag('var url_lista_ultimas_recaudaciones = "' . url_for('movil/listaUltimasRecaudaciones?id=' . $movil->getId()) . '"') ?>

<?php slot('sidebar') ?>

<!-- Barra lateral -->
<div class="sidebar" >

    <div class='path'>
        Móviles <?php echo EtiquetasFrontEnd::$SEPARADOR_PATH ?> Detalles
    </div>

    <div class="news">
        <h5>
            <label onclick="showEditDialog('Ingresar Recaudación', '<?php echo url_for('recaudacion/new?idMovil=' . $movil->getId()) ?>', '800', fValidateRecaudacion, fOkRecaudacion); return false;">Ingresar Recaudación</label>
        </h5>
    </div>
    <div class="news">
        <h5>
            <a href="<?php echo url_for('recaudacion/index?idMovil=' . $movil->getId()) ?>"><label>Ver Recaudaciones</label></a>
        </h5>
    </div>
    <div class="news">
        <h5>
            <label onclick="showEditDialog('Ingresar Multa', '<?php echo url_for('multa/new?idMovil=' . $movil->getId()) ?>', '400', fValidateMulta, fOkMulta); return false;">Ingresar Multa</label>
        </h5>
    </div>
    <div class="news">
        <h5>
            <label onclick="showEditDialog('Ingresar Accidente', '<?php echo url_for('accidente/new?idMovil=' . $movil->getId()) ?>', '400', fValidateAccidente, fOkAccidente); return false;">Ingresar Accidente</label>
        </h5>
    </div>
    <div class="news">
        <h5>
            <label onclick="showEditDialog('Ingresar Trabajo de Taller', '<?php echo url_for('trabajoTaller/new?idMovil=' . $movil->getId()) ?>', '500', fValidateTrabajoTaller, fOkTrabajoTaller); return false;">Ingresar Trabajo de Taller</label>
        </h5>
    </div>
    <div class="news">
        <h5>
            <label onclick="showEditDialog('Ingresar Gasto', '<?php echo url_for('gastoMovil/new?idMovil=' . $movil->getId()) ?>', '350', fValidateGastoMovil, fOkGasto); return false;">Ingresar Gasto</label>
        </h5>
    </div>
    <div class="news">
        <h5>
            <a href="<?php echo url_for('movil/imprimirMovilPDF?id=' . $movil->getId()) ?>"><label>Imprimir</label></a>
        </h5>
    </div>
</div>
<?php end_slot() ?>

<div id="barraDetalles">
    <?php include_partial('detalleMovil', array('movil' => $movil)) ?>
</div>

<div id="barraBotones">
    <?php echo button_to('Volver', 'movil/index', 'class= botonDerecho') ?>
    <input class="botonCentro" value="Eliminar" type="button" onclick="showDeleteDialog('Confirmación', '<?php echo url_for('movil/erase?id=' . $movil->getId()) ?>', '440', '<?php echo url_for('movil/delete?id=' . $movil->getId()) ?>', '<?php echo $csrfToken ?>'); return false;" />
    <input class="botonIzquierdo" value="Modificar" type="button" onclick="showEditDialog('Modificar Móvil', '<?php echo url_for('movil/edit?id=' . $movil->getId()) ?>', '400', fValidateMovil, fOkMovil); return false;" />
</div>

<div id="barraInfoAdicional">
    <h4 class="inner">Últimas recaudaciones</h4>
    <div id="div-tabla-ultimas-recaudaciones" class="tablaAdicional" >
        <?php include_partial('listaUltimasRecaudaciones', array('movil' => $movil)) ?>
    </div>
</div>

<div id="tablasAdicionales">

    <h4 class="inner">Gastos</h4>
    <div id="div-tabla-gastos" class="tablaAdicional" >
        <?php include_partial('listaGastos', array('movil' => $movil, 'csrfToken' => $csrfToken)) ?>
    </div>

    <h4 class="inner">Multas</h4>
    <div id="div-tabla-multas" class="tablaAdicional" >
        <?php include_partial('listaMultas', array('movil' => $movil, 'csrfToken' => $csrfToken)) ?>
    </div>

    <h4 class="inner">Accidentes</h4>
    <div id="div-tabla-accidentes" class="tablaAdicional" >
        <?php include_partial('listaAccidentes', array('movil' => $movil, 'csrfToken' => $csrfToken)) ?>
    </div>

    <h4 class="inner">Trabajos de taller</h4>
    <div id="div-tabla-trabajosTaller" class="tablaAdicional" >
        <?php include_partial('listaTrabajosTaller', array('movil' => $movil, 'csrfToken' => $csrfToken)) ?>
    </div>

</div>