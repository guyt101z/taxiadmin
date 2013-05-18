<table>
    <tbody>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$EMPRESA ?></th>
            <td><?php echo $GastoEmpresa->getEmpresa()->getNombre() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$FECHA ?></th>
            <td><?php echo $GastoEmpresa->getFecha() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$COSTO ?></th>
            <td><?php echo $GastoEmpresa->getCosto() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$DETALLE ?></th>
            <td><?php echo $GastoEmpresa->getDetalle() ?></td>
        </tr>
    </tbody>
</table>