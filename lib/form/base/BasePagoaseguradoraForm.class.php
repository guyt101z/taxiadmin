<?php

/**
 * Pagoaseguradora form base class.
 *
 * @method Pagoaseguradora getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BasePagoaseguradoraForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'idEmpresa'           => new sfWidgetFormInputHidden(),
      'idAseguradora'       => new sfWidgetFormInputHidden(),
      'idMovil'             => new sfWidgetFormInputHidden(),
      'pagoCorrespondiente' => new sfWidgetFormInputHidden(),
      'monto'               => new sfWidgetFormInputText(),
      'fechaPago'           => new sfWidgetFormDate(),
      'fechaAlta'           => new sfWidgetFormDateTime(),
      'fechaBaja'           => new sfWidgetFormDateTime(),
      'habilitado'          => new sfWidgetFormInputCheckbox(),
      'usuario'             => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'idEmpresa'           => new sfValidatorPropelChoice(array('model' => 'Empresa', 'column' => 'id', 'required' => false)),
      'idAseguradora'       => new sfValidatorPropelChoice(array('model' => 'Aseguradora', 'column' => 'id', 'required' => false)),
      'idMovil'             => new sfValidatorPropelChoice(array('model' => 'Movil', 'column' => 'id', 'required' => false)),
      'pagoCorrespondiente' => new sfValidatorChoice(array('choices' => array($this->getObject()->getPagocorrespondiente()), 'empty_value' => $this->getObject()->getPagocorrespondiente(), 'required' => false)),
      'monto'               => new sfValidatorNumber(),
      'fechaPago'           => new sfValidatorDate(),
      'fechaAlta'           => new sfValidatorDateTime(),
      'fechaBaja'           => new sfValidatorDateTime(array('required' => false)),
      'habilitado'          => new sfValidatorBoolean(array('required' => false)),
      'usuario'             => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('pagoaseguradora[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pagoaseguradora';
  }


}
