<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<p id="validateTips" class="validateTips"></p>    
<form id="form" action="<?php echo url_for('recaudacion/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" method="post">
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>
    <table>
        <tbody>
            <?php $cont = 1; ?>
            <?php foreach ($form as $widget): ?>
                <?php if (!$widget->isHidden()) : ?> 
                    <?php if (($cont % 2) == 1) : ?>
                        <tr>
                    <?php endif ?>

                        <th><?php echo $widget->renderLabel() ?></th>
                        <td>
                            <?php echo $widget->renderError() ?>
                            <?php echo $widget->render() ?>
                        </td>

                    <?php if (($cont % 2) == 0) : ?>
                        </tr>
                    <?php endif ?>
                    <?php $cont++; ?>
                <?php else : ?>
                    <?php echo $widget->render() ?>
                <?php endif ?>
            <?php endforeach ?>
        </tbody>
    </table>
</form>