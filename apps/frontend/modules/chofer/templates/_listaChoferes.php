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
        <?php foreach ($choferes as $Chofer): ?>
            <tr>
                <td><?php echo UtilFrontEnd::formatoCedula($Chofer->getCedula()) ?></td>
                <td><?php echo $Chofer->getNombre() ?></td>
                <td><?php echo $Chofer->getApellidos() ?></td>
                <td><?php echo UtilFrontEnd::formatoTelefono($Chofer->getTelefono()) ?></td>
                <td><?php echo UtilFrontEnd::formatoCelular($Chofer->getCelular()) ?></td>
                <td><?php echo button_to('Ver Información', 'chofer/show?id=' . $Chofer->getId(), 'class= acciones') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
