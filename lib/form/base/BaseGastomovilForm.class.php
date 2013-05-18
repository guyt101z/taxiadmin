<?php

/**
 * Gastomovil form base class.
 *
 * @method Gastomovil getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BaseGastomovilForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'idMovil'    => new sfWidgetFormPropelChoice(array('model' => 'Movil', 'add_empty' => false)),
      'fecha'      => new sfWidgetFormDate(),
      'costo'      => new sfWidgetFormInputText(),
      'detalle'    => new sfWidgetFormInputText(),
      'fechaAlta'  => new sfWidgetFormDateTime(),
      'fechaBaja'  => new sfWidgetFormDateTime(),
      'habilitado' => new sfWidgetFormInputCheckbox(),
      'usuario'    => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'idMovil'    => new sfValidatorPropelChoice(array('model' => 'Movil', 'column' => 'id')),
      'fecha'      => new sfValidatorDate(),
      'costo'      => new sfValidatorNumber(),
      'detalle'    => new sfValidatorString(array('max_length' => 300)),
      'fechaAlta'  => new sfValidatorDateTime(),
      'fechaBaja'  => new sfValidatorDateTime(array('required' => false)),
      'habilitado' => new sfValidatorBoolean(array('required' => false)),
      'usuario'    => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('gastomovil[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Gastomovil';
  }


}
