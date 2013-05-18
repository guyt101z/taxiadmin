<h1>TrabajoTallers List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Idmovil</th>
      <th>Idtaller</th>
      <th>Fechaingreso</th>
      <th>Motivoingreso</th>
      <th>Costomateriales</th>
      <th>Costomanoobra</th>
      <th>Detalletrabajo</th>
      <th>Responsable</th>
      <th>Tipopago</th>
      <th>Totaltrabajo</th>
      <th>Numerofactura</th>
      <th>Fechaalta</th>
      <th>Fechabaja</th>
      <th>Habilitado</th>
      <th>Usuario</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($TrabajoTallers as $TrabajoTaller): ?>
    <tr>
      <td><a href="<?php echo url_for('trabajoTaller/show?id='.$TrabajoTaller->getId()) ?>"><?php echo $TrabajoTaller->getId() ?></a></td>
      <td><?php echo $TrabajoTaller->getIdmovil() ?></td>
      <td><?php echo $TrabajoTaller->getIdtaller() ?></td>
      <td><?php echo $TrabajoTaller->getFechaingreso() ?></td>
      <td><?php echo $TrabajoTaller->getMotivoingreso() ?></td>
      <td><?php echo $TrabajoTaller->getCostomateriales() ?></td>
      <td><?php echo $TrabajoTaller->getCostomanoobra() ?></td>
      <td><?php echo $TrabajoTaller->getDetalletrabajo() ?></td>
      <td><?php echo $TrabajoTaller->getResponsable() ?></td>
      <td><?php echo $TrabajoTaller->getTipopago() ?></td>
      <td><?php echo $TrabajoTaller->getTotaltrabajo() ?></td>
      <td><?php echo $TrabajoTaller->getNumerofactura() ?></td>
      <td><?php echo $TrabajoTaller->getFechaalta() ?></td>
      <td><?php echo $TrabajoTaller->getFechabaja() ?></td>
      <td><?php echo $TrabajoTaller->getHabilitado() ?></td>
      <td><?php echo $TrabajoTaller->getUsuario() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('trabajoTaller/new') ?>">New</a>
