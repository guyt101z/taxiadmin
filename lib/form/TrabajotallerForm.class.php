<?php

/**
 * Trabajotaller form.
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
class TrabajotallerForm extends BaseTrabajotallerForm {

    public function configure() {
        // retiro los atributos que no quiero que esten en el formulario
        unset($this['fechaAlta']);
        unset($this['fechaBaja']);
        unset($this['habilitado']);
        unset($this['usuario']);

        $this->widgetSchema['idMovil'] = new sfWidgetFormInputHidden();
        $this->widgetSchema['matriculaMovil'] = new sfWidgetFormInput(array(), array('readonly' => 'readonly'));
        $this->validatorSchema['matriculaMovil'] = new sfValidatorPass();

        // cargo los talleres que existen en el sistema 
        $talleres = array();
        $talleresLista = TallerPeer::getHabilitados();
        foreach ($talleresLista as $taller) {
            $talleres[$taller->getId()] = $taller->getNombre();
        }
        $this->widgetSchema['idTaller'] = new sfWidgetFormChoice(array('multiple' => FALSE, 'expanded' => false, 'choices' => $talleres));

        // seteo el widget de la fecha de ingreso
        $this->widgetSchema['fechaIngreso'] = new sfWidgetFormInput(array(), array('class' => 'fecha', 'size' => ConstantesFrontEnd::$SIZE_WIDGET_FECHA));
        $this->setValidator('fechaIngreso', new sfValidatorDate(array('date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')));

        // cargo los tipo de pago para el trabajo 
        $tiposPago = array();
        $tiposPago[ConstantesFrontEnd::$CONTADO] = ConstantesFrontEnd::$CONTADO;
        $tiposPago[ConstantesFrontEnd::$CHEQUE] = ConstantesFrontEnd::$CHEQUE;
        $tiposPago[ConstantesFrontEnd::$OTRO] = ConstantesFrontEnd::$OTRO;
        $this->widgetSchema['tipoPago'] = new sfWidgetFormChoice(array('multiple' => false, 'expanded' => false, 'choices' => $tiposPago));

        // seteo el tamaño de los widgets
        $this->widgetSchema['costoMateriales']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_COSTO));
        $this->widgetSchema['costoManoObra']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_COSTO));
        $this->widgetSchema['totalTrabajo']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_COSTO));        
        
        // para este caso tambien le cambio el tipo de widget ya que quiero que se pueda ingresar una descripcion
        $this->widgetSchema['motivoIngreso'] = new sfWidgetFormTextarea(
            array(), 
            array(
                'style' => 'resize:none', 
                'cols' => ConstantesFrontEnd::$SIZE_WIDGET_DESCRIPCION_COLS, 
                'rows' => ConstantesFrontEnd::$SIZE_WIDGET_DESCRIPCION_ROWS_MINI)
            );

        $this->widgetSchema['detalleTrabajo'] = new sfWidgetFormTextarea(
            array(), 
            array(
                'style' => 'resize:none', 
                'cols' => ConstantesFrontEnd::$SIZE_WIDGET_DESCRIPCION_COLS, 
                'rows' => ConstantesFrontEnd::$SIZE_WIDGET_DESCRIPCION_ROWS)
            );


        // agrego las etiquetas
        $this->widgetSchema->setLabels(array(
            'matriculaMovil' => EtiquetasFrontEnd::$MOVIL,
            'idTaller' => EtiquetasFrontEnd::$TALLER,
            'fechaIngreso' => EtiquetasFrontEnd::$FECHA_INGRESO,
            'motivoIngreso' => EtiquetasFrontEnd::$MOTIVO_INGRESO,
            'costoMateriales' => EtiquetasFrontEnd::$COSTO_MATERIALES,
            'costoManoObra' => EtiquetasFrontEnd::$COSTO_MANO_OBRA,
            'detalleTrabajo' => EtiquetasFrontEnd::$DETALLE_TRABAJO,
            'responsable' => EtiquetasFrontEnd::$RESPONSABLE,
            'tipoPago' => EtiquetasFrontEnd::$TIPO_PAGO,
            'totalTrabajo' => EtiquetasFrontEnd::$TOTAL_TRABAJO,
            'numeroFactura' => EtiquetasFrontEnd::$NUM_FACTURA
            ));
    }

}
