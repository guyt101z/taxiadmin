<table class="table">
    <thead>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$FECHA_INGRESO ?></th>
            <th><?php echo EtiquetasFrontEnd::$TALLER ?></th>
            <th><?php echo EtiquetasFrontEnd::$TOTAL_TRABAJO ?></th>
            <th colspan="2"> <?php echo EtiquetasFrontEnd::$ACCIONES ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($movil->getTrabajosTaller() as $trabajoTaller): ?>
            <tr>
                <td><?php echo $trabajoTaller->getFechaIngreso() ?></td>
                <td><?php echo $trabajoTaller->getTaller() ?></td>
                <td><?php echo $trabajoTaller->getTotalTrabajo() ?></td>
                <td colspan="2">
                    <input title="Ver Información" src="/images/app/icons/view.gif" type="image" onclick="showViewDialog('Información Trabajo Taller', '<?php echo url_for('trabajoTaller/show?id=' . $trabajoTaller->getId()) ?>', '500'); return false;" />
                    <input title="Editar" src="/images/app/icons/edit.png" type="image" onclick="showEditDialog('Editar Trabajo Taller', '<?php echo url_for('trabajoTaller/edit?id=' . $trabajoTaller->getId() . '&idMovil=' . $movil->getId()) ?>', '500', fValidateTrabajoTaller, fOkTrabajoTaller); return false;" />
                    <input title="Eliminar" src="/images/app/icons/delete.png" type="image" onclick="showDeleteDialog('Confirmación', '<?php echo url_for('trabajoTaller/erase?id=' . $trabajoTaller->getId()) ?>', '440', '<?php echo url_for('trabajoTaller/delete?id=' . $trabajoTaller->getId()) ?>', '<?php echo $csrfToken ?>', fOkTrabajoTaller); return false;" />
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
