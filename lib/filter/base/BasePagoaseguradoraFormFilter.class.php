<?php

/**
 * Pagoaseguradora filter form base class.
 *
 * @package    taxi
 * @subpackage filter
 * @author     Brus
 */
abstract class BasePagoaseguradoraFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'monto'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fechaPago'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechaAlta'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechaBaja'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'habilitado'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'usuario'             => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'monto'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'fechaPago'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'fechaAlta'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'fechaBaja'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'habilitado'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'usuario'             => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('pagoaseguradora_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Pagoaseguradora';
  }

  public function getFields()
  {
    return array(
      'idEmpresa'           => 'ForeignKey',
      'idAseguradora'       => 'ForeignKey',
      'idMovil'             => 'ForeignKey',
      'pagoCorrespondiente' => 'Date',
      'monto'               => 'Number',
      'fechaPago'           => 'Date',
      'fechaAlta'           => 'Date',
      'fechaBaja'           => 'Date',
      'habilitado'          => 'Boolean',
      'usuario'             => 'ForeignKey',
    );
  }
}
