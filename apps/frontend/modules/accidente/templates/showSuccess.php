<table>
    <tbody>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$CHOFER ?></th>
            <td><?php echo $Accidente->getChofer()->getNombreCompleto() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$MOVIL ?></th>
            <td><?php echo $Accidente->getMovil()->getMatricula() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$FECHA ?></th>
            <td><?php echo $Accidente->getFecha() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$RESPONSABLE ?></th>
            <td><?php echo $Accidente->getResponsable() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$ESQUINA ?></th>
            <td><?php echo $Accidente->getEsquina() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$HERIDOS ?></th>
            <td><?php echo $Accidente->getHeridos() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$DEDUCIBLE ?></th>
            <td><?php echo $Accidente->getDeducible() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$DESCRIPCION ?></th>
            <td><?php echo $Accidente->getDescripcion() ?></td>
        </tr>
    </tbody>
</table>