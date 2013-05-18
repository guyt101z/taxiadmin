<?php

/**
 * ChoferEmpresa form base class.
 *
 * @method ChoferEmpresa getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BaseChoferEmpresaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'idChofer'   => new sfWidgetFormInputHidden(),
      'idEmpresa'  => new sfWidgetFormInputHidden(),
      'fechaAlta'  => new sfWidgetFormDateTime(),
      'fechaBaja'  => new sfWidgetFormDateTime(),
      'habilitado' => new sfWidgetFormInputCheckbox(),
      'usuario'    => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'idChofer'   => new sfValidatorPropelChoice(array('model' => 'Chofer', 'column' => 'id', 'required' => false)),
      'idEmpresa'  => new sfValidatorPropelChoice(array('model' => 'Empresa', 'column' => 'id', 'required' => false)),
      'fechaAlta'  => new sfValidatorDateTime(),
      'fechaBaja'  => new sfValidatorDateTime(array('required' => false)),
      'habilitado' => new sfValidatorBoolean(array('required' => false)),
      'usuario'    => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('chofer_empresa[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ChoferEmpresa';
  }


}
