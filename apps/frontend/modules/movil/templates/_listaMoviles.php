<table class="table">
    <thead>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$MATRICULA ?></th>
            <th><?php echo EtiquetasFrontEnd::$MARCA ?></th>
            <th><?php echo EtiquetasFrontEnd::$MODELO ?></th>
            <th><?php echo EtiquetasFrontEnd::$ANIO ?></th>
            <th><?php echo EtiquetasFrontEnd::$NUM_MOVIL ?></th>
            <th><?php echo EtiquetasFrontEnd::$DESPACHO ?></th>
            <th><?php echo EtiquetasFrontEnd::$ACCIONES ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($moviles as $Movil): ?>
            <tr>
                <td><?php echo $Movil->getMatricula() ?></td>
                <td><?php echo $Movil->getMarca() ?></td>
                <td><?php echo $Movil->getModelo() ?></td>
                <td><?php echo $Movil->getAnio() ?></td>
                <td><?php echo $Movil->getNumeromovil() ?></td>
                <td><?php echo $Movil->getDespacho() ?></td>
                <td><?php echo button_to('Ver Información', 'movil/show?id=' . $Movil->getId(), 'class=acciones') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
