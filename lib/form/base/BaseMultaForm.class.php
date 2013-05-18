<?php

/**
 * Multa form base class.
 *
 * @method Multa getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BaseMultaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'idChofer'         => new sfWidgetFormPropelChoice(array('model' => 'Chofer', 'add_empty' => false)),
      'idMovil'          => new sfWidgetFormPropelChoice(array('model' => 'Movil', 'add_empty' => false)),
      'fecha'            => new sfWidgetFormDate(),
      'descripcion'      => new sfWidgetFormInputText(),
      'esquina'          => new sfWidgetFormInputText(),
      'responsable'      => new sfWidgetFormInputText(),
      'costo'            => new sfWidgetFormInputText(),
      'fechaVencimiento' => new sfWidgetFormDate(),
      'pago'             => new sfWidgetFormInputCheckbox(),
      'fechaPago'        => new sfWidgetFormDate(),
      'fechaAlta'        => new sfWidgetFormDateTime(),
      'fechaBaja'        => new sfWidgetFormDateTime(),
      'habilitado'       => new sfWidgetFormInputCheckbox(),
      'usuario'          => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'idChofer'         => new sfValidatorPropelChoice(array('model' => 'Chofer', 'column' => 'id')),
      'idMovil'          => new sfValidatorPropelChoice(array('model' => 'Movil', 'column' => 'id')),
      'fecha'            => new sfValidatorDate(array('required' => false)),
      'descripcion'      => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'esquina'          => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'responsable'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'costo'            => new sfValidatorNumber(array('required' => false)),
      'fechaVencimiento' => new sfValidatorDate(array('required' => false)),
      'pago'             => new sfValidatorBoolean(),
      'fechaPago'        => new sfValidatorDate(array('required' => false)),
      'fechaAlta'        => new sfValidatorDateTime(array('required' => false)),
      'fechaBaja'        => new sfValidatorDateTime(array('required' => false)),
      'habilitado'       => new sfValidatorBoolean(array('required' => false)),
      'usuario'          => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('multa[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Multa';
  }


}
