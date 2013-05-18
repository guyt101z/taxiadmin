<table class="table">
    <thead>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$FECHA ?></th>
            <th><?php echo EtiquetasFrontEnd::$MOVIL ?></th>
            <th><?php echo EtiquetasFrontEnd::$COSTO ?></th>
            <th><?php echo EtiquetasFrontEnd::$VENCIMIENTO ?></th>
            <th><?php echo EtiquetasFrontEnd::$FECHA_PAGO ?></th>
            <th colspan="2"> <?php echo EtiquetasFrontEnd::$ACCIONES ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($chofer->getMultas() as $multa): ?>
            <tr>
                <td><?php echo $multa->getFecha() ?></td>
                <td><?php echo $multa->getMovil() ?></td>
                <td><?php echo $multa->getCosto() ?></td>
                <td><?php echo $multa->getFechaVencimiento() ?></td>
                <?php if ($multa->getPago()): ?>
                    <td><?php echo $multa->getFechaPago() ?></td>
                <?php else: ?>
                    <td>Pendiente de pago</td>
                <?php endif ?>
                <td colspan="2">
                    <input title="Ver Información" src="/images/app/icons/view.gif" type="image" onclick="showViewDialog('Información Multa', '<?php echo url_for('multa/show?id=' . $multa->getId()) ?>', '400'); return false;" />
                    <input title="Editar" src="/images/app/icons/edit.png" type="image" onclick="showEditDialog('Editar Multa', '<?php echo url_for('multa/edit?id=' . $multa->getId() . '&idChofer=' . $chofer->getId()) ?>', '400', fValidateMulta, fOkMulta); return false;" />
                    <input title="Eliminar" src="/images/app/icons/delete.png" type="image" onclick="showDeleteDialog('Confirmación', '<?php echo url_for('multa/erase?id=' . $multa->getId()) ?>', '440', '<?php echo url_for('multa/delete?id=' . $multa->getId()) ?>', '<?php echo $csrfToken ?>', fOkMulta); return false;" />
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
