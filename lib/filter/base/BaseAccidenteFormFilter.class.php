<?php

/**
 * Accidente filter form base class.
 *
 * @package    taxi
 * @subpackage filter
 * @author     Brus
 */
abstract class BaseAccidenteFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'idChofer'    => new sfWidgetFormPropelChoice(array('model' => 'Chofer', 'add_empty' => true)),
      'idMovil'     => new sfWidgetFormPropelChoice(array('model' => 'Movil', 'add_empty' => true)),
      'fecha'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'responsable' => new sfWidgetFormFilterInput(),
      'esquina'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'heridos'     => new sfWidgetFormFilterInput(),
      'deducible'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'descripcion' => new sfWidgetFormFilterInput(),
      'fechaAlta'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechaBaja'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'habilitado'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'usuario'     => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idChofer'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Chofer', 'column' => 'id')),
      'idMovil'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Movil', 'column' => 'id')),
      'fecha'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'responsable' => new sfValidatorPass(array('required' => false)),
      'esquina'     => new sfValidatorPass(array('required' => false)),
      'heridos'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'deducible'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'descripcion' => new sfValidatorPass(array('required' => false)),
      'fechaAlta'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'fechaBaja'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'habilitado'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'usuario'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('accidente_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Accidente';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'idChofer'    => 'ForeignKey',
      'idMovil'     => 'ForeignKey',
      'fecha'       => 'Date',
      'responsable' => 'Text',
      'esquina'     => 'Text',
      'heridos'     => 'Number',
      'deducible'   => 'Boolean',
      'descripcion' => 'Text',
      'fechaAlta'   => 'Date',
      'fechaBaja'   => 'Date',
      'habilitado'  => 'Boolean',
      'usuario'     => 'ForeignKey',
    );
  }
}
