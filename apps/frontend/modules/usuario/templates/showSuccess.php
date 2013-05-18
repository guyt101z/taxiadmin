<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $usuario->getId() ?></td>
    </tr>
    <tr>
      <th>Tipo:</th>
      <td><?php echo $usuario->getTipo() ?></td>
    </tr>
    <tr>
      <th>Nombre:</th>
      <td><?php echo $usuario->getNombre() ?></td>
    </tr>
    <tr>
      <th>Apellidos:</th>
      <td><?php echo $usuario->getApellidos() ?></td>
    </tr>
    <tr>
      <th>Celular:</th>
      <td><?php echo $usuario->getCelular() ?></td>
    </tr>
    <tr>
      <th>Telefono:</th>
      <td><?php echo $usuario->getTelefono() ?></td>
    </tr>
    <tr>
      <th>Direccion:</th>
      <td><?php echo $usuario->getDireccion() ?></td>
    </tr>
    <tr>
      <th>Email:</th>
      <td><?php echo $usuario->getEmail() ?></td>
    </tr>
    <tr>
      <th>Clave:</th>
      <td><?php echo $usuario->getClave() ?></td>
    </tr>
    <tr>
      <th>Fechaalta:</th>
      <td><?php echo $usuario->getFechaalta() ?></td>
    </tr>
    <tr>
      <th>Fechabaja:</th>
      <td><?php echo $usuario->getFechabaja() ?></td>
    </tr>
    <tr>
      <th>Habilitado:</th>
      <td><?php echo $usuario->getHabilitado() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('usuario/edit?id='.$usuario->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('usuario/index') ?>">List</a>
