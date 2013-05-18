<?php

/**
 * EmpresaPropietario form base class.
 *
 * @method EmpresaPropietario getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BaseEmpresaPropietarioForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'idEmpresa'     => new sfWidgetFormInputHidden(),
      'idPropietario' => new sfWidgetFormInputHidden(),
      'fechaAlta'     => new sfWidgetFormDateTime(),
      'fechaBaja'     => new sfWidgetFormDateTime(),
      'habilitado'    => new sfWidgetFormInputCheckbox(),
      'usuario'       => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'idEmpresa'     => new sfValidatorPropelChoice(array('model' => 'Empresa', 'column' => 'id', 'required' => false)),
      'idPropietario' => new sfValidatorPropelChoice(array('model' => 'Propietario', 'column' => 'id', 'required' => false)),
      'fechaAlta'     => new sfValidatorDateTime(),
      'fechaBaja'     => new sfValidatorDateTime(array('required' => false)),
      'habilitado'    => new sfValidatorBoolean(array('required' => false)),
      'usuario'       => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('empresa_propietario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'EmpresaPropietario';
  }


}
