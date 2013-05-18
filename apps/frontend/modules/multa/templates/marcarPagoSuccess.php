<p id="validateTips" class="validateTips"></p>
<form id="form" action="<?php echo url_for('multa/guardarPago?id=' . $multa->getId()) ?>" method="post">
    <table>
        <tbody>
            <tr>
                <th><?php echo EtiquetasFrontEnd::$FECHA_PAGO ?></th>
                <td>
                    <input id="multa_fechaPago" name="multa[fechaPago]" class="fecha" size="<?php echo ConstantesFrontEnd::$SIZE_WIDGET_FECHA ?>" value="<?php echo date(ConstantesFrontEnd::$FORMAT_DATE) ?>"/>
                </td>
            </tr>
        </tbody>
    </table>
</form>