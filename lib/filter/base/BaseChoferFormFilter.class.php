<?php

/**
 * Chofer filter form base class.
 *
 * @package    taxi
 * @subpackage filter
 * @author     Brus
 */
abstract class BaseChoferFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'cedula'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nombre'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'apellidos'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'direccion'                  => new sfWidgetFormFilterInput(),
      'telefono'                   => new sfWidgetFormFilterInput(),
      'celular'                    => new sfWidgetFormFilterInput(),
      'email'                      => new sfWidgetFormFilterInput(),
      'vencimientoLibretaConducir' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'vencimientoCarneSalud'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'fechaAlta'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechaBaja'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'habilitado'                 => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'usuario'                    => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => true)),
      'chofer_empresa_list'        => new sfWidgetFormPropelChoice(array('model' => 'Empresa', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'cedula'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nombre'                     => new sfValidatorPass(array('required' => false)),
      'apellidos'                  => new sfValidatorPass(array('required' => false)),
      'direccion'                  => new sfValidatorPass(array('required' => false)),
      'telefono'                   => new sfValidatorPass(array('required' => false)),
      'celular'                    => new sfValidatorPass(array('required' => false)),
      'email'                      => new sfValidatorPass(array('required' => false)),
      'vencimientoLibretaConducir' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'vencimientoCarneSalud'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'fechaAlta'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'fechaBaja'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'habilitado'                 => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'usuario'                    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Usuario', 'column' => 'id')),
      'chofer_empresa_list'        => new sfValidatorPropelChoice(array('model' => 'Empresa', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('chofer_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
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

    $criteria->addJoin(ChoferEmpresaPeer::IDCHOFER, ChoferPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(ChoferEmpresaPeer::IDEMPRESA, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(ChoferEmpresaPeer::IDEMPRESA, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Chofer';
  }

  public function getFields()
  {
    return array(
      'id'                         => 'Number',
      'cedula'                     => 'Number',
      'nombre'                     => 'Text',
      'apellidos'                  => 'Text',
      'direccion'                  => 'Text',
      'telefono'                   => 'Text',
      'celular'                    => 'Text',
      'email'                      => 'Text',
      'vencimientoLibretaConducir' => 'Date',
      'vencimientoCarneSalud'      => 'Date',
      'fechaAlta'                  => 'Date',
      'fechaBaja'                  => 'Date',
      'habilitado'                 => 'Boolean',
      'usuario'                    => 'ForeignKey',
      'chofer_empresa_list'        => 'ManyKey',
    );
  }
}
