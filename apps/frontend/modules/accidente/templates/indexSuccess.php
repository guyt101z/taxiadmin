<h1>Accidentes List</h1>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Idchofer</th>
            <th>Idmovil</th>
            <th>Fecha</th>
            <th>Responsable</th>
            <th>Esquina</th>
            <th>Heridos</th>
            <th>Descripcion</th>
            <th>Fechaalta</th>
            <th>Fechabaja</th>
            <th>Habilitado</th>
            <th>Usuario</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Accidentes as $Accidente): ?>
            <tr>
                <td><a href="<?php echo url_for('accidente/show?id=' . $Accidente->getId()) ?>"><?php echo $Accidente->getId() ?></a></td>
                <td><?php echo $Accidente->getIdchofer() ?></td>
                <td><?php echo $Accidente->getIdmovil() ?></td>
                <td><?php echo $Accidente->getFecha() ?></td>
                <td><?php echo $Accidente->getResponsable() ?></td>
                <td><?php echo $Accidente->getEsquina() ?></td>
                <td><?php echo $Accidente->getHeridos() ?></td>
                <td><?php echo $Accidente->getDescripcion() ?></td>
                <td><?php echo $Accidente->getFechaalta() ?></td>
                <td><?php echo $Accidente->getFechabaja() ?></td>
                <td><?php echo $Accidente->getHabilitado() ?></td>
                <td><?php echo $Accidente->getUsuario() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="<?php echo url_for('accidente/new') ?>">New</a>
