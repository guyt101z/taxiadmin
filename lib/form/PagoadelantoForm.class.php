<?php

/**
 * Pagoadelanto form.
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
class PagoadelantoForm extends BasePagoadelantoForm {

	public function configure() {

  		// retiro los atributos que no quiero que esten en el formulario
		unset($this['fechaAlta']);
		unset($this['fechaBaja']);
		unset($this['habilitado']);
		unset($this['usuario']);

		$this->widgetSchema['idAdelanto'] = new sfWidgetFormInputHidden(array(), array());

		$this->widgetSchema['fecha'] = new sfWidgetFormInput(array(), array('class' => 'fecha', 'size' => ConstantesFrontEnd::$SIZE_WIDGET_FECHA));
		$this->setValidator('fecha', new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')));
		
		// seteo el tamaño del widget para el monto
		$this->widgetSchema['monto']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_COSTO));
		
		// seteo el tamaño del widget para la descripcion
		$this->widgetSchema['detalle'] = new sfWidgetFormTextarea(array(), array('style' => 'resize:none', 'cols' => ConstantesFrontEnd::$SIZE_WIDGET_DESCRIPCION_COLS, 'rows' => ConstantesFrontEnd::$SIZE_WIDGET_DESCRIPCION_ROWS));

		// agrego las etiquetas
		$this->widgetSchema->setLabels(array(
			'fecha' => EtiquetasFrontEnd::$FECHA,
			'monto' => EtiquetasFrontEnd::$MONTO,
			'detalle' => EtiquetasFrontEnd::$DETALLE,
			));

	}
}
