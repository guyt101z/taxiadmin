<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<p id="validateTips" class="validateTips"></p>
<form id="form" action="<?php echo url_for('sesion/login') ?>" method="post" >
    <table>
        <tbody>
            <?php echo $form ?>
        </tbody>
    </table>
</form>