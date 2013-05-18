<?php

/**
 * Empresa form.
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
class EmpresaForm extends BaseEmpresaForm {

    public function configure() {

        //retiro los atributos que no quiero que esten en el formulario
        unset($this['fechaAlta']);
        unset($this['fechaBaja']);
        unset($this['habilitado']);
        unset($this['usuario']);
        unset($this['empresa_propietario_list']);
        unset($this['movil_empresa_list']);
        unset($this['chofer_empresa_list']);
        unset($this['pagoaseguradora_list']);

        // agrego las etiquetas
        $this->widgetSchema->setLabels(array(
            'nombre' => EtiquetasFrontEnd::$NOMBRE,
            'razonSocial' => EtiquetasFrontEnd::$RAZON_SOCIAL,
            'idBanco' => EtiquetasFrontEnd::$BANCO,
            'numeroCuenta' => EtiquetasFrontEnd::$NUM_CUENTA,
        ));

        // valido que el nombre de la empresa sea único       
        $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
                    new sfValidatorPropelUnique(array('model' => 'empresa', 'column' => array('nombre')), array('invalid' => "Este nombre ya se utiliza en otra Empresa"))
                )));

        // valido que la razon social de la empresa sea única
        $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
                    new sfValidatorPropelUnique(array('model' => 'empresa', 'column' => array('razonSocial')), array('invalid' => "La razon social ingresada ya existe en el Sistema"))
                )));
    }

}
