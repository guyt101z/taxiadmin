<?php

/**
 * Multa filter form base class.
 *
 * @package    taxi
 * @subpackage filter
 * @author     Brus
 */
abstract class BaseMultaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'idChofer'         => new sfWidgetFormPropelChoice(array('model' => 'Chofer', 'add_empty' => true)),
      'idMovil'          => new sfWidgetFormPropelChoice(array('model' => 'Movil', 'add_empty' => true)),
      'fecha'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'descripcion'      => new sfWidgetFormFilterInput(),
      'esquina'          => new sfWidgetFormFilterInput(),
      'responsable'      => new sfWidgetFormFilterInput(),
      'costo'            => new sfWidgetFormFilterInput(),
      'fechaVencimiento' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'pago'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'fechaPago'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fechaAlta'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fechaBaja'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'habilitado'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'usuario'          => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idChofer'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Chofer', 'column' => 'id')),
      'idMovil'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Movil', 'column' => 'id')),
      'fecha'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'descripcion'      => new sfValidatorPass(array('required' => false)),
      'esquina'          => new sfValidatorPass(array('required' => false)),
      'responsable'      => new sfValidatorPass(array('required' => false)),
      'costo'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'fechaVencimiento' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'pago'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'fechaPago'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'fechaAlta'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'fechaBaja'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'habilitado'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'usuario'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('multa_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Multa';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'idChofer'         => 'ForeignKey',
      'idMovil'          => 'ForeignKey',
      'fecha'            => 'Date',
      'descripcion'      => 'Text',
      'esquina'          => 'Text',
      'responsable'      => 'Text',
      'costo'            => 'Number',
      'fechaVencimiento' => 'Date',
      'pago'             => 'Boolean',
      'fechaPago'        => 'Date',
      'fechaAlta'        => 'Date',
      'fechaBaja'        => 'Date',
      'habilitado'       => 'Boolean',
      'usuario'          => 'ForeignKey',
    );
  }
}
