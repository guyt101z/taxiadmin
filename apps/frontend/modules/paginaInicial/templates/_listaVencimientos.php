<table class="table">
    <thead>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$DOCUMENTO ?></th>
            <th><?php echo EtiquetasFrontEnd::$FECHA_DE_VENCIMIENTO ?></th>
            <th><?php echo EtiquetasFrontEnd::$PERTENECE_A ?></th>
            <th><?php echo EtiquetasFrontEnd::$IMPORTE ?></th>
            <th><?php echo EtiquetasFrontEnd::$ACCIONES ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($multas as $multa): ?>
            <tr>
                <td>Multa</td>
                <td><?php echo $multa->getFechaVencimiento() ?></td>
                <td><?php echo $multa->getMovil()->getMatricula() ?></td>
                <td><?php echo $multa->getCosto() ?></td>
                <td colspan="2" >
                    <input title="Ver Información" src="/images/app/icons/view.gif" type="image" onclick="showViewDialog('Información Multa', '<?php echo url_for('multa/show?id=' . $multa->getId()) ?>', '400'); return false;" />
                    <input title="Marcar como pago" src="/images/app/icons/ok_azul.png" type="image" onclick="showEditDialog('Marcar como pago', '<?php echo url_for('multa/marcarPago?id=' . $multa->getId()) ?>', '400', fValidateNone, fOkVencimiento); return false;" />
                </td>
            </tr>
        <?php endforeach; ?>
        <?php foreach ($choferesLibretaConducir as $chofer): ?>
            <tr>
                <td>Libreta de Conducir</td>
                <td><?php echo $chofer->getVencimientoLibretaConducir() ?></td>
                <td><?php echo $chofer->getNombreCompleto() ?></td>
                <td><?php echo ConstantesFrontEnd::$VALOR_LIBRETA_DE_CONDUCIR ?></td>
                <td colspan="2" >
                    <input title="Ver Información" src="/images/app/icons/view.gif" type="image" onclick="showViewDialog('Información Chofer', '<?php echo url_for('chofer/detalleChofer?id=' . $chofer->getId()) ?>', '400'); return false;" />
                    <input title="Marcar como pago" src="/images/app/icons/ok_azul.png" type="image" onclick="showEditDialog('Marcar como pago', '<?php echo url_for('chofer/marcarPagoLibreta?id=' . $chofer->getId()) ?>', '450', fValidateNone, fOkVencimiento); return false;" />
                </td>
            </tr>
        <?php endforeach; ?>
        <?php foreach ($choferesCarneSalud as $chofer): ?>
            <tr>
                <td>Carné de Salud</td>
                <td><?php echo $chofer->getVencimientoCarneSalud() ?></td>
                <td><?php echo $chofer->getNombreCompleto() ?></td>
                <td><?php echo ConstantesFrontEnd::$VALOR_CARNE_DE_SALUD ?></td>
                <td colspan="2" >
                    <input title="Ver Información" src="/images/app/icons/view.gif" type="image" onclick="showViewDialog('Información Chofer', '<?php echo url_for('chofer/detalleChofer?id=' . $chofer->getId()) ?>', '400'); return false;" />
                    <input title="Marcar como pago" src="/images/app/icons/ok_azul.png" type="image" onclick="showEditDialog('Marcar como pago', '<?php echo url_for('chofer/marcarPagoCarneSalud?id=' . $chofer->getId()) ?>', '450', fValidateNone, fOkVencimiento); return false;" />
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>