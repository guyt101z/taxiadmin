<table>
    <tr>
        <th><?php echo EtiquetasFrontEnd::$FECHA ?></th>
        <td><?php echo $pago->getFecha()?></td>
    </tr>
    <tr>
        <th><?php echo EtiquetasFrontEnd::$MONTO ?></th>
        <td><?php echo $pago->getMonto() ?></td>
    </tr>
    <tr>
        <th><?php echo EtiquetasFrontEnd::$DETALLE ?></th>
        <td><?php echo content_tag('textarea', $pago->getDetalle(), array('class' => 'textareaShow', 'readonly' => true, 'cols' => ConstantesFrontEnd::$SIZE_WIDGET_DESCRIPCION_COLS_DOS, 'rows' => ConstantesFrontEnd::$SIZE_WIDGET_DESCRIPCION_ROWS)) ?></td>
    </tr>
</table>