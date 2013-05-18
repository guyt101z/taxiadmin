<h1>GastoEmpresas List</h1>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Idempresa</th>
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
        <?php foreach ($GastoEmpresas as $GastoEmpresa): ?>
            <tr>
                <td><a href="<?php echo url_for('gastoEmpresa/show?id=' . $GastoEmpresa->getId()) ?>"><?php echo $GastoEmpresa->getId() ?></a></td>
                <td><?php echo $GastoEmpresa->getIdempresa() ?></td>
                <td><?php echo $GastoEmpresa->getFecha() ?></td>
                <td><?php echo $GastoEmpresa->getCosto() ?></td>
                <td><?php echo $GastoEmpresa->getDetalle() ?></td>
                <td><?php echo $GastoEmpresa->getFechaalta() ?></td>
                <td><?php echo $GastoEmpresa->getFechabaja() ?></td>
                <td><?php echo $GastoEmpresa->getHabilitado() ?></td>
                <td><?php echo $GastoEmpresa->getUsuario() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="<?php echo url_for('gastoEmpresa/new') ?>">New</a>
