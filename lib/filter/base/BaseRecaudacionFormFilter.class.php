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
      'idMovil'               => new sfWidgetFormPropelChoice(array('model' => 'Movil', 'add_empty' => true)),
      'idChofer'              => new sfWidgetFormPropelChoice(array('model' => 'Chofer', 'add_empty' => true)),
      'turno'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fecha'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'kmInicialAuto'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'kmFinalAuto'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'kmInicialReloj'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'kmFinalReloj'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fichasIniciales'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fichasFinales'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fichasDiurnas'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fichasNocturnas'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'banderasDiurnas'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'banderasNocturnas'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'porcentajeRecaudacion' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'importeChofer'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'importeMovil'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'recaudacion'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'aportePatronal'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descuentoFichas'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'descuentoBanderas'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fechaAlta'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechaBaja'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'habilitado'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'usuario'               => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idMovil'               => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Movil', 'column' => 'id')),
      'idChofer'              => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Chofer', 'column' => 'id')),
      'turno'                 => new sfValidatorPass(array('required' => false)),
      'fecha'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'kmInicialAuto'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'kmFinalAuto'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'kmInicialReloj'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'kmFinalReloj'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'fichasIniciales'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'fichasFinales'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'fichasDiurnas'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'fichasNocturnas'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'banderasDiurnas'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'banderasNocturnas'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'porcentajeRecaudacion' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'importeChofer'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'importeMovil'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'recaudacion'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'aportePatronal'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'descuentoFichas'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'descuentoBanderas'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'fechaAlta'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'fechaBaja'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'habilitado'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'usuario'               => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Usuario', 'column' => 'id')),
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
      'id'                    => 'Number',
      'idMovil'               => 'ForeignKey',
      'idChofer'              => 'ForeignKey',
      'turno'                 => 'Text',
      'fecha'                 => 'Date',
      'kmInicialAuto'         => 'Number',
      'kmFinalAuto'           => 'Number',
      'kmInicialReloj'        => 'Number',
      'kmFinalReloj'          => 'Number',
      'fichasIniciales'       => 'Number',
      'fichasFinales'         => 'Number',
      'fichasDiurnas'         => 'Number',
      'fichasNocturnas'       => 'Number',
      'banderasDiurnas'       => 'Number',
      'banderasNocturnas'     => 'Number',
      'porcentajeRecaudacion' => 'Number',
      'importeChofer'         => 'Number',
      'importeMovil'          => 'Number',
      'recaudacion'           => 'Number',
      'aportePatronal'        => 'Number',
      'descuentoFichas'       => 'Number',
      'descuentoBanderas'     => 'Number',
      'fechaAlta'             => 'Date',
      'fechaBaja'             => 'Date',
      'habilitado'            => 'Boolean',
      'usuario'               => 'ForeignKey',
    );
  }
}
