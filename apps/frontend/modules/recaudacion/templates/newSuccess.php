<?php use_javascript('fValidateRecaudacion.js') ?>

<?php if ($sf_user->getFlash("success")): ?>
  <div class="success"> <?php echo $sf_user->getFlash('success') ?> </div>
<?php endif; ?>

<?php slot('sidebar') ?>
<!-- Barra lateral -->
<div class="sidebar" >

    <div class='path'>Ingresar Recacudación</div>

    <div class="news">
        <h5>
            <a href="<?php echo url_for('paginaInicial/index') ?>"><label>Vencimientos</label></a>
        </h5>
    </div>
</div>
<?php end_slot() ?>

<div id="bodyInicial">
	<?php include_partial('form', array('form' => $form)) ?>
</div>