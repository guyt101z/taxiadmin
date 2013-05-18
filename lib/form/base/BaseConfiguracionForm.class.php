<?php

/**
 * Configuracion form base class.
 *
 * @method Configuracion getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BaseConfiguracionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'idUsuario'        => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
      'fichaNocturna'    => new sfWidgetFormInputText(),
      'fichaDiurna'      => new sfWidgetFormInputText(),
      'banderaDiurna'    => new sfWidgetFormInputText(),
      'banderaNocturna'  => new sfWidgetFormInputText(),
      'avisoVencimiento' => new sfWidgetFormInputCheckbox(),
      'id'               => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'idUsuario'        => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'id')),
      'fichaNocturna'    => new sfValidatorNumber(),
      'fichaDiurna'      => new sfValidatorNumber(),
      'banderaDiurna'    => new sfValidatorNumber(),
      'banderaNocturna'  => new sfValidatorNumber(),
      'avisoVencimiento' => new sfValidatorBoolean(),
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('configuracion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Configuracion';
  }


}
