<?php

/**
 * Taller form base class.
 *
 * @method Taller getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BaseTallerForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'nombre'     => new sfWidgetFormInputText(),
      'direccion'  => new sfWidgetFormInputText(),
      'telefono'   => new sfWidgetFormInputText(),
      'telefono2'  => new sfWidgetFormInputText(),
      'web'        => new sfWidgetFormInputText(),
      'email'      => new sfWidgetFormInputText(),
      'fechaAlta'  => new sfWidgetFormDateTime(),
      'fechaBaja'  => new sfWidgetFormDateTime(),
      'habilitado' => new sfWidgetFormInputCheckbox(),
      'usuario'    => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'nombre'     => new sfValidatorString(array('max_length' => 100)),
      'direccion'  => new sfValidatorString(array('max_length' => 100)),
      'telefono'   => new sfValidatorString(array('max_length' => 15)),
      'telefono2'  => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'web'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'email'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'fechaAlta'  => new sfValidatorDateTime(),
      'fechaBaja'  => new sfValidatorDateTime(array('required' => false)),
      'habilitado' => new sfValidatorBoolean(array('required' => false)),
      'usuario'    => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('taller[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Taller';
  }


}
