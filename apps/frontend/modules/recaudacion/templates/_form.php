<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>
<?php use_javascript('common.js') ?>

<p id="validateTips" class="validateTips"></p>    
<form 
    id="form" 
    action="<?php echo url_for('recaudacion/' . ($form->getObject()->isNew() ? 'create' : 'update') . (!$form->getObject()->isNew() ? '?id=' . $form->getObject()->getId() : '')) ?>" 
    method="post"
    onSubmit="return validarRecaudacion(this);">
    <?php if (!$form->getObject()->isNew()): ?>
        <input type="hidden" name="sf_method" value="put" />
    <?php endif; ?>


    <table>
        <tfoot>
            <tr> <td > <button type="submit" class="boton" >Guardar</button> </td> </tr>
        </tfoot>
        <tbody>
            <tr hidden="true" >
                <th> <?php echo $form['_csrf_token']->render() ?> </th>
                <th> <?php echo $form['listaAporteLeyes']->render() ?> </th>
                <th> <?php echo $form['listaPLiquidacion']->render() ?> </th>
            </tr>

            <tr>
                <th> <?php echo $form['fecha']->renderLabel() ?> </th>
                <td>
                    <?php echo $form['fecha']->renderError() ?>
                    <?php echo $form['fecha']->render() ?>
                </td>

                <th><?php echo $form['totalGastos']->renderLabel() ?></th>
                <td>
                    <?php echo $form['totalGastos']->renderError() ?>
                    <?php echo $form['totalGastos']->render() ?>
                </td>
            </tr>

            <tr>
                <th> <?php echo $form['idChofer']->renderLabel() ?> </th>
                <td>
                    <?php echo $form['idChofer']->renderError() ?>
                    <?php echo $form['idChofer']->render() ?>
                </td>

                <th><?php echo $form['importeChofer']->renderLabel() ?></th>
                <td>
                    <?php echo $form['importeChofer']->renderError() ?>
                    <?php echo $form['importeChofer']->render() ?>
                    <span id="p_chofer"></span>
                </td>
            </tr>

            <tr>
                <th> <?php echo $form['idMovil']->renderLabel() ?> </th>
                <td>
                    <?php echo $form['idMovil']->renderError() ?>
                    <?php echo $form['idMovil']->render() ?>
                </td>

                <th><?php echo $form['aporteLeyes']->renderLabel() ?></th>
                <td>
                    <?php echo $form['aporteLeyes']->renderError() ?>
                    <?php echo $form['aporteLeyes']->render() ?>
                    <span id="p_aporte"></span>
                </td>
            </tr>

            <tr>
                <th> <?php echo $form['km']->renderLabel() ?> </th>
                <td>
                    <?php echo $form['km']->renderError() ?>
                    <?php echo $form['km']->render() ?>
                </td>

                <th><?php echo $form['importeMovil']->renderLabel() ?></th>
                <td>
                    <?php echo $form['importeMovil']->renderError() ?>
                    <?php echo $form['importeMovil']->render() ?>
                </td>
            </tr>

            <tr>
                <th> <?php echo $form['recaudacion']->renderLabel() ?> </th>
                <td>
                    <?php echo $form['recaudacion']->renderError() ?>
                    <?php echo $form['recaudacion']->render() ?>
                </td>

                <th> </th>
                <td> </td>
            </tr>

            <tr>
                <th> <?php echo $form['gasto1']->renderLabel() ?> </th>
                <td>
                    <?php echo $form['gasto1']->renderError() ?>
                    <?php echo $form['gasto1']->render() ?>
                </td>

                <th> </th>
                <td> </td>
            </tr>

            <tr>
                <th> <?php echo $form['gasto5']->renderLabel() ?> </th>
                <td>
                    <?php echo $form['gasto5']->renderError() ?>
                    <?php echo $form['gasto5']->render() ?>
                </td>

                <th> </th>
                <td> </td>
            </tr>

            <tr>
                <th> <?php echo $form['gasto4']->renderLabel() ?> </th>
                <td>
                    <?php echo $form['gasto4']->renderError() ?>
                    <?php echo $form['gasto4']->render() ?>
                </td>

                <th> </th>
                <td> </td>
            </tr>

            <tr>
                <th> <?php echo $form['gasto2']->renderLabel() ?> </th>
                <td>
                    <?php echo $form['gasto2']->renderError() ?>
                    <?php echo $form['gasto2']->render() ?>
                </td>

                <th> </th>
                <td> </td>
            </tr>

            <tr>
                <th> <?php echo $form['gasto3']->renderLabel() ?> </th>
                <td>
                    <?php echo $form['gasto3']->renderError() ?>
                    <?php echo $form['gasto3']->render() ?>
                </td>

                <th> </th>
                <td> </td>
            </tr>

            <tr>
                <th> <?php echo $form['gasto6']->renderLabel() ?> </th>
                <td>
                    <?php echo $form['gasto6']->renderError() ?>
                    <?php echo $form['gasto6']->render() ?>
                </td>

                <th> </th>
                <td> </td>
            </tr>
        </tbody>
    </table>

</form>