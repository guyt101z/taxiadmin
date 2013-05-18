<?php

/**
 * Accidente form.
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
class AccidenteForm extends BaseAccidenteForm {

    public function configure() {
        // retiro los atributos que no quiero que esten en el formulario
        unset($this['fechaAlta']);
        unset($this['fechaBaja']);
        unset($this['habilitado']);
        unset($this['usuario']);

        // obtengo el array de choferes y moviles pasado por la session
        $choferes = sfContext::getInstance()->getUser()->getAttribute("choferes");
        $moviles = sfContext::getInstance()->getUser()->getAttribute("moviles");

        // cargo los arreglos en los combos 
        $this->widgetSchema['idChofer'] = new sfWidgetFormChoice(array('multiple' => false, 'expanded' => false, 'choices' => $choferes), array('style' => 'width:176px'));
        $this->widgetSchema['idMovil'] = new sfWidgetFormChoice(array('multiple' => false, 'expanded' => false, 'choices' => $moviles), array('style' => 'width:176px'));

        $this->widgetSchema['fecha'] = new sfWidgetFormInput(array(), array('class' => 'fecha', 'size' => ConstantesFrontEnd::$SIZE_WIDGET_FECHA));
        $this->setValidator('fecha', new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')));

        // modifico el tipo de widget de descripcion
        // lo paso a un textarea y modifico sus columnas y filas
        $this->widgetSchema['descripcion'] = new sfWidgetFormTextarea(array(), array('style' => 'resize:none', 'cols' => ConstantesFrontEnd::$SIZE_WIDGET_DESCRIPCION_COLS, 'rows' => ConstantesFrontEnd::$SIZE_WIDGET_DESCRIPCION_ROWS));

        // le seteo el tamaño del campo
        $this->widgetSchema['heridos']->setAttributes(array('size' => 3));
        
        // agrego las etiquetas
        $this->widgetSchema->setLabels(array(
            'idChofer' => EtiquetasFrontEnd::$CHOFER,
            'idMovil' => EtiquetasFrontEnd::$MOVIL,
            'fecha' => EtiquetasFrontEnd::$FECHA,
            'descripcion' => EtiquetasFrontEnd::$DESCRIPCION,
            'esquina' => EtiquetasFrontEnd::$ESQUINA,
            'responsable' => EtiquetasFrontEnd::$RESPONSABLE,
            'deducible' => EtiquetasFrontEnd::$DEDUCIBLE,
            'heridos' => EtiquetasFrontEnd::$HERIDOS,
        ));
    }

}
