<table class="table">
    <thead>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$NOMBRE ?></th>
            <th><?php echo EtiquetasFrontEnd::$RAZON_SOCIAL ?></th>
            <th colspan="2"> <?php echo EtiquetasFrontEnd::$ACCIONES ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($chofer->getEmpresas() as $empresa): ?>
            <tr>
                <td><?php echo $empresa->getNombre() ?></td>
                <td><?php echo $empresa->getRazonSocial() ?></td>
                <td colspan="2">
                    <?php echo link_to(image_tag('app/icons/view.gif', 'title="Ver Información"'), 'empresa/show?id=' . $empresa->getId()) ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
