<p id="validateTips" class="validateTips"></p>
<form id="form" action="<?php echo url_for('chofer/guardarPagoCarneSalud?id=' . $chofer->getId()) ?>" method="post">
    <table>
        <tbody>
            <tr>
                <th><?php echo EtiquetasFrontEnd::$VENCIMIENTO_CARNE_SALUD ?></th>
                <td>
                    <input id="chofer_vencimientoCarneSalud" name="chofer[vencimientoCarneSalud]" class="fecha" size="<?php echo ConstantesFrontEnd::$SIZE_WIDGET_FECHA ?>" value="<?php echo date(ConstantesFrontEnd::$FORMAT_DATE) ?>"/>
                </td>
            </tr>
        </tbody>
    </table>
</form>