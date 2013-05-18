<?php

/**
 * Gastomovil form.
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
class GastomovilForm extends BaseGastomovilForm {

    public function configure() {
        unset($this['fechaAlta']);
        unset($this['fechaBaja']);
        unset($this['habilitado']);
        unset($this['usuario']);

        $this->widgetSchema['idMovil'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['matriculaMovil'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly'));
        $this->validatorSchema['matriculaMovil'] = new sfValidatorPass();

        $this->widgetSchema['fecha'] = new sfWidgetFormInput(array(), array('class' => 'fecha', 'size' => ConstantesFrontEnd::$SIZE_WIDGET_FECHA));
        $this->setValidator('fecha', new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')));

        $this->widgetSchema['costo']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_COSTO));
        
        $this->widgetSchema['detalle'] = new sfWidgetFormTextarea(
            array(), 
            array(
                'style' => 'resize:none', 
                'cols' => ConstantesFrontEnd::$SIZE_WIDGET_DESCRIPCION_COLS, 
                'rows' => ConstantesFrontEnd::$SIZE_WIDGET_DESCRIPCION_ROWS_MINI)
            );

        $this->widgetSchema->setLabels(array(
            'matriculaMovil' => EtiquetasFrontEnd::$MOVIL,
            'fecha' => EtiquetasFrontEnd::$FECHA,
            'costo' => EtiquetasFrontEnd::$COSTO,
            'detalle' => EtiquetasFrontEnd::$DETALLE
            ));
    }

}
