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
        $moviles = sfContext::getInstance()->getUser()->getAttribute("moviles");

        // cargo los arreglos en los combos 
        $this->widgetSchema['idChofer'] = new sfWidgetFormChoice(array('multiple' => false, 'expanded' => false, 'choices' => $choferes));
        $this->widgetSchema['idMovil'] = new sfWidgetFormChoice(array('multiple' => false, 'expanded' => false, 'choices' => $moviles));

        $this->widgetSchema['fecha'] = new sfWidgetFormInput(array(), array('class' => 'fecha', 'size' => ConstantesFrontEnd::$SIZE_WIDGET_FECHA));
        $this->setValidator('fecha', new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')));

        $turnos = array();
        $turnos[ConstantesFrontEnd::$DIURNO] = ConstantesFrontEnd::$DIURNO;
        $turnos[ConstantesFrontEnd::$NOCTURNO] = ConstantesFrontEnd::$NOCTURNO;
        $this->widgetSchema['turno'] = new sfWidgetFormChoice(array('multiple' => false, 'expanded' => false, 'choices' => $turnos));

        // seteo el tamaño de todos los widgets que necesiten
        $this->widgetSchema['kmInicialAuto']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->widgetSchema['kmFinalAuto']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->widgetSchema['kmInicialReloj']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->widgetSchema['kmFinalReloj']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->widgetSchema['fichasIniciales']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->widgetSchema['fichasFinales']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->widgetSchema['fichasDiurnas']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->widgetSchema['fichasNocturnas']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->widgetSchema['banderasDiurnas']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->widgetSchema['banderasNocturnas']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->widgetSchema['porcentajeRecaudacion']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->widgetSchema['importeChofer']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->widgetSchema['importeMovil']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->widgetSchema['recaudacion']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->widgetSchema['aportePatronal']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->widgetSchema['descuentoFichas']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));
        $this->widgetSchema['descuentoBanderas']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_RECAUDACION));

        // agrego las etiquetas
        $this->widgetSchema->setLabels(array(
            'idChofer' => EtiquetasFrontEnd::$CHOFER,
            'idMovil' => EtiquetasFrontEnd::$MOVIL,
            'turno' => EtiquetasFrontEnd::$TURNO,
            'fecha' => EtiquetasFrontEnd::$FECHA,
            'kmInicialAuto' => EtiquetasFrontEnd::$KM_INICIAL_AUTO,
            'kmFinalAuto' => EtiquetasFrontEnd::$KM_FINAL_AUTO,
            'kmInicialReloj' => EtiquetasFrontEnd::$KM_INICIAL_RELOJ,
            'kmFinalReloj' => EtiquetasFrontEnd::$KM_FINAL_RELOJ,
            'fichasIniciales' => EtiquetasFrontEnd::$FICHAS_INICIALES,
            'fichasFinales' => EtiquetasFrontEnd::$FICHAS_FINALES,
            'fichasDiurnas' => EtiquetasFrontEnd::$FICHAS_DIURNAS,
            'fichasNocturnas' => EtiquetasFrontEnd::$FICHAS_NOCTURNAS,
            'banderasDiurnas' => EtiquetasFrontEnd::$BANDERAS_DIURNAS,
            'banderasNocturnas' => EtiquetasFrontEnd::$BANDERAS_NOCTURNAS,
            'porcentajeRecaudacion' => EtiquetasFrontEnd::$PORCENTAJE_RECAUDACION,
            'importeChofer' => EtiquetasFrontEnd::$IMPORTE_CHOFER,
            'importeMovil' => EtiquetasFrontEnd::$IMPORTE_MOVIL,
            'recaudacion' => EtiquetasFrontEnd::$RECAUDACION,
            'aportePatronal' => EtiquetasFrontEnd::$APORTE_PATRONAL,
            'descuentoFichas' => EtiquetasFrontEnd::$DESCUENTO_FICHAS,
            'descuentoBanderas' => EtiquetasFrontEnd::$DESCUENTO_BANDERAS
        ));
    }

}
