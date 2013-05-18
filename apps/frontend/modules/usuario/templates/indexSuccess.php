<h1>Usuarios List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Tipo</th>
      <th>Nombre</th>
      <th>Apellidos</th>
      <th>Celular</th>
      <th>Telefono</th>
      <th>Direccion</th>
      <th>Email</th>
      <th>Clave</th>
      <th>Fechaalta</th>
      <th>Fechabaja</th>
      <th>Habilitado</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($usuarios as $usuario): ?>
    <tr>
      <td><a href="<?php echo url_for('usuario/show?id='.$usuario->getId()) ?>"><?php echo $usuario->getId() ?></a></td>
      <td><?php echo $usuario->getTipo() ?></td>
      <td><?php echo $usuario->getNombre() ?></td>
      <td><?php echo $usuario->getApellidos() ?></td>
      <td><?php echo $usuario->getCelular() ?></td>
      <td><?php echo $usuario->getTelefono() ?></td>
      <td><?php echo $usuario->getDireccion() ?></td>
      <td><?php echo $usuario->getEmail() ?></td>
      <td><?php echo $usuario->getClave() ?></td>
      <td><?php echo $usuario->getFechaalta() ?></td>
      <td><?php echo $usuario->getFechabaja() ?></td>
      <td><?php echo $usuario->getHabilitado() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('usuario/new') ?>">New</a>
