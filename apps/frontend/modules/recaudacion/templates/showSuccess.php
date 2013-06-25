<table>
    <tbody>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$FECHA ?></th>
            <td><?php echo $Recaudacion->getFecha() ?></td>

            <th><?php echo EtiquetasFrontEnd::$GASTO_1 ?></th>
            <td><?php echo $Recaudacion->getGasto(EtiquetasFrontEnd::$GASTO_1)->getCosto() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$MOVIL ?></th>
            <td><?php echo $Recaudacion->getMovil()->getMatricula() ?></td>

            <th><?php echo EtiquetasFrontEnd::$GASTO_2 ?></th>
            <td><?php echo $Recaudacion->getGasto(EtiquetasFrontEnd::$GASTO_2)->getCosto() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$CHOFER ?></th>
            <td><?php echo $Recaudacion->getChofer()->getNombreCompleto() ?></td>
            
            <th><?php echo EtiquetasFrontEnd::$GASTO_3 ?></th>
            <td><?php echo $Recaudacion->getGasto(EtiquetasFrontEnd::$GASTO_3)->getCosto() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$KM ?></th>
            <td><?php echo $Recaudacion->getKm() ?></td>

            <th><?php echo EtiquetasFrontEnd::$GASTO_4 ?></th>
            <td><?php echo $Recaudacion->getGasto(EtiquetasFrontEnd::$GASTO_4)->getCosto() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$RECAUDACION ?></th>
            <td><?php echo $Recaudacion->getRecaudacion() ?></td>
            
            <th><?php echo EtiquetasFrontEnd::$GASTO_5 ?></th>
            <td><?php echo $Recaudacion->getGasto(EtiquetasFrontEnd::$GASTO_5)->getCosto() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$TOTAL_GASTOS ?></th>
            <td><?php echo $Recaudacion->getTotalgastos() ?></td>
            
            <th><?php echo EtiquetasFrontEnd::$GASTO_6 ?></th>
            <td><?php echo $Recaudacion->getGasto(EtiquetasFrontEnd::$GASTO_6)->getCosto() ?></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$IMPORTE_CHOFER ?></th>
            <td><?php echo $Recaudacion->getImportechofer() ?></td>
            
            <th></th>
            <td></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$APORTE_LEYES ?></th>
            <td><?php echo $Recaudacion->getAporteleyes() ?></td>
            
            <th></th>
            <td></td>
        </tr>
        <tr>
            <th><?php echo EtiquetasFrontEnd::$IMPORTE_MOVIL ?></th>
            <td><?php echo $Recaudacion->getImportemovil() ?></td>

            <th></th>
            <td></td>    
        </tr>
    </tbody>
</table>