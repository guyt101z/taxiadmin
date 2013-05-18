<h1>Adelantos List</h1>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Idchofer</th>
            <th>Fecha</th>
            <th>Monto</th>
            <th>Saldo</th>
            <th>Detalle</th>
            <th>Fechaalta</th>
            <th>Fechabaja</th>
            <th>Habilitado</th>
            <th>Usuario</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Adelantos as $Adelanto): ?>
            <tr>
                <td><a href="<?php echo url_for('adelanto/show?id=' . $Adelanto->getId()) ?>"><?php echo $Adelanto->getId() ?></a></td>
                <td><?php echo $Adelanto->getIdchofer() ?></td>
                <td><?php echo $Adelanto->getFecha() ?></td>
                <td><?php echo $Adelanto->getMonto() ?></td>
                <td><?php echo $Adelanto->getSaldo() ?></td>
                <td><?php echo $Adelanto->getDetalle() ?></td>
                <td><?php echo $Adelanto->getFechaalta() ?></td>
                <td><?php echo $Adelanto->getFechabaja() ?></td>
                <td><?php echo $Adelanto->getHabilitado() ?></td>
                <td><?php echo $Adelanto->getUsuario() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="<?php echo url_for('adelanto/new') ?>">New</a>
