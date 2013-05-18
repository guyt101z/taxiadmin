<?php

/**
 * MovilAseguradora filter form base class.
 *
 * @package    taxi
 * @subpackage filter
 * @author     Brus
 */
abstract class BaseMovilAseguradoraFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'idAseguradora' => new sfWidgetFormPropelChoice(array('model' => 'Aseguradora', 'add_empty' => true)),
      'fechaAlta'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechaBaja'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'habilitado'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'usuario'       => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idAseguradora' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Aseguradora', 'column' => 'id')),
      'fechaAlta'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'fechaBaja'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'habilitado'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'usuario'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('movil_aseguradora_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MovilAseguradora';
  }

  public function getFields()
  {
    return array(
      'idMovil'       => 'ForeignKey',
      'idAseguradora' => 'ForeignKey',
      'fechaAlta'     => 'Date',
      'fechaBaja'     => 'Date',
      'habilitado'    => 'Boolean',
      'usuario'       => 'ForeignKey',
    );
  }
}
