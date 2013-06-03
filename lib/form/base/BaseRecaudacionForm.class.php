<?php

/**
 * Recaudacion form base class.
 *
 * @method Recaudacion getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BaseRecaudacionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'idMovil'       => new sfWidgetFormPropelChoice(array('model' => 'Movil', 'add_empty' => false)),
      'idChofer'      => new sfWidgetFormPropelChoice(array('model' => 'Chofer', 'add_empty' => false)),
      'fecha'         => new sfWidgetFormDate(),
      'km'            => new sfWidgetFormInputText(),
      'recaudacion'   => new sfWidgetFormInputText(),
      'totalGastos'   => new sfWidgetFormInputText(),
      'importeChofer' => new sfWidgetFormInputText(),
      'importeMovil'  => new sfWidgetFormInputText(),
      'aporteLeyes'   => new sfWidgetFormInputText(),
      'fechaAlta'     => new sfWidgetFormDateTime(),
      'fechaBaja'     => new sfWidgetFormDateTime(),
      'habilitado'    => new sfWidgetFormInputCheckbox(),
      'usuario'       => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'idMovil'       => new sfValidatorPropelChoice(array('model' => 'Movil', 'column' => 'id')),
      'idChofer'      => new sfValidatorPropelChoice(array('model' => 'Chofer', 'column' => 'id')),
      'fecha'         => new sfValidatorDate(),
      'km'            => new sfValidatorNumber(),
      'recaudacion'   => new sfValidatorNumber(),
      'totalGastos'   => new sfValidatorNumber(),
      'importeChofer' => new sfValidatorNumber(),
      'importeMovil'  => new sfValidatorNumber(),
      'aporteLeyes'   => new sfValidatorNumber(),
      'fechaAlta'     => new sfValidatorDateTime(),
      'fechaBaja'     => new sfValidatorDateTime(array('required' => false)),
      'habilitado'    => new sfValidatorBoolean(array('required' => false)),
      'usuario'       => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('recaudacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Recaudacion';
  }


}
