<table>
    <tbody>
        <tr>
            <th colspan="2">INFORMACIÓN PERSONAL</th>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$CEDULA ?></th>
            <td><?php echo UtilFrontEnd::formatoCedula($chofer->getCedula()) ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$NOMBRE ?></th>
            <td><?php echo $chofer->getNombre() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$APELLIDO ?></th>
            <td><?php echo $chofer->getApellidos() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$DIRECCION ?></th>
            <td><?php echo $chofer->getDireccion() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$TELEFONO ?></th>
            <td><?php echo UtilFrontEnd::formatoTelefono($chofer->getTelefono()) ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$CELULAR ?></th>
            <td><?php echo UtilFrontEnd::formatoCelular($chofer->getCelular()) ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$EMAIL ?></th>
            <td>
                <?php if ($chofer->getEmail()): ?>
                    <?php echo $chofer->getEmail() ?>
                    <a href="mailto:<?php echo $chofer->getEmail() ?>">
                        <?php echo image_tag('app/icons/email.png', 'alt=email title="Enviar email"') ?>
                    </a>
                <?php endif ?>
            </td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$VENCIMIENTO_LIBRETA_CONDUCIR ?></th>
            <td><?php echo $chofer->getVencimientolibretaconducir() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$VENCIMIENTO_CARNE_SALUD ?></th>
            <td><?php echo $chofer->getVencimientocarnesalud() ?></td>
        </tr>
    </tbody>
</table>
