<?php

/**
 * Empresa filter form base class.
 *
 * @package    taxi
 * @subpackage filter
 * @author     Brus
 */
abstract class BaseEmpresaFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'nombre'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'razonSocial'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'idBanco'                  => new sfWidgetFormPropelChoice(array('model' => 'Banco', 'add_empty' => true)),
      'numeroCuenta'             => new sfWidgetFormFilterInput(),
      'fechaAlta'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechaBaja'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'habilitado'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'usuario'                  => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => true)),
      'empresa_propietario_list' => new sfWidgetFormPropelChoice(array('model' => 'Propietario', 'add_empty' => true)),
      'movil_empresa_list'       => new sfWidgetFormPropelChoice(array('model' => 'Movil', 'add_empty' => true)),
      'chofer_empresa_list'      => new sfWidgetFormPropelChoice(array('model' => 'Chofer', 'add_empty' => true)),
      'pagoaseguradora_list'     => new sfWidgetFormPropelChoice(array('model' => 'Aseguradora', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'nombre'                   => new sfValidatorPass(array('required' => false)),
      'razonSocial'              => new sfValidatorPass(array('required' => false)),
      'idBanco'                  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Banco', 'column' => 'id')),
      'numeroCuenta'             => new sfValidatorPass(array('required' => false)),
      'fechaAlta'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'fechaBaja'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'habilitado'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'usuario'                  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Usuario', 'column' => 'id')),
      'empresa_propietario_list' => new sfValidatorPropelChoice(array('model' => 'Propietario', 'required' => false)),
      'movil_empresa_list'       => new sfValidatorPropelChoice(array('model' => 'Movil', 'required' => false)),
      'chofer_empresa_list'      => new sfValidatorPropelChoice(array('model' => 'Chofer', 'required' => false)),
      'pagoaseguradora_list'     => new sfValidatorPropelChoice(array('model' => 'Aseguradora', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('empresa_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addEmpresaPropietarioListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(EmpresaPropietarioPeer::IDEMPRESA, EmpresaPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(EmpresaPropietarioPeer::IDPROPIETARIO, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(EmpresaPropietarioPeer::IDPROPIETARIO, $value));
    }

    $criteria->add($criterion);
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

    $criteria->addJoin(MovilEmpresaPeer::IDEMPRESA, EmpresaPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(MovilEmpresaPeer::IDMOVIL, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(MovilEmpresaPeer::IDMOVIL, $value));
    }

    $criteria->add($criterion);
  }

  public function addChoferEmpresaListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(ChoferEmpresaPeer::IDEMPRESA, EmpresaPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(ChoferEmpresaPeer::IDCHOFER, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(ChoferEmpresaPeer::IDCHOFER, $value));
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

    $criteria->addJoin(PagoaseguradoraPeer::IDEMPRESA, EmpresaPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(PagoaseguradoraPeer::IDASEGURADORA, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(PagoaseguradoraPeer::IDASEGURADORA, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Empresa';
  }

  public function getFields()
  {
    return array(
      'id'                       => 'Number',
      'nombre'                   => 'Text',
      'razonSocial'              => 'Text',
      'idBanco'                  => 'ForeignKey',
      'numeroCuenta'             => 'Text',
      'fechaAlta'                => 'Date',
      'fechaBaja'                => 'Date',
      'habilitado'               => 'Boolean',
      'usuario'                  => 'ForeignKey',
      'empresa_propietario_list' => 'ManyKey',
      'movil_empresa_list'       => 'ManyKey',
      'chofer_empresa_list'      => 'ManyKey',
      'pagoaseguradora_list'     => 'ManyKey',
    );
  }
}
