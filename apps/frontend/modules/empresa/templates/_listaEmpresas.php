<table class="table">
    <thead>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$NOMBRE ?></th>
            <th><?php echo EtiquetasFrontEnd::$RAZON_SOCIAL ?></th>
            <th><?php echo EtiquetasFrontEnd::$ACCIONES ?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($empresas as $empresa): ?>
            <tr>
                <td><?php echo $empresa->getNombre() ?></td>
                <td><?php echo $empresa->getRazonsocial() ?></td>
                <td><?php echo button_to('Ver Información', 'empresa/show?id=' . $empresa->getId(), 'class= acciones') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
