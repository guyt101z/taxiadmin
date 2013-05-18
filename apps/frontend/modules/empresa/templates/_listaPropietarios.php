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
        <?php foreach ($empresa->getPropietarios() as $propietario): ?>
            <tr>
                <td><?php echo UtilFrontEnd::formatoCedula($propietario->getCedula()) ?></td>
                <td><?php echo $propietario->getNombre() ?></td>
                <td><?php echo $propietario->getApellidos() ?></td>
                <td colspan="2" >
                    <?php echo link_to(image_tag('app/icons/view.gif', 'title="Ver Información"'), 'propietario/show?id=' . $propietario->getId()) ?>
                    <?php echo link_to(image_tag('app/icons/quitar.gif', 'title="Quitar Propietario"'), 'empresa/quitarPropietario?idp=' . $propietario->getId() . '&ide=' . $empresa->getId(), 'confirm=¿Está seguro de quitar el Propietario?') ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
