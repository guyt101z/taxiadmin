<?php

/**
 * Aseguradora filter form base class.
 *
 * @package    taxi
 * @subpackage filter
 * @author     Brus
 */
abstract class BaseAseguradoraFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'direccion'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'telefono'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'telefono2'            => new sfWidgetFormFilterInput(),
      'telefono3'            => new sfWidgetFormFilterInput(),
      'web'                  => new sfWidgetFormFilterInput(),
      'email'                => new sfWidgetFormFilterInput(),
      'fechaAlta'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechaBaja'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'habilitado'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'usuario'              => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => true)),
      'pagoaseguradora_list' => new sfWidgetFormPropelChoice(array('model' => 'Empresa', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre'               => new sfValidatorPass(array('required' => false)),
      'direccion'            => new sfValidatorPass(array('required' => false)),
      'telefono'             => new sfValidatorPass(array('required' => false)),
      'telefono2'            => new sfValidatorPass(array('required' => false)),
      'telefono3'            => new sfValidatorPass(array('required' => false)),
      'web'                  => new sfValidatorPass(array('required' => false)),
      'email'                => new sfValidatorPass(array('required' => false)),
      'fechaAlta'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'fechaBaja'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'habilitado'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'usuario'              => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Usuario', 'column' => 'id')),
      'pagoaseguradora_list' => new sfValidatorPropelChoice(array('model' => 'Empresa', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('aseguradora_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addPagoaseguradoraListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(PagoaseguradoraPeer::IDASEGURADORA, AseguradoraPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(PagoaseguradoraPeer::IDEMPRESA, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(PagoaseguradoraPeer::IDEMPRESA, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Aseguradora';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'nombre'               => 'Text',
      'direccion'            => 'Text',
      'telefono'             => 'Text',
      'telefono2'            => 'Text',
      'telefono3'            => 'Text',
      'web'                  => 'Text',
      'email'                => 'Text',
      'fechaAlta'            => 'Date',
      'fechaBaja'            => 'Date',
      'habilitado'           => 'Boolean',
      'usuario'              => 'ForeignKey',
      'pagoaseguradora_list' => 'ManyKey',
    );
  }
}
