<table>
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
