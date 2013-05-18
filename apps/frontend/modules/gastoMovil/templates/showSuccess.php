<table>
    <tbody>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$MOVIL ?></th>
            <td><?php echo $GastoMovil->getMovil()->getMatricula() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$FECHA ?></th>
            <td><?php echo $GastoMovil->getFecha() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$COSTO ?></th>
            <td><?php echo $GastoMovil->getCosto() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$DETALLE ?></th>
            <td><?php echo $GastoMovil->getDetalle() ?></td>
        </tr>
    </tbody>
</table>