<table class="table">
    <thead>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$FECHA ?></th>
            <th><?php echo EtiquetasFrontEnd::$MOVIL ?></th>
            <th><?php echo EtiquetasFrontEnd::$CHOFER ?></th>
            <th><?php echo EtiquetasFrontEnd::$IMPORTE_CHOFER ?></th>
            <th><?php echo EtiquetasFrontEnd::$IMPORTE_MOVIL ?></th>
            <th><?php echo EtiquetasFrontEnd::$RECAUDACION ?></th>
            <th><?php echo EtiquetasFrontEnd::$ACCIONES ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($recaudaciones as $recaudacion): ?>
            <tr>
                <td><?php echo $recaudacion->getFecha() ?></td>
                <td><?php echo $recaudacion->getMovil()->getMatricula() ?></td>
                <td><?php echo $recaudacion->getChofer()->getNombreCompleto() ?></td>
                <td><?php echo $recaudacion->getImporteChofer() ?></td>
                <td><?php echo $recaudacion->getImporteMovil() ?></td>
                <td><?php echo $recaudacion->getRecaudacion() ?></td>
                <td>
                    <input title="Ver Información" src="/images/app/icons/view.gif" type="image" onclick="showViewDialog('Información Recaudación', '<?php echo url_for('recaudacion/show?id=' . $recaudacion->getId()) ?>', '800'); return false;" />
                    <a title="Editar" href="<?php echo url_for('recaudacion/edit?id=' . $recaudacion->getId()) ?>"> <img src="/images/app/icons/edit.png"> </a>
                    <input title="Eliminar" src="/images/app/icons/delete.png" type="image" onclick="showDeleteDialog('Confirmación', '<?php echo url_for('recaudacion/erase?id=' . $recaudacion->getId()) ?>', '440', '<?php echo url_for('recaudacion/delete?id=' . $recaudacion->getId()) ?>', '<?php echo $csrfToken ?>', fOkRecaudacion); return false;" />
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
