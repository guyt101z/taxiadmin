<?php

/**
 * MovilAseguradora form base class.
 *
 * @method MovilAseguradora getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BaseMovilAseguradoraForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'idMovil'       => new sfWidgetFormInputHidden(),
      'idAseguradora' => new sfWidgetFormPropelChoice(array('model' => 'Aseguradora', 'add_empty' => false)),
      'fechaAlta'     => new sfWidgetFormDateTime(),
      'fechaBaja'     => new sfWidgetFormDateTime(),
      'habilitado'    => new sfWidgetFormInputCheckbox(),
      'usuario'       => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'idMovil'       => new sfValidatorPropelChoice(array('model' => 'Movil', 'column' => 'id', 'required' => false)),
      'idAseguradora' => new sfValidatorPropelChoice(array('model' => 'Aseguradora', 'column' => 'id')),
      'fechaAlta'     => new sfValidatorDateTime(),
      'fechaBaja'     => new sfValidatorDateTime(array('required' => false)),
      'habilitado'    => new sfValidatorBoolean(array('required' => false)),
      'usuario'       => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('movil_aseguradora[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MovilAseguradora';
  }


}
