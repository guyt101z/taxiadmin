<?php

/**
 * Gastorecaudacion filter form base class.
 *
 * @package    taxi
 * @subpackage filter
 * @author     Brus
 */
abstract class BaseGastorecaudacionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'idRecaudacion' => new sfWidgetFormPropelChoice(array('model' => 'Recaudacion', 'add_empty' => true)),
      'costo'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'detalle'       => new sfWidgetFormFilterInput(),
      'usuario'       => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idRecaudacion' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Recaudacion', 'column' => 'id')),
      'costo'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'detalle'       => new sfValidatorPass(array('required' => false)),
      'usuario'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('gastorecaudacion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Gastorecaudacion';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'idRecaudacion' => 'ForeignKey',
      'costo'         => 'Number',
      'detalle'       => 'Text',
      'usuario'       => 'ForeignKey',
    );
  }
}
