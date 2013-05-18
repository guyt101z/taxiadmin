<h1>Edit Usuario</h1>

<?php if ($sf_user->getFlash("error")): ?>
    <div class="error"><?php echo $sf_user->getFlash("error"); ?></div>
<?php endif; ?>

<?php include_partial('form', array('form' => $form)) ?>
