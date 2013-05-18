<?php

/**
 * Evento filter form base class.
 *
 * @package    taxi
 * @subpackage filter
 * @author     Brus
 */
abstract class BaseEventoFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'idUsuario' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'evento'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'idUsuario' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'evento'    => new sfValidatorPass(array('required' => false)),
      'fecha'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('evento_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Evento';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'idUsuario' => 'Number',
      'evento'    => 'Text',
      'fecha'     => 'Date',
    );
  }
}
