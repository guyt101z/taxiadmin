<?php

/**
 * Gastomovil filter form base class.
 *
 * @package    taxi
 * @subpackage filter
 * @author     Brus
 */
abstract class BaseGastomovilFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'idMovil'    => new sfWidgetFormPropelChoice(array('model' => 'Movil', 'add_empty' => true)),
      'fecha'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'costo'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'detalle'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fechaAlta'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechaBaja'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'habilitado' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'usuario'    => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idMovil'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Movil', 'column' => 'id')),
      'fecha'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'costo'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'detalle'    => new sfValidatorPass(array('required' => false)),
      'fechaAlta'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'fechaBaja'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'habilitado' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'usuario'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('gastomovil_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Gastomovil';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'idMovil'    => 'ForeignKey',
      'fecha'      => 'Date',
      'costo'      => 'Number',
      'detalle'    => 'Text',
      'fechaAlta'  => 'Date',
      'fechaBaja'  => 'Date',
      'habilitado' => 'Boolean',
      'usuario'    => 'ForeignKey',
    );
  }
}
