<?php

/**
 * Banco form base class.
 *
 * @method Banco getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BaseBancoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'nombre'     => new sfWidgetFormInputText(),
      'sucursal'   => new sfWidgetFormInputText(),
      'direccion'  => new sfWidgetFormInputText(),
      'web'        => new sfWidgetFormInputText(),
      'fechaAlta'  => new sfWidgetFormDateTime(),
      'fechaBaja'  => new sfWidgetFormDateTime(),
      'habilitado' => new sfWidgetFormInputCheckbox(),
      'usuario'    => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'nombre'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'sucursal'   => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'direccion'  => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'web'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'fechaAlta'  => new sfValidatorDateTime(),
      'fechaBaja'  => new sfValidatorDateTime(array('required' => false)),
      'habilitado' => new sfValidatorBoolean(array('required' => false)),
      'usuario'    => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('banco[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Banco';
  }


}
