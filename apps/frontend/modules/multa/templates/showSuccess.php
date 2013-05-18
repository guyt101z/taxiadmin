<table>
    <tbody>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$CHOFER ?></th>
            <td><?php echo $multa->getChofer()->getNombreCompleto() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$MOVIL ?></th>
            <td><?php echo $multa->getMovil()->getMatricula() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$FECHA ?></th>
            <td><?php echo $multa->getFecha() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$DESCRIPCION ?></th>
            <td><?php echo $multa->getDescripcion() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$ESQUINA ?></th>
            <td><?php echo $multa->getEsquina() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$RESPONSABLE ?></th>
            <td><?php echo $multa->getResponsable() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$COSTO ?></th>
            <td><?php echo $multa->getCosto() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$VENCIMIENTO ?></th>
            <td><?php echo $multa->getFechavencimiento(); ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$FECHA_PAGO ?></th>
            <?php if ($multa->getPago()): ?>
                <td><?php echo $multa->getFechaPago() ?></td>
            <?php else: ?>
                <td>Pendiente de pago</td>
            <?php endif ?>
        </tr>
    </tbody>
</table>