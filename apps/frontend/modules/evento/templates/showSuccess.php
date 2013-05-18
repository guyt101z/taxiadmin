<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $evento->getId() ?></td>
    </tr>
    <tr>
      <th>Idusuario:</th>
      <td><?php echo $evento->getIdusuario() ?></td>
    </tr>
    <tr>
      <th>Evento:</th>
      <td><?php echo $evento->getEvento() ?></td>
    </tr>
    <tr>
      <th>Fecha:</th>
      <td><?php echo $evento->getFecha() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('evento/edit?id='.$evento->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('evento/index') ?>">List</a>
