<?php

/**
 * Accidente form base class.
 *
 * @method Accidente getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BaseAccidenteForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'idChofer'    => new sfWidgetFormPropelChoice(array('model' => 'Chofer', 'add_empty' => false)),
      'idMovil'     => new sfWidgetFormPropelChoice(array('model' => 'Movil', 'add_empty' => false)),
      'fecha'       => new sfWidgetFormDate(),
      'responsable' => new sfWidgetFormInputText(),
      'esquina'     => new sfWidgetFormInputText(),
      'heridos'     => new sfWidgetFormInputText(),
      'deducible'   => new sfWidgetFormInputCheckbox(),
      'descripcion' => new sfWidgetFormInputText(),
      'fechaAlta'   => new sfWidgetFormDateTime(),
      'fechaBaja'   => new sfWidgetFormDateTime(),
      'habilitado'  => new sfWidgetFormInputCheckbox(),
      'usuario'     => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'idChofer'    => new sfValidatorPropelChoice(array('model' => 'Chofer', 'column' => 'id')),
      'idMovil'     => new sfValidatorPropelChoice(array('model' => 'Movil', 'column' => 'id')),
      'fecha'       => new sfValidatorDate(),
      'responsable' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'esquina'     => new sfValidatorString(array('max_length' => 200)),
      'heridos'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'deducible'   => new sfValidatorBoolean(array('required' => false)),
      'descripcion' => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'fechaAlta'   => new sfValidatorDateTime(),
      'fechaBaja'   => new sfValidatorDateTime(array('required' => false)),
      'habilitado'  => new sfValidatorBoolean(array('required' => false)),
      'usuario'     => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('accidente[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Accidente';
  }


}
