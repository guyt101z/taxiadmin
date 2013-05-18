<table class="table">
    <thead>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$FECHA ?></th>
            <th><?php echo EtiquetasFrontEnd::$RECAUDACION ?></th>
            <th colspan="2"> <?php echo EtiquetasFrontEnd::$ACCIONES ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($movil->getUltimasRecaudaciones() as $recaudacion): ?>
            <tr>
                <td><?php echo $recaudacion->getFecha() ?></td>
                <td><?php echo $recaudacion->getRecaudacion() ?></td>
                <td colspan="2">
                    <input class="acciones" value="Ver Información" type="button" onclick="showViewDialog('Información Recaudación', '<?php echo url_for('recaudacion/show?id=' . $recaudacion->getId()) ?>', '800'); return false;" />
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
