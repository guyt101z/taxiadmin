<?php use_helper('JavascriptBase'); ?>
<?php use_javascript('common.js') ?>
<?php use_javascript('dialogs.js') ?>
<?php use_javascript('fValidateEmpresa.js') ?>
<?php use_javascript('fValidateGastoEmpresa.js') ?>
<?php use_javascript('empresa_show.js') ?>
<?php echo javascript_tag('var url_detalle_empresa = "' . url_for('empresa/detalleEmpresa?id=' . $empresa->getId()) . '"') ?>
<?php echo javascript_tag('var url_lista_gastos = "' . url_for('empresa/listaGastos?id=' . $empresa->getId()) . '"') ?>
<?php echo javascript_tag('var url_lista_propietarios = "' . url_for('empresa/listaPropietarios?id=' . $empresa->getId()) . '"') ?>
<?php echo javascript_tag('var url_lista_moviles = "' . url_for('empresa/listaMoviles?id=' . $empresa->getId()) . '"') ?>
<?php echo javascript_tag('var url_lista_choferes = "' . url_for('empresa/listaChoferes?id=' . $empresa->getId()) . '"') ?>

<?php slot('sidebar') ?>

<!-- Barra lateral -->
<div class="sidebar" >

    <div class='path'>
        Empresas <?php echo EtiquetasFrontEnd::$SEPARADOR_PATH ?> Detalles
    </div>

    <div class="news">
        <h5>
            <label onclick="alert('Funcionalidad no implementada.'); return false;">Ver cierres de mes</label>
        </h5>
    </div>
    <div class="news">
        <h5>
            <label onclick="showEditDialog('Ingresar Gasto', '<?php echo url_for('gastoEmpresa/new?idEmpresa=' . $empresa->getId()) ?>', '350', fValidateGastoEmpresa, fOkGasto); return false;">Ingresar Gasto</label>
        </h5>
    </div>
    <div class="news">
        <h5>
            <label onclick="showEditDialog('Agregar Propietario', '<?php echo url_for('empresa/agregarPropietario?id=' . $empresa->getId()) ?>', '600', fValidateNone, fOkAgregarPropietario); return false;">Agregar Propietario</label>
        </h5>
    </div>
    <div class="news">
        <h5>
            <label onclick="showEditDialog('Agregar Móvil', '<?php echo url_for('empresa/agregarMovil?id=' . $empresa->getId()) ?>', '600', fValidateNone, fOkAgregarMovil); return false;">Agregar Móvil</label>
        </h5>
    </div>
    <div class="news">
        <h5>
            <label onclick="showEditDialog('Agregar Chofer', '<?php echo url_for('empresa/agregarChofer?id=' . $empresa->getId()) ?>', '600', fValidateNone, fOkAgregarChofer); return false;">Agregar Chofer</label>
        </h5>
    </div>
    <div class="news">
        <h5>
            <label onclick="alert('Funcionalidad no implementada.'); return false;">Imprimir</label>
        </h5>
    </div>
</div>

<?php end_slot() ?>

<div id="barraDetalles">
    <?php include_partial('detalleEmpresa', array('empresa' => $empresa)) ?>
</div>

<div id="barraBotones">
    <?php echo button_to('Volver', 'empresa/index', 'class= botonDerecho') ?>
    <input class="botonCentro" value="Eliminar" type="button" onclick="showDeleteDialog('Confirmación', '<?php echo url_for('empresa/erase?id=' . $empresa->getId()) ?>', '440', '<?php echo url_for('empresa/delete?id=' . $empresa->getId()) ?>', '<?php echo $csrfToken ?>'); return false;" />
    <input class="botonIzquierdo" value="Modificar" type="button" onclick="showEditDialog('Modificar Móvil', '<?php echo url_for('empresa/edit?id=' . $empresa->getId()) ?>', '400', fValidateEmpresa, fOkEmpresa); return false;" />
</div>

<div id="barraInfoAdicional">
    <h4 class="inner">Últimos cierres de Mes</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Mes</th>
                <th>Cierre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<div id="tablasAdicionales">

    <h4 class="inner">Gastos</h4>
    <div id="div-tabla-gastos" class="tablaAdicional" >
        <?php include_partial('listaGastos', array('empresa' => $empresa, 'csrfToken' => $csrfToken)) ?>
    </div>

    <h4 class="inner">Propietarios</h4>
    <div id="div-tabla-propietarios" class="tablaAdicional" >
        <?php include_partial('listaPropietarios', array('empresa' => $empresa)) ?>
    </div>

    <h4 class="inner">Móviles</h4>
    <div id="div-tabla-moviles" class="tablaAdicional" >
        <?php include_partial('listaMoviles', array('empresa' => $empresa)) ?>
    </div>

    <h4 class="inner" >Choferes</h4>
    <div id="div-tabla-choferes" class="tablaAdicional" >
        <?php include_partial('listaChoferes', array('empresa' => $empresa)) ?>
    </div>

</div>