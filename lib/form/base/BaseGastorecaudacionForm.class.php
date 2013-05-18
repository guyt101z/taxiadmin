<?php

/**
 * Gastorecaudacion form base class.
 *
 * @method Gastorecaudacion getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BaseGastorecaudacionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'idRecaudacion' => new sfWidgetFormPropelChoice(array('model' => 'Recaudacion', 'add_empty' => true)),
      'costo'         => new sfWidgetFormInputText(),
      'detalle'       => new sfWidgetFormInputText(),
      'usuario'       => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'idRecaudacion' => new sfValidatorPropelChoice(array('model' => 'Recaudacion', 'column' => 'id', 'required' => false)),
      'costo'         => new sfValidatorNumber(),
      'detalle'       => new sfValidatorString(array('max_length' => 300, 'required' => false)),
      'usuario'       => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('gastorecaudacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Gastorecaudacion';
  }


}
