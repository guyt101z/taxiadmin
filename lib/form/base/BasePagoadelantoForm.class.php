<?php

/**
 * Pagoadelanto form base class.
 *
 * @method Pagoadelanto getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BasePagoadelantoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'idAdelanto' => new sfWidgetFormPropelChoice(array('model' => 'Adelanto', 'add_empty' => false)),
      'fecha'      => new sfWidgetFormDate(),
      'monto'      => new sfWidgetFormInputText(),
      'detalle'    => new sfWidgetFormInputText(),
      'fechaAlta'  => new sfWidgetFormDateTime(),
      'fechaBaja'  => new sfWidgetFormDateTime(),
      'habilitado' => new sfWidgetFormInputCheckbox(),
      'usuario'    => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'idAdelanto' => new sfValidatorPropelChoice(array('model' => 'Adelanto', 'column' => 'id')),
      'fecha'      => new sfValidatorDate(),
      'monto'      => new sfValidatorNumber(),
      'detalle'    => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'fechaAlta'  => new sfValidatorDateTime(),
      'fechaBaja'  => new sfValidatorDateTime(array('required' => false)),
      'habilitado' => new sfValidatorBoolean(array('required' => false)),
      'usuario'    => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('pagoadelanto[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pagoadelanto';
  }


}
