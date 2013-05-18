<?php

/**
 * Movil form.
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
class MovilForm extends BaseMovilForm {

    public function configure() {
        //retiro los atributos que no quiero que esten en el formulario
        unset($this['multa_list']);
        unset($this['trabajo_taller_list']);
        unset($this['movil_empresa_list']);
        unset($this['pagoaseguradora_list']);
        unset($this['accidente_list']);
        unset($this['liquidacion_list']);
        unset($this['movil_despacho_list']);
        unset($this['fechaAlta']);
        unset($this['fechaBaja']);
        unset($this['habilitado']);
        unset($this['usuario']);

        //agrego un combo con las opciones de cobustible
        $combustibles = array();
        $combustibles[ConstantesFrontEnd::$NAFTA] = ConstantesFrontEnd::$NAFTA;
        $combustibles[ConstantesFrontEnd::$DIESEL] = ConstantesFrontEnd::$DIESEL;

        $this->widgetSchema['combustible'] = new sfWidgetFormChoice(array('multiple' => false, 'expanded' => false, 'choices' => $combustibles));

        // agrego las etiquetas
        $this->widgetSchema->setLabels(array(
            'matricula' => EtiquetasFrontEnd::$MATRICULA,
            'marca' => EtiquetasFrontEnd::$MARCA,
            'modelo' => EtiquetasFrontEnd::$MODELO,
            'anio' => EtiquetasFrontEnd::$ANIO,
            'numeroChasis' => EtiquetasFrontEnd::$NUM_CHASIS,
            'combustible' => EtiquetasFrontEnd::$COMBUSTIBLE,
            'numeroMovil' => EtiquetasFrontEnd::$NUM_MOVIL,
            'idDespacho' => EtiquetasFrontEnd::$DESPACHO,
            'kmIniciales' => EtiquetasFrontEnd::$KM_INICIALES,
            'idAseguradora' => EtiquetasFrontEnd::$ASEGURADORA,
        ));

        $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
                    new sfValidatorPropelUnique(array('model' => 'movil', 'column' => array('matricula')), array('invalid' => "Esta matrícula ya existe en el Sistema"))
                )));
    }

}
