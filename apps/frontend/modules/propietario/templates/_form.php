<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<p id="validateTips" class="validateTips"></p>
<form id="form" action="<?php echo url_for('propietario/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post">
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table>
        <tbody>
            <?php echo $form ?>
        </tbody>
    </table>
</form>