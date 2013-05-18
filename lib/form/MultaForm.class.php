<?php

/**
 * Multa form.
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
class MultaForm extends BaseMultaForm {

    public function configure() {
        // retiro los atributos que no quiero que esten en el formulario
        unset($this['fechaAlta']);
        unset($this['fechaBaja']);
        unset($this['habilitado']);
        unset($this['usuario']);
        unset($this['pago']);

        // obtengo el array de choferes y moviles pasado por la session
        $choferes = sfContext::getInstance()->getUser()->getAttribute("choferes");
        $moviles = sfContext::getInstance()->getUser()->getAttribute("moviles");

        // cargo los arreglos en los combos 
        $this->widgetSchema['idChofer'] = new sfWidgetFormChoice(array('multiple' => false, 'expanded' => false, 'choices' => $choferes));
        $this->widgetSchema['idMovil'] = new sfWidgetFormChoice(array('multiple' => false, 'expanded' => false, 'choices' => $moviles));

        $this->widgetSchema['fecha'] = new sfWidgetFormInput(array(), array('class' => 'fecha', 'size' => ConstantesFrontEnd::$SIZE_WIDGET_FECHA));
        $this->setValidator('fecha', new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')));

        $this->widgetSchema['fechaVencimiento'] = new sfWidgetFormInput(array(), array('class' => 'fecha', 'size' => ConstantesFrontEnd::$SIZE_WIDGET_FECHA));
        $this->setValidator('fechaVencimiento', new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')));

        $this->widgetSchema['fechaPago'] = new sfWidgetFormInput(array(), array('class' => 'fecha', 'size' => ConstantesFrontEnd::$SIZE_WIDGET_FECHA));
        $this->setValidator('fechaPago', new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')));

        $this->widgetSchema['descripcion'] = new sfWidgetFormTextarea(array(), array('style' => 'resize:none', 'cols' => ConstantesFrontEnd::$SIZE_WIDGET_DESCRIPCION_COLS, 'rows' => ConstantesFrontEnd::$SIZE_WIDGET_DESCRIPCION_ROWS));

        $this->widgetSchema['costo']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_COSTO));

        // agrego las etiquetas
        $this->widgetSchema->setLabels(array(
            'idChofer' => EtiquetasFrontEnd::$CHOFER,
            'idMovil' => EtiquetasFrontEnd::$MOVIL,
            'fecha' => EtiquetasFrontEnd::$FECHA,
            'descripcion' => EtiquetasFrontEnd::$DESCRIPCION,
            'esquina' => EtiquetasFrontEnd::$ESQUINA,
            'responsable' => EtiquetasFrontEnd::$RESPONSABLE,
            'costo' => EtiquetasFrontEnd::$COSTO,
            'fechaVencimiento' => EtiquetasFrontEnd::$VENCIMIENTO,
            'fechaPago' => EtiquetasFrontEnd::$FECHA_PAGO,
        ));
    }

}
