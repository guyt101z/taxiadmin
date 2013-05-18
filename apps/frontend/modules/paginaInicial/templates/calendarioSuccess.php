<?php use_helper('JavascriptBase'); ?>
<?php use_stylesheet('fullcalendar.css') ?>
<?php use_stylesheet('cupertino/theme.css') ?>
<?php use_javascript('fullcalendar.min.js') ?>
<?php use_javascript('paginaInicial_calendario.js') ?>
<?php echo javascript_tag($sf_data->getRaw('vencimientos')) ?>

<?php slot('sidebar') ?>

<!-- Barra lateral -->
<div class="sidebar" >

    <div class='path'>
        Inicio <?php echo EtiquetasFrontEnd::$SEPARADOR_PATH ?> Calendario
    </div>

    <div class="news">
        <h5><a href="<?php echo url_for('paginaInicial/index') ?>"><label>Volver</label></a></h5>
    </div>
</div>
<?php end_slot() ?>

<div id="bodyInicial">
    <div id='calendar'></div>
</div>