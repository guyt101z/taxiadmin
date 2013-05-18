<?php

/**
 * Propietario form.
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
class PropietarioForm extends BasePropietarioForm {

    public function configure() {

        //retiro los atributos que no quiero que esten en el formulario
        unset($this['fechaAlta']);
        unset($this['fechaBaja']);
        unset($this['habilitado']);
        unset($this['usuario']);
        unset($this['empresa_propietario_list']);

        $this->widgetSchema['cedula'] = new sfWidgetFormInputText();

        // le agrego a la cédula que sea requerida
        $this->validatorSchema['cedula'] = new sfValidatorAnd(array(
                    $this->validatorSchema['cedula'], new sfValidatorInteger(array('required' => true)),
                ));

        // le agrego un validador al email para que sea especial para emails 
        $this->setValidator('email', new sfValidatorEmail(array('required' => false), array('invalid' => "Debe ingresar un correo válido.")));

        // agrego las etiquetas
        $this->widgetSchema->setLabels(array(
            'cedula' => EtiquetasFrontEnd::$CEDULA,
            'nombre' => EtiquetasFrontEnd::$NOMBRE,
            'apellidos' => EtiquetasFrontEnd::$APELLIDO,
            'direccion' => EtiquetasFrontEnd::$DIRECCION,
            'telefono' => EtiquetasFrontEnd::$TELEFONO,
            'celular' => EtiquetasFrontEnd::$CELULAR,
            'email' => EtiquetasFrontEnd::$EMAIL,
        ));

        $this->widgetSchema->setHelp('cedula', 'Ingresar cédula sin puntos ni guiones.');

        $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
                    new sfValidatorPropelUnique(array('model' => 'propietario', 'column' => array('cedula')), array('invalid' => "Esta cédula ya existe en el Sistema para otro Propietario"))
                )));
    }

}
