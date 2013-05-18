<?php

/**
 * Recaudacion form base class.
 *
 * @method Recaudacion getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BaseRecaudacionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'idMovil'               => new sfWidgetFormPropelChoice(array('model' => 'Movil', 'add_empty' => false)),
      'idChofer'              => new sfWidgetFormPropelChoice(array('model' => 'Chofer', 'add_empty' => false)),
      'turno'                 => new sfWidgetFormInputText(),
      'fecha'                 => new sfWidgetFormDate(),
      'kmInicialAuto'         => new sfWidgetFormInputText(),
      'kmFinalAuto'           => new sfWidgetFormInputText(),
      'kmInicialReloj'        => new sfWidgetFormInputText(),
      'kmFinalReloj'          => new sfWidgetFormInputText(),
      'fichasIniciales'       => new sfWidgetFormInputText(),
      'fichasFinales'         => new sfWidgetFormInputText(),
      'fichasDiurnas'         => new sfWidgetFormInputText(),
      'fichasNocturnas'       => new sfWidgetFormInputText(),
      'banderasDiurnas'       => new sfWidgetFormInputText(),
      'banderasNocturnas'     => new sfWidgetFormInputText(),
      'porcentajeRecaudacion' => new sfWidgetFormInputText(),
      'importeChofer'         => new sfWidgetFormInputText(),
      'importeMovil'          => new sfWidgetFormInputText(),
      'recaudacion'           => new sfWidgetFormInputText(),
      'aportePatronal'        => new sfWidgetFormInputText(),
      'descuentoFichas'       => new sfWidgetFormInputText(),
      'descuentoBanderas'     => new sfWidgetFormInputText(),
      'fechaAlta'             => new sfWidgetFormDateTime(),
      'fechaBaja'             => new sfWidgetFormDateTime(),
      'habilitado'            => new sfWidgetFormInputCheckbox(),
      'usuario'               => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'idMovil'               => new sfValidatorPropelChoice(array('model' => 'Movil', 'column' => 'id')),
      'idChofer'              => new sfValidatorPropelChoice(array('model' => 'Chofer', 'column' => 'id')),
      'turno'                 => new sfValidatorString(array('max_length' => 50)),
      'fecha'                 => new sfValidatorDate(),
      'kmInicialAuto'         => new sfValidatorNumber(),
      'kmFinalAuto'           => new sfValidatorNumber(),
      'kmInicialReloj'        => new sfValidatorNumber(),
      'kmFinalReloj'          => new sfValidatorNumber(),
      'fichasIniciales'       => new sfValidatorNumber(),
      'fichasFinales'         => new sfValidatorNumber(),
      'fichasDiurnas'         => new sfValidatorNumber(),
      'fichasNocturnas'       => new sfValidatorNumber(),
      'banderasDiurnas'       => new sfValidatorNumber(),
      'banderasNocturnas'     => new sfValidatorNumber(),
      'porcentajeRecaudacion' => new sfValidatorNumber(),
      'importeChofer'         => new sfValidatorNumber(),
      'importeMovil'          => new sfValidatorNumber(),
      'recaudacion'           => new sfValidatorNumber(),
      'aportePatronal'        => new sfValidatorNumber(),
      'descuentoFichas'       => new sfValidatorNumber(),
      'descuentoBanderas'     => new sfValidatorNumber(),
      'fechaAlta'             => new sfValidatorDateTime(),
      'fechaBaja'             => new sfValidatorDateTime(array('required' => false)),
      'habilitado'            => new sfValidatorBoolean(array('required' => false)),
      'usuario'               => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('recaudacion[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Recaudacion';
  }


}
