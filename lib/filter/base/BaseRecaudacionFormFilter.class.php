<?php

/**
 * Recaudacion filter form base class.
 *
 * @package    taxi
 * @subpackage filter
 * @author     Brus
 */
abstract class BaseRecaudacionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'idMovil'       => new sfWidgetFormPropelChoice(array('model' => 'Movil', 'add_empty' => true)),
      'idChofer'      => new sfWidgetFormPropelChoice(array('model' => 'Chofer', 'add_empty' => true)),
      'fecha'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'km'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'recaudacion'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'totalGastos'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'importeChofer' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'importeMovil'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'aporteLeyes'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fechaAlta'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechaBaja'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'habilitado'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'usuario'       => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idMovil'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Movil', 'column' => 'id')),
      'idChofer'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Chofer', 'column' => 'id')),
      'fecha'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'km'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'recaudacion'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'totalGastos'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'importeChofer' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'importeMovil'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'aporteLeyes'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'fechaAlta'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'fechaBaja'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'habilitado'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'usuario'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('recaudacion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Recaudacion';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'idMovil'       => 'ForeignKey',
      'idChofer'      => 'ForeignKey',
      'fecha'         => 'Date',
      'km'            => 'Number',
      'recaudacion'   => 'Number',
      'totalGastos'   => 'Number',
      'importeChofer' => 'Number',
      'importeMovil'  => 'Number',
      'aporteLeyes'   => 'Number',
      'fechaAlta'     => 'Date',
      'fechaBaja'     => 'Date',
      'habilitado'    => 'Boolean',
      'usuario'       => 'ForeignKey',
    );
  }
}
