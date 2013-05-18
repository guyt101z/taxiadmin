<table>
    <tbody>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$MOVIL ?></th>
            <td><?php echo $TrabajoTaller->getMovil()->getMatricula() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$TALLER ?></th>
            <td><?php echo $TrabajoTaller->getTaller()->getNombre() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$FECHA_INGRESO ?></th>
            <td><?php echo $TrabajoTaller->getFechaingreso() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$MOTIVO_INGRESO ?></th>
            <td><?php echo $TrabajoTaller->getMotivoingreso() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$COSTO_MATERIALES ?></th>
            <td><?php echo $TrabajoTaller->getCostomateriales() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$COSTO_MANO_OBRA ?></th>
            <td><?php echo $TrabajoTaller->getCostomanoobra() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$DETALLE_TRABAJO ?></th>
            <td><?php echo $TrabajoTaller->getDetalletrabajo() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$RESPONSABLE ?></th>
            <td><?php echo $TrabajoTaller->getResponsable() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$TIPO_PAGO ?></th>
            <td><?php echo $TrabajoTaller->getTipopago() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$TOTAL_TRABAJO ?></th>
            <td><?php echo $TrabajoTaller->getTotaltrabajo() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$NUM_FACTURA ?></th>
            <td><?php echo $TrabajoTaller->getNumerofactura() ?></td>
        </tr>
    </tbody>
</table>