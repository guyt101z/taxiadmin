<table class="table">
    <thead>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$CEDULA ?></th>
            <th><?php echo EtiquetasFrontEnd::$NOMBRE ?></th>
            <th><?php echo EtiquetasFrontEnd::$APELLIDO ?></th>
            <th><?php echo EtiquetasFrontEnd::$TELEFONO ?></th>
            <th><?php echo EtiquetasFrontEnd::$CELULAR ?></th>
            <th><?php echo EtiquetasFrontEnd::$ACCIONES ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($propietarios as $Propietario): ?>
            <tr>
                <td><?php echo UtilFrontEnd::formatoCedula($Propietario->getCedula()) ?></td>
                <td><?php echo $Propietario->getNombre() ?></td>
                <td><?php echo $Propietario->getApellidos() ?></td>
                <td><?php echo UtilFrontEnd::formatoTelefono($Propietario->getTelefono()) ?></td>
                <td><?php echo UtilFrontEnd::formatoCelular($Propietario->getCelular()) ?></td>
                <td><?php echo button_to('Ver Información', 'propietario/show?id=' . $Propietario->getId(), 'class= acciones') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>