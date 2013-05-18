<form id="form" action=" <?php echo url_for('empresa/guardarChofer?id=' . $empresa->getId()) ?> ">
    <table class="table">
        <thead>
            <tr>
                <th><?php echo EtiquetasFrontEnd::$CEDULA ?></th>
                <th><?php echo EtiquetasFrontEnd::$NOMBRE ?></th>
                <th><?php echo EtiquetasFrontEnd::$APELLIDO ?></th>
                <th><?php echo EtiquetasFrontEnd::$SELECCIONAR ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($choferes as $chofer): ?>
                <tr>
                    <td><?php echo $chofer->getCedula() ?></td>
                    <td><?php echo $chofer->getNombre() ?></td>
                    <td><?php echo $chofer->getApellidos() ?></td>
                    <td><input type="checkbox" name="ids[]" value="<?php echo $chofer->getId() ?>" class="batch_checkbox" /> </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>