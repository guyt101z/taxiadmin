<?php

/**
 * Despacho filter form base class.
 *
 * @package    taxi
 * @subpackage filter
 * @author     Brus
 */
abstract class BaseDespachoFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'              => new sfWidgetFormFilterInput(),
      'descripcion'         => new sfWidgetFormFilterInput(),
      'fechaAlta'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechaBaja'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'habilitado'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'usuario'             => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => true)),
      'movil_despacho_list' => new sfWidgetFormPropelChoice(array('model' => 'Movil', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre'              => new sfValidatorPass(array('required' => false)),
      'descripcion'         => new sfValidatorPass(array('required' => false)),
      'fechaAlta'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'fechaBaja'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'habilitado'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'usuario'             => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Usuario', 'column' => 'id')),
      'movil_despacho_list' => new sfValidatorPropelChoice(array('model' => 'Movil', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('despacho_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addMovilDespachoListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(MovilDespachoPeer::IDDESPACHO, DespachoPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(MovilDespachoPeer::IDMOVIL, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(MovilDespachoPeer::IDMOVIL, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Despacho';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'nombre'              => 'Text',
      'descripcion'         => 'Text',
      'fechaAlta'           => 'Date',
      'fechaBaja'           => 'Date',
      'habilitado'          => 'Boolean',
      'usuario'             => 'ForeignKey',
      'movil_despacho_list' => 'ManyKey',
    );
  }
}
