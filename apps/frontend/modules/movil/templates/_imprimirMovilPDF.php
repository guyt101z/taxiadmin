<table border="1">
    <tbody>
        <tr>
            <th colspan="2">INFORMACIÓN DEL MÓVIL</th>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$MATRICULA ?></th>
            <td><?php echo $movil->getMatricula() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$MARCA ?></th>
            <td><?php echo $movil->getMarca() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$MODELO ?></th>
            <td><?php echo $movil->getModelo() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$ANIO ?></th>
            <td><?php echo $movil->getAnio() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$NUM_CHASIS ?></th>
            <td><?php echo $movil->getNumerochasis() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$COMBUSTIBLE ?></th>
            <td><?php echo $movil->getCombustible() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$NUM_MOVIL ?></th>
            <td><?php echo $movil->getNumeromovil() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$DESPACHO ?></th>
            <td><?php echo $movil->getDespacho() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$KM_INICIALES ?></th>
            <td><?php echo $movil->getKminiciales() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$EMPRESA ?></th>
            <td><?php echo $movil->getEmpresa() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$ASEGURADORA ?></th>
            <td><?php echo $movil->getAseguradora() ?></td>
        </tr>
    </tbody>
</table>

<h4>Gastos</h4>
<table border="1">
    <thead>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$FECHA ?></th>
            <th><?php echo EtiquetasFrontEnd::$DETALLE ?></th>
            <th><?php echo EtiquetasFrontEnd::$COSTO ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($movil->getGastos() as $gasto): ?>
            <tr>
                <td><?php echo $gasto->getFecha() ?></td>
                <td><?php echo $gasto->getDetalle() ?></td>
                <td><?php echo $gasto->getCosto() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h4>Multas</h4>
<table border="1">
    <thead>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$FECHA ?></th>
            <th><?php echo EtiquetasFrontEnd::$CHOFER ?></th>
            <th><?php echo EtiquetasFrontEnd::$COSTO ?></th>
            <th><?php echo EtiquetasFrontEnd::$VENCIMIENTO ?></th>
            <th><?php echo EtiquetasFrontEnd::$FECHA_PAGO ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($movil->getMultas() as $multa): ?>
            <tr>
                <td><?php echo $multa->getFecha() ?></td>
                <td><?php echo $multa->getChofer()->getNombreCompleto() ?></td>
                <td><?php echo $multa->getCosto() ?></td>
                <td><?php echo $multa->getFechavencimiento() ?></td>
                <?php if ($multa->getPago()): ?>
                    <td><?php echo $multa->getFechaPago() ?></td>
                <?php else: ?>
                    <td>Pendiente de pago</td>
                <?php endif ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>