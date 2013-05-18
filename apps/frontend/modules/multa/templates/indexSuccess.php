<h1>Multas List</h1>

<table>
  <thead>
    <tr>
      <th>Idchofer</th>
      <th>Idmovil</th>
      <th>Fecha</th>
      <th>Descripcion</th>
      <th>Esquina</th>
      <th>Responsable</th>
      <th>Costo</th>
      <th>Fechapago</th>
      <th>Fechaalta</th>
      <th>Fechabaja</th>
      <th>Habilitado</th>
      <th>Usuario</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($multas as $multa): ?>
    <tr>
      <td><a href="<?php echo url_for('multa/show?idchofer='.$multa->getIdchofer().'&idmovil='.$multa->getIdmovil().'&fecha='.$multa->getFecha()) ?>"><?php echo $multa->getIdchofer() ?></a></td>
      <td><a href="<?php echo url_for('multa/show?idchofer='.$multa->getIdchofer().'&idmovil='.$multa->getIdmovil().'&fecha='.$multa->getFecha()) ?>"><?php echo $multa->getIdmovil() ?></a></td>
      <td><a href="<?php echo url_for('multa/show?idchofer='.$multa->getIdchofer().'&idmovil='.$multa->getIdmovil().'&fecha='.$multa->getFecha()) ?>"><?php echo $multa->getFecha() ?></a></td>
      <td><?php echo $multa->getDescripcion() ?></td>
      <td><?php echo $multa->getEsquina() ?></td>
      <td><?php echo $multa->getResponsable() ?></td>
      <td><?php echo $multa->getCosto() ?></td>
      <td><?php echo $multa->getFechapago() ?></td>
      <td><?php echo $multa->getFechaalta() ?></td>
      <td><?php echo $multa->getFechabaja() ?></td>
      <td><?php echo $multa->getHabilitado() ?></td>
      <td><?php echo $multa->getUsuario() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('multa/new') ?>">New</a>
