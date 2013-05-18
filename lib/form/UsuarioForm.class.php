<?php

/**
 * Usuario form.
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
class UsuarioForm extends BaseUsuarioForm {

    public function configure() {

        //retiro los atributos que no quiero que esten en el formulario
        unset($this['id']);
        unset($this['tipo']);
        unset($this['movil_aseguradora_list']);
        unset($this['empresa_propietario_list']);
        unset($this['multa_list']);
        unset($this['pagoaseguradora_list']);
        unset($this['accidente_list']);
        unset($this['liquidacion_list']);
        unset($this['fechaAlta']);
        unset($this['fechaBaja']);
        unset($this['habilitado']);
        unset($this['idPais']);
        unset($this['usuario']);

        //le cambio el tipo de widget a clave para que sea una de pass y agrego 1 widget mas  para validar la clave
        $this->widgetSchema['clave'] = new sfWidgetFormInputPassword();
        $this->widgetSchema['clave2'] = new sfWidgetFormInputPassword();

        // le agrego al validador por defecto del email uno que sea especial para emails 
        $this->validatorSchema['email'] = new sfValidatorAnd(array(
            $this->validatorSchema['email'], new sfValidatorEmail(array(), array('invalid' => "Debe ingresar un correo válido.")),
            ));

        // agrego un postValidator que verifique que el correo ingresado ya no este dado de alta y que las claves coincidan
        $this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
            new sfValidatorSchemaCompare('clave2', sfValidatorSchemaCompare::EQUAL, 'clave', array('throw_global_error' => true), array('invalid' => "Las dos contraseñas no coinciden")),
            )));

        // agrego un validador para el máximo de caracteres
        $this->setValidator('clave2', new sfValidatorString(array('max_length' => 30)));

        // agrego las etiquetas
        $this->widgetSchema->setLabels(array(
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'celular' => 'Celular',
            'telefono' => 'Teléfono',
            'direccion' => 'Dirección',
            'email' => 'Email',
            'clave' => 'Clave',
            'clave2' => 'Ingrese nuevamente la Clave',
            ));
    }

}
