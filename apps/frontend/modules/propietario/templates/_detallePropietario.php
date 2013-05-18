<table>
    <tbody>
        <tr>
            <th colspan="2">INFORMACIÓN PERSONAL</th>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$CEDULA ?></th>
            <td><?php echo UtilFrontEnd::formatoCedula($propietario->getCedula()) ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$NOMBRE ?></th>
            <td><?php echo $propietario->getNombre() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$APELLIDO ?></th>
            <td><?php echo $propietario->getApellidos() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$DIRECCION ?></th>
            <td><?php echo $propietario->getDireccion() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$TELEFONO ?></th>
            <td><?php echo UtilFrontEnd::formatoTelefono($propietario->getTelefono()) ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$CELULAR ?></th>
            <td><?php echo UtilFrontEnd::formatoCelular($propietario->getCelular()) ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$EMAIL ?></th>
            <td>
                <?php if ($propietario->getEmail()): ?>
                    <?php echo $propietario->getEmail() ?>
                    <a href="mailto:<?php echo $propietario->getEmail() ?>">
                        <?php echo image_tag('app/icons/email.png', 'alt=email title="Enviar email"') ?>
                    </a>
                <?php endif ?>
            </td>
        </tr>
    </tbody>
</table>
