<form id="form" action="<?php echo url_for('empresa/guardarPropietario?id=' . $empresa->getId()) ?>">
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
            <?php foreach ($propietarios as $propietario): ?>
                <tr>
                    <td><?php echo $propietario->getCedula() ?></td>
                    <td><?php echo $propietario->getNombre() ?></td>
                    <td><?php echo $propietario->getApellidos() ?></td>
                    <td><input type="checkbox" name="ids[]" value="<?php echo $propietario->getId() ?>" class="batch_checkbox" /></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>