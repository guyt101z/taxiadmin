<table class="table">
    <thead>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$FECHA ?></th>
            <th><?php echo EtiquetasFrontEnd::$MONTO ?></th>
            <th><?php echo EtiquetasFrontEnd::$DETALLE ?></th>
            <th colspan="2"> <?php echo EtiquetasFrontEnd::$ACCIONES ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Adelanto->getPagoadelantos() as $pago): ?>
            <tr>
                <td><?php echo $pago->getFecha() ?></td>
                <td><?php echo $pago->getMonto() ?></td>
                <td><?php echo $pago->getDetalle() ?></td>
                <td colspan="2">
                    <input title="Eliminar" src="/images/app/icons/delete.png" type="image" onclick="showDeleteDialog('Confirmación', '<?php echo url_for('pagoAdelanto/erase?id=' . $pago->getId()) ?>', '440', '<?php echo url_for('pagoAdelanto/delete?id=' . $pago->getId()) ?>', '<?php echo $csrfToken ?>', fOkPagoAdelanto); return false;" />
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>