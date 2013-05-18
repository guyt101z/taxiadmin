<?php

/**
 * Adelanto form.
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
class AdelantoForm extends BaseAdelantoForm {

    public function configure() {
        unset($this['saldo']);
        unset($this['fechaAlta']);
        unset($this['fechaBaja']);
        unset($this['habilitado']);
        unset($this['usuario']);

        $this->widgetSchema['idChofer'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['nombreChofer'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly'));
        $this->validatorSchema['nombreChofer'] = new sfValidatorPass();

        $this->widgetSchema['fecha'] = new sfWidgetFormInput(array(), array('class' => 'fecha', 'size' => ConstantesFrontEnd::$SIZE_WIDGET_FECHA));
        $this->setValidator('fecha', new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')));

        $this->widgetSchema['monto']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_COSTO));
        
        $this->widgetSchema['detalle'] = new sfWidgetFormTextarea(array(), array('style' => 'resize:none', 'cols' => ConstantesFrontEnd::$SIZE_WIDGET_DESCRIPCION_COLS, 'rows' => ConstantesFrontEnd::$SIZE_WIDGET_DESCRIPCION_ROWS));
        
        // agrego las etiquetas
        $this->widgetSchema->setLabels(array(
            'nombreChofer' => EtiquetasFrontEnd::$CHOFER,
            'fecha' => EtiquetasFrontEnd::$FECHA,
            'monto' => EtiquetasFrontEnd::$MONTO,
            'detalle' => EtiquetasFrontEnd::$DETALLE
        ));
    }

}
