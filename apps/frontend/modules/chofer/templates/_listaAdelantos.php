<table class="table">
    <thead>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$FECHA ?></th>
            <th><?php echo EtiquetasFrontEnd::$MONTO ?></th>
            <th><?php echo EtiquetasFrontEnd::$SALDO ?></th>
            <th colspan="2"> <?php echo EtiquetasFrontEnd::$ACCIONES ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($chofer->getAdelantos() as $adelanto): ?>
        <tr>
            <td><?php echo $adelanto->getFecha() ?></td>
            <td><?php echo $adelanto->getMonto() ?></td>
            <td><?php echo $adelanto->getSaldo() ?></td>
            <td colspan="2">
                <?php echo link_to(image_tag('app/icons/view.gif', 'title="Ver Información"'), 'adelanto/show?idAdelanto=' . $adelanto->getId() . '&idChofer=' . $chofer->getId()) ?>
                <input title="Editar" src="/images/app/icons/edit.png" type="image" onclick="showEditDialog('Editar Adelanto', '<?php echo url_for('adelanto/edit?id=' . $adelanto->getId() . '&idChofer=' . $chofer->getId()) ?>', '350', fValidateAdelanto, fOkAdelanto); return false;" />
                <input title="Eliminar" src="/images/app/icons/delete.png" type="image" onclick="showDeleteDialog('Confirmación', '<?php echo url_for('adelanto/erase?id=' . $adelanto->getId()) ?>', '440', '<?php echo url_for('adelanto/delete?id=' . $adelanto->getId()) ?>', '<?php echo $csrfToken ?>', fOkAdelanto); return false;" />
                <?php if($adelanto->getSaldo() > 0): ?>
                    <input title="Agregar Pago" src="/images/app/icons/add.gif" type="image" onclick="showEditDialog('Agregar Pago de Adelanto', '<?php echo url_for('pagoAdelanto/new?idAdelanto='. $adelanto->getId()) ?>', '350', fValidatePagoAdelanto, fOkPagoAdelanto); return false;" />
                <?php endif ?>
            </td>
        </tr>
        <?php endforeach; ?>
</tbody>
</table>
