<?php

/**
 * Gastoempresa form.
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
class GastoempresaForm extends BaseGastoempresaForm {

    public function configure() {
        unset($this['fechaAlta']);
        unset($this['fechaBaja']);
        unset($this['habilitado']);
        unset($this['usuario']);

        $this->widgetSchema['idEmpresa'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['nombreEmpresa'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly'));
        $this->validatorSchema['nombreEmpresa'] = new sfValidatorPass();

        $this->widgetSchema['fecha'] = new sfWidgetFormInput(array(), array('class' => 'fecha', 'size' => ConstantesFrontEnd::$SIZE_WIDGET_FECHA));
        $this->setValidator('fecha', new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')));

        $this->widgetSchema['costo']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_COSTO));
        
        $this->widgetSchema['detalle'] = new sfWidgetFormTextarea(array(), array('style' => 'resize:none', 'cols' => ConstantesFrontEnd::$SIZE_WIDGET_DESCRIPCION_COLS, 'rows' => ConstantesFrontEnd::$SIZE_WIDGET_DESCRIPCION_ROWS));

        $this->widgetSchema->setLabels(array(
            'nombreEmpresa' => EtiquetasFrontEnd::$EMPRESA,
            'fecha' => EtiquetasFrontEnd::$FECHA,
            'costo' => EtiquetasFrontEnd::$COSTO,
            'detalle' => EtiquetasFrontEnd::$DETALLE
        ));
    }

}
