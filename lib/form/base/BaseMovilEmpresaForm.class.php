<?php

/**
 * MovilEmpresa form base class.
 *
 * @method MovilEmpresa getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BaseMovilEmpresaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'idMovil'    => new sfWidgetFormInputHidden(),
      'idEmpresa'  => new sfWidgetFormInputHidden(),
      'fechaAlta'  => new sfWidgetFormDateTime(),
      'fechaBaja'  => new sfWidgetFormDateTime(),
      'habilitado' => new sfWidgetFormInputCheckbox(),
      'usuario'    => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'idMovil'    => new sfValidatorPropelChoice(array('model' => 'Movil', 'column' => 'id', 'required' => false)),
      'idEmpresa'  => new sfValidatorPropelChoice(array('model' => 'Empresa', 'column' => 'id', 'required' => false)),
      'fechaAlta'  => new sfValidatorDateTime(),
      'fechaBaja'  => new sfValidatorDateTime(array('required' => false)),
      'habilitado' => new sfValidatorBoolean(array('required' => false)),
      'usuario'    => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('movil_empresa[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MovilEmpresa';
  }


}
