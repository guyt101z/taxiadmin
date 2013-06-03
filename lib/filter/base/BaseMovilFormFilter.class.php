<?php

/**
 * Movil filter form base class.
 *
 * @package    taxi
 * @subpackage filter
 * @author     Brus
 */
abstract class BaseMovilFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'matricula'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'marca'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'modelo'               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'anio'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'numeroChasis'         => new sfWidgetFormFilterInput(),
      'combustible'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'numeroMovil'          => new sfWidgetFormFilterInput(),
      'idDespacho'           => new sfWidgetFormPropelChoice(array('model' => 'Despacho', 'add_empty' => true)),
      'kmIniciales'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idAseguradora'        => new sfWidgetFormPropelChoice(array('model' => 'Aseguradora', 'add_empty' => true)),
      'fechaAlta'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechaBaja'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'habilitado'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'usuario'              => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => true)),
      'movil_empresa_list'   => new sfWidgetFormPropelChoice(array('model' => 'Empresa', 'add_empty' => true)),
      'movil_despacho_list'  => new sfWidgetFormPropelChoice(array('model' => 'Despacho', 'add_empty' => true)),
      'pagoaseguradora_list' => new sfWidgetFormPropelChoice(array('model' => 'Empresa', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'matricula'            => new sfValidatorPass(array('required' => false)),
      'marca'                => new sfValidatorPass(array('required' => false)),
      'modelo'               => new sfValidatorPass(array('required' => false)),
      'anio'                 => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'numeroChasis'         => new sfValidatorPass(array('required' => false)),
      'combustible'          => new sfValidatorPass(array('required' => false)),
      'numeroMovil'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idDespacho'           => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Despacho', 'column' => 'id')),
      'kmIniciales'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'idAseguradora'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Aseguradora', 'column' => 'id')),
      'fechaAlta'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'fechaBaja'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'habilitado'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'usuario'              => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Usuario', 'column' => 'id')),
      'movil_empresa_list'   => new sfValidatorPropelChoice(array('model' => 'Empresa', 'required' => false)),
      'movil_despacho_list'  => new sfValidatorPropelChoice(array('model' => 'Despacho', 'required' => false)),
      'pagoaseguradora_list' => new sfValidatorPropelChoice(array('model' => 'Empresa', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('movil_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addMovilEmpresaListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(MovilEmpresaPeer::IDMOVIL, MovilPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(MovilEmpresaPeer::IDEMPRESA, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(MovilEmpresaPeer::IDEMPRESA, $value));
    }

    $criteria->add($criterion);
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

    $criteria->addJoin(MovilDespachoPeer::IDMOVIL, MovilPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(MovilDespachoPeer::IDDESPACHO, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(MovilDespachoPeer::IDDESPACHO, $value));
    }

    $criteria->add($criterion);
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

    $criteria->addJoin(PagoaseguradoraPeer::IDMOVIL, MovilPeer::ID);

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
    return 'Movil';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'matricula'            => 'Text',
      'marca'                => 'Text',
      'modelo'               => 'Text',
      'anio'                 => 'Number',
      'numeroChasis'         => 'Text',
      'combustible'          => 'Text',
      'numeroMovil'          => 'Number',
      'idDespacho'           => 'ForeignKey',
      'kmIniciales'          => 'Number',
      'idAseguradora'        => 'ForeignKey',
      'fechaAlta'            => 'Date',
      'fechaBaja'            => 'Date',
      'habilitado'           => 'Boolean',
      'usuario'              => 'ForeignKey',
      'movil_empresa_list'   => 'ManyKey',
      'movil_despacho_list'  => 'ManyKey',
      'pagoaseguradora_list' => 'ManyKey',
    );
  }
}
