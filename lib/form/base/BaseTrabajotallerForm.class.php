<?php

/**
 * Trabajotaller form base class.
 *
 * @method Trabajotaller getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BaseTrabajotallerForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'idMovil'         => new sfWidgetFormPropelChoice(array('model' => 'Movil', 'add_empty' => false)),
      'idTaller'        => new sfWidgetFormPropelChoice(array('model' => 'Taller', 'add_empty' => false)),
      'fechaIngreso'    => new sfWidgetFormDate(),
      'motivoIngreso'   => new sfWidgetFormInputText(),
      'costoMateriales' => new sfWidgetFormInputText(),
      'costoManoObra'   => new sfWidgetFormInputText(),
      'detalleTrabajo'  => new sfWidgetFormInputText(),
      'responsable'     => new sfWidgetFormInputText(),
      'tipoPago'        => new sfWidgetFormInputText(),
      'totalTrabajo'    => new sfWidgetFormInputText(),
      'numeroFactura'   => new sfWidgetFormInputText(),
      'fechaAlta'       => new sfWidgetFormDateTime(),
      'fechaBaja'       => new sfWidgetFormDateTime(),
      'habilitado'      => new sfWidgetFormInputCheckbox(),
      'usuario'         => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'idMovil'         => new sfValidatorPropelChoice(array('model' => 'Movil', 'column' => 'id')),
      'idTaller'        => new sfValidatorPropelChoice(array('model' => 'Taller', 'column' => 'id')),
      'fechaIngreso'    => new sfValidatorDate(array('required' => false)),
      'motivoIngreso'   => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'costoMateriales' => new sfValidatorNumber(array('required' => false)),
      'costoManoObra'   => new sfValidatorNumber(array('required' => false)),
      'detalleTrabajo'  => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'responsable'     => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'tipoPago'        => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'totalTrabajo'    => new sfValidatorNumber(array('required' => false)),
      'numeroFactura'   => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'fechaAlta'       => new sfValidatorDateTime(),
      'fechaBaja'       => new sfValidatorDateTime(array('required' => false)),
      'habilitado'      => new sfValidatorBoolean(array('required' => false)),
      'usuario'         => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('trabajotaller[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Trabajotaller';
  }


}
