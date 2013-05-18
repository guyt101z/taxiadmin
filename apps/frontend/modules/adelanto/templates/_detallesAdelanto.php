
<table>
    <tr>
        <th><?php echo EtiquetasFrontEnd::$CHOFER ?></th>
        <td><?php echo $adelanto->getChofer()->getNombreCompleto() ?></td>

        <th rowspan="5"><?php echo EtiquetasFrontEnd::$DETALLE ?></th>
        <td rowspan="5">
            <?php echo content_tag('textarea', $adelanto->getDetalle(), array('class' => 'textareaShow', 'readonly' => true, 'cols' => ConstantesFrontEnd::$SIZE_WIDGET_DESCRIPCION_COLS_DOS, 'rows' => ConstantesFrontEnd::$SIZE_WIDGET_DESCRIPCION_ROWS)) ?>
        </td>
    </tr>

    <tr>
        <th><?php echo EtiquetasFrontEnd::$FECHA ?></th>
        <td><?php echo $adelanto->getFecha() ?></td>
    </tr>
    <tr>
        <th><?php echo EtiquetasFrontEnd::$MONTO ?></th>
        <td><?php echo $adelanto->getMonto() ?></td>
    </tr>
    <tr>
        <th><?php echo EtiquetasFrontEnd::$SALDO ?></th>
        <td><?php echo $adelanto->getSaldo() ?></td>
    </tr>
</table>

<br><br>

<h4 class="inner">Pagos Realizados</h4>

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
        <?php foreach ($adelanto->getPagoadelantos() as $pago): ?>
        <tr>
            <td><?php echo $pago->getFecha() ?></td>
            <td><?php echo $pago->getMonto() ?></td>
            <td><?php echo substr($pago->getDetalle(), 0, 15) ?></td>
            <td colspan="2">
                <input title="Ver Información" src="/images/app/icons/view.gif" type="image" onclick="showViewDialog('Ver Información', '<?php echo url_for('pagoAdelanto/show?idPago=' . $pago->getId()) ?>', '400'); return false;" />
                <input title="Eliminar" src="/images/app/icons/delete.png" type="image" onclick="showDeleteDialog('Confirmación', '<?php echo url_for('pagoAdelanto/erase?id=' . $pago->getId()) ?>', '440', '<?php echo url_for('pagoAdelanto/delete?id=' . $pago->getId()) ?>', '<?php echo $csrfToken ?>', fOkPagoAdelanto); return false;" />
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>