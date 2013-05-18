<table class="table">
    <thead>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$CEDULA ?></th>
            <th><?php echo EtiquetasFrontEnd::$NOMBRE ?></th>
            <th><?php echo EtiquetasFrontEnd::$APELLIDO ?></th>
            <th colspan="2"> <?php echo EtiquetasFrontEnd::$ACCIONES ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($empresa->getChoferes() as $chofer): ?>
            <tr>
                <td><?php echo UtilFrontEnd::formatoCedula($chofer->getCedula()) ?></td>
                <td><?php echo $chofer->getNombre() ?></td>
                <td><?php echo $chofer->getApellidos() ?></td>
                <td colspan="2">
                    <?php echo link_to(image_tag('app/icons/view.gif', 'title="Ver Información"'), 'chofer/show?id=' . $chofer->getId()) ?>
                    <?php echo link_to(image_tag('app/icons/quitar.gif', 'title="Quitar Chofer"'), 'empresa/quitarChofer?idc=' . $chofer->getId() . '&ide=' . $empresa->getId(), 'confirm=¿Está seguro de quitar el Chofer?') ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
