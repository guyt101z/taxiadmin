<table>
    <tbody>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$MOVIL ?></th>
            <td><?php echo $Recaudacion->getMovil()->getMatricula() ?></td>

            <th><?php echo EtiquetasFrontEnd::$CHOFER ?></th>
            <td><?php echo $Recaudacion->getChofer()->getNombreCompleto() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$TURNO ?></th>
            <td><?php echo $Recaudacion->getTurno() ?></td>

            <th><?php echo EtiquetasFrontEnd::$FECHA ?></th>
            <td><?php echo $Recaudacion->getFecha() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$KM_INICIAL_AUTO ?></th>
            <td><?php echo $Recaudacion->getKminicialauto() ?></td>

            <th><?php echo EtiquetasFrontEnd::$KM_FINAL_AUTO ?></th>
            <td><?php echo $Recaudacion->getKmfinalauto() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$KM_INICIAL_RELOJ ?></th>
            <td><?php echo $Recaudacion->getKminicialreloj() ?></td>

            <th><?php echo EtiquetasFrontEnd::$KM_FINAL_RELOJ ?></th>
            <td><?php echo $Recaudacion->getKmfinalreloj() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$FICHAS_INICIALES ?></th>
            <td><?php echo $Recaudacion->getFichasiniciales() ?></td>

            <th><?php echo EtiquetasFrontEnd::$FICHAS_FINALES ?></th>
            <td><?php echo $Recaudacion->getFichasfinales() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$FICHAS_DIURNAS ?></th>
            <td><?php echo $Recaudacion->getFichasdiurnas() ?></td>

            <th><?php echo EtiquetasFrontEnd::$FICHAS_NOCTURNAS ?></th>
            <td><?php echo $Recaudacion->getFichasnocturnas() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$BANDERAS_DIURNAS ?></th>
            <td><?php echo $Recaudacion->getBanderasdiurnas() ?></td>

            <th><?php echo EtiquetasFrontEnd::$BANDERAS_NOCTURNAS ?></th>
            <td><?php echo $Recaudacion->getBanderasnocturnas() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$PORCENTAJE_RECAUDACION ?></th>
            <td><?php echo $Recaudacion->getPorcentajerecaudacion() ?></td>

            <th><?php echo EtiquetasFrontEnd::$IMPORTE_CHOFER ?></th>
            <td><?php echo $Recaudacion->getImportechofer() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$IMPORTE_MOVIL ?></th>
            <td><?php echo $Recaudacion->getImportemovil() ?></td>

            <th><?php echo EtiquetasFrontEnd::$RECAUDACION ?></th>
            <td><?php echo $Recaudacion->getRecaudacion() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$APORTE_PATRONAL ?></th>
            <td><?php echo $Recaudacion->getAportepatronal() ?></td>

            <th><?php echo EtiquetasFrontEnd::$DESCUENTO_FICHAS ?></th>
            <td><?php echo $Recaudacion->getDescuentofichas() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$DESCUENTO_BANDERAS ?></th>
            <td><?php echo $Recaudacion->getDescuentobanderas() ?></td>
        </tr>
    </tbody>
</table>