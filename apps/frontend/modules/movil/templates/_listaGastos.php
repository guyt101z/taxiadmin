<table class="table">
    <thead>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$FECHA ?></th>
            <th><?php echo EtiquetasFrontEnd::$DETALLE ?></th>
            <th><?php echo EtiquetasFrontEnd::$COSTO ?></th>
            <th colspan="2"> <?php echo EtiquetasFrontEnd::$ACCIONES ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($movil->getGastos() as $gasto): ?>
            <tr>
                <td><?php echo $gasto->getFecha() ?></td>
                <td><?php echo $gasto->getDetalle() ?></td>
                <td><?php echo $gasto->getCosto() ?></td>
                <td colspan="2" >
                    <input title="Ver Información" src="/images/app/icons/view.gif" type="image" onclick="showViewDialog('Información Gasto', '<?php echo url_for('gastoMovil/show?id=' . $gasto->getId()) ?>', '350'); return false;" />
                    <input title="Editar" src="/images/app/icons/edit.png" type="image" onclick="showEditDialog('Editar Gasto', '<?php echo url_for('gastoMovil/edit?id=' . $gasto->getId() . '&idMovil=' . $movil->getId()) ?>', '350', fValidateGastoMovil, fOkGasto); return false;" />
                    <input title="Eliminar" src="/images/app/icons/delete.png" type="image" onclick="showDeleteDialog('Confirmación', '<?php echo url_for('gastoMovil/erase?id=' . $gasto->getId()) ?>', '440', '<?php echo url_for('gastoMovil/delete?id=' . $gasto->getId()) ?>', '<?php echo $csrfToken ?>', fOkGasto); return false;" />
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
