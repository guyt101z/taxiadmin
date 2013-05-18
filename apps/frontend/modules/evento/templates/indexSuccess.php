<h1>Eventos List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Idusuario</th>
      <th>Evento</th>
      <th>Fecha</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($eventos as $evento): ?>
    <tr>
      <td><a href="<?php echo url_for('evento/show?id='.$evento->getId()) ?>"><?php echo $evento->getId() ?></a></td>
      <td><?php echo $evento->getIdusuario() ?></td>
      <td><?php echo $evento->getEvento() ?></td>
      <td><?php echo $evento->getFecha() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('evento/new') ?>">New</a>
