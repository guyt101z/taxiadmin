<table class="table">
    <thead>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$FECHA ?></th>
            <th><?php echo EtiquetasFrontEnd::$CHOFER ?></th>
            <th><?php echo EtiquetasFrontEnd::$ESQUINA ?></th>
            <th colspan="2"> <?php echo EtiquetasFrontEnd::$ACCIONES ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($movil->getAccidentes() as $accidente): ?>
            <tr>
                <td><?php echo $accidente->getFecha() ?></td>
                <td><?php echo $accidente->getChofer() ?></td>
                <td><?php echo $accidente->getEsquina() ?></td>
                <td colspan="2">
                    <input title="Ver Información" src="/images/app/icons/view.gif" type="image" onclick="showViewDialog('Información Accidente', '<?php echo url_for('accidente/show?id=' . $accidente->getId()) ?>', '400'); return false;" />
                    <input title="Editar" src="/images/app/icons/edit.png" type="image" onclick="showEditDialog('Editar Accidente', '<?php echo url_for('accidente/edit?id=' . $accidente->getId() . '&idMovil=' . $movil->getId()) ?>', '400', fValidateAccidente, fOkAccidente); return false;" />
                    <input title="Eliminar" src="/images/app/icons/delete.png" type="image" onclick="showDeleteDialog('Confirmación', '<?php echo url_for('accidente/erase?id=' . $accidente->getId()) ?>', '440', '<?php echo url_for('accidente/delete?id=' . $accidente->getId()) ?>', '<?php echo $csrfToken ?>', fOkAccidente); return false;" />
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
