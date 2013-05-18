<form id="form" action=" <?php echo url_for('empresa/guardarMovil?id=' . $empresa->getId()) ?> ">
    <table class="table">
        <thead>
            <tr>
                <th><?php echo EtiquetasFrontEnd::$MATRICULA ?></th>
                <th><?php echo EtiquetasFrontEnd::$MODELO ?></th>
                <th><?php echo EtiquetasFrontEnd::$NUM_MOVIL ?></th>
                <th><?php echo EtiquetasFrontEnd::$SELECCIONAR ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($moviles as $movil): ?>
                <tr>
                    <td><?php echo $movil->getMatricula() ?></td>
                    <td><?php echo $movil->getModelo() ?></td>
                    <td><?php echo $movil->getNumeromovil() ?></td>
                    <td><input type="checkbox" name="ids[]" value="<?php echo $movil->getId() ?>" class="batch_checkbox" /> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>