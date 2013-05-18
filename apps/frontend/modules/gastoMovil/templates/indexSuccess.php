<h1>GastoMovils List</h1>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Idmovil</th>
            <th>Fecha</th>
            <th>Costo</th>
            <th>Detalle</th>
            <th>Fechaalta</th>
            <th>Fechabaja</th>
            <th>Habilitado</th>
            <th>Usuario</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($GastoMovils as $GastoMovil): ?>
            <tr>
                <td><a href="<?php echo url_for('gastoMovil/show?id=' . $GastoMovil->getId()) ?>"><?php echo $GastoMovil->getId() ?></a></td>
                <td><?php echo $GastoMovil->getIdmovil() ?></td>
                <td><?php echo $GastoMovil->getFecha() ?></td>
                <td><?php echo $GastoMovil->getCosto() ?></td>
                <td><?php echo $GastoMovil->getDetalle() ?></td>
                <td><?php echo $GastoMovil->getFechaalta() ?></td>
                <td><?php echo $GastoMovil->getFechabaja() ?></td>
                <td><?php echo $GastoMovil->getHabilitado() ?></td>
                <td><?php echo $GastoMovil->getUsuario() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="<?php echo url_for('gastoMovil/new') ?>">New</a>
