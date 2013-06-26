<?php

/**
 * Recaudacion form.
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
class RecaudacionForm extends BaseRecaudacionForm {

    public function configure() {
        // retiro los atributos que no quiero que esten en el formulario
        unset($this['fechaAlta']);
        unset($this['fechaBaja']);
        unset($this['habilitado']);
        unset($this['usuario']);

        $choferes = sfContext::getInstance()->getUser()->getAttribute("choferes");
        $aporteLeyes = sfContext::getInstance()->getUser()->getAttribute("choferesAporteLeyes");
        $pliquidacion = sfContext::getInstance()->getUser()->getAttribute("choferesPLiquidacion");
        $moviles = sfContext::getInstance()->getUser()->getAttribute("moviles");

        // cargo los arreglos en los combos 
        $this->widgetSchema['idChofer'] = new sfWidgetFormChoice(array('multiple' => false, 'expanded' => false, 'choices' => $choferes));
        $this->widgetSchema['listaAporteLeyes'] = new sfWidgetFormChoice(array('multiple' => false, 'expanded' => false, 'choices' => $aporteLeyes));
        $this->widgetSchema['listaPLiquidacion'] = new sfWidgetFormChoice(array('multiple' => false, 'expanded' => false, 'choices' => $pliquidacion));
        $this->widgetSchema['idMovil'] = new sfWidgetFormChoice(array('multiple' => false, 'expanded' => false, 'choices' => $moviles));

        $this->setValidator('listaAporteLeyes', new sfValidatorNumber(array()));
        $this->setValidator('listaPLiquidacion', new sfValidatorNumber(array()));

        $this->widgetSchema['fecha'] = new sfWidgetFormInput(array(), array('class' => 'fecha', 'size' => ConstantesFrontEnd::$SIZE_WIDGET_FECHA));
        $this->setValidator('fecha', new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')));

        $this->widgetSchema[EtiquetasFrontEnd::$GASTO_1] = new sfWidgetFormInputText(array(), array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->setValidator(EtiquetasFrontEnd::$GASTO_1, new sfValidatorNumber());

        $this->widgetSchema[EtiquetasFrontEnd::$GASTO_2] = new sfWidgetFormInputText(array(), array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->setValidator(EtiquetasFrontEnd::$GASTO_2, new sfValidatorNumber());

        $this->widgetSchema[EtiquetasFrontEnd::$GASTO_3] = new sfWidgetFormInputText(array(), array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->setValidator(EtiquetasFrontEnd::$GASTO_3, new sfValidatorNumber());

        $this->widgetSchema[EtiquetasFrontEnd::$GASTO_4] = new sfWidgetFormInputText(array(), array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->setValidator(EtiquetasFrontEnd::$GASTO_4, new sfValidatorNumber());

        $this->widgetSchema[EtiquetasFrontEnd::$GASTO_5] = new sfWidgetFormInputText(array(), array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->setValidator(EtiquetasFrontEnd::$GASTO_5, new sfValidatorNumber());

        $this->widgetSchema[EtiquetasFrontEnd::$GASTO_6] = new sfWidgetFormInputText(array(), array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->setValidator(EtiquetasFrontEnd::$GASTO_6, new sfValidatorNumber());

        // // seteo el tamaño de todos los widgets que necesiten
        $this->widgetSchema['recaudacion']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->widgetSchema['importeChofer']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->widgetSchema['importeMovil']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->widgetSchema['aporteLeyes']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->widgetSchema['km']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_KM));
        $this->widgetSchema['totalGastos']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        
        // agrego las etiquetas
        $this->widgetSchema->setLabels(array(
            'recaudacion' => EtiquetasFrontEnd::$RECAUDACION,
            'fecha' => EtiquetasFrontEnd::$FECHA,
            'importeChofer' => EtiquetasFrontEnd::$IMPORTE_CHOFER,
            'totalGastos' => EtiquetasFrontEnd::$TOTAL_GASTOS,
            'importeMovil' => EtiquetasFrontEnd::$IMPORTE_MOVIL,
            'aporteLeyes' => EtiquetasFrontEnd::$APORTE_LEYES,
            'idChofer' => EtiquetasFrontEnd::$CHOFER,
            'idMovil' => EtiquetasFrontEnd::$MOVIL,
            EtiquetasFrontEnd::$GASTO_1 => EtiquetasFrontEnd::$GASTO_1,
            EtiquetasFrontEnd::$GASTO_2 => EtiquetasFrontEnd::$GASTO_2,
            EtiquetasFrontEnd::$GASTO_3 => EtiquetasFrontEnd::$GASTO_3_E,
            EtiquetasFrontEnd::$GASTO_4 => EtiquetasFrontEnd::$GASTO_4,
            EtiquetasFrontEnd::$GASTO_5 => EtiquetasFrontEnd::$GASTO_5_E,
            EtiquetasFrontEnd::$GASTO_6 => EtiquetasFrontEnd::$GASTO_6,
            ));
    }

}
