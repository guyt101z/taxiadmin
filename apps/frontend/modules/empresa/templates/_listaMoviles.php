<table class="table">
    <thead>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$MATRICULA ?></th>
            <th><?php echo EtiquetasFrontEnd::$MODELO ?></th>
            <th><?php echo EtiquetasFrontEnd::$DESPACHO ?></th>
            <th colspan="2"> <?php echo EtiquetasFrontEnd::$ACCIONES ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($empresa->getMoviles() as $movil): ?>
            <tr>
                <td><?php echo $movil->getMatricula() ?></td>
                <td><?php echo $movil->getModelo() ?></td>
                <td><?php echo $movil->getDespacho() ?></td>
                <td colspan="2">
                    <?php echo link_to(image_tag('app/icons/view.gif', 'title="Ver Información"'), 'movil/show?id=' . $movil->getId()) ?>
                    <?php echo link_to(image_tag('app/icons/quitar.gif', 'title="Quitar Móvil"'), 'empresa/quitarMovil?idm=' . $movil->getId() . '&ide=' . $empresa->getId(), 'confirm=¿Está seguro de quitar el Móvil?') ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>