<?php

/**
 * MovilDespacho form base class.
 *
 * @method MovilDespacho getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BaseMovilDespachoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'idMovil'    => new sfWidgetFormInputHidden(),
      'idDespacho' => new sfWidgetFormInputHidden(),
      'fechaAlta'  => new sfWidgetFormDateTime(),
      'fechaBaja'  => new sfWidgetFormDateTime(),
      'habilitado' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'idMovil'    => new sfValidatorPropelChoice(array('model' => 'Movil', 'column' => 'id', 'required' => false)),
      'idDespacho' => new sfValidatorPropelChoice(array('model' => 'Despacho', 'column' => 'id', 'required' => false)),
      'fechaAlta'  => new sfValidatorDateTime(),
      'fechaBaja'  => new sfValidatorDateTime(array('required' => false)),
      'habilitado' => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('movil_despacho[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MovilDespacho';
  }


}
