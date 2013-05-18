<table>
    <tbody>
        <tr>
            <th colspan="2">INFORMACIÓN DE LA EMPRESA</th>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$NOMBRE ?></th>
            <td><?php echo $empresa->getNombre() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$RAZON_SOCIAL ?></th>
            <td><?php echo $empresa->getRazonsocial() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$BANCO ?></th>
            <td><?php echo $empresa->getBanco() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$NUM_CUENTA ?></th>
            <td><?php echo $empresa->getNumerocuenta() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$CANTIDAD_PROPIETARIOS ?></th>
            <td><?php echo count($empresa->getPropietarios()) ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$CANTIDAD_CHOFERES ?></th>
            <td><?php echo count($empresa->getChoferes()) ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$CANTIDAD_MOVILES ?></th>
            <td><?php echo count($empresa->getMoviles()) ?></td>
        </tr>
    </tbody>

</table>
