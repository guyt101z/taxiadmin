<?php

/**
 * Usuario form base class.
 *
 * @method Usuario getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BaseUsuarioForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'tipo'       => new sfWidgetFormInputText(),
      'nombre'     => new sfWidgetFormInputText(),
      'apellidos'  => new sfWidgetFormInputText(),
      'celular'    => new sfWidgetFormInputText(),
      'telefono'   => new sfWidgetFormInputText(),
      'direccion'  => new sfWidgetFormInputText(),
      'email'      => new sfWidgetFormInputText(),
      'clave'      => new sfWidgetFormInputText(),
      'fechaAlta'  => new sfWidgetFormDateTime(),
      'fechaBaja'  => new sfWidgetFormDateTime(),
      'habilitado' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'tipo'       => new sfValidatorString(array('max_length' => 20)),
      'nombre'     => new sfValidatorString(array('max_length' => 20)),
      'apellidos'  => new sfValidatorString(array('max_length' => 30)),
      'celular'    => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'telefono'   => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'direccion'  => new sfValidatorString(array('max_length' => 100)),
      'email'      => new sfValidatorString(array('max_length' => 100)),
      'clave'      => new sfValidatorString(array('max_length' => 32)),
      'fechaAlta'  => new sfValidatorDateTime(),
      'fechaBaja'  => new sfValidatorDateTime(array('required' => false)),
      'habilitado' => new sfValidatorBoolean(),
    ));

    $this->widgetSchema->setNameFormat('usuario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Usuario';
  }


}
