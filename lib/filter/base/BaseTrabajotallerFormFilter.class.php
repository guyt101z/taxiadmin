<?php

/**
 * Trabajotaller filter form base class.
 *
 * @package    taxi
 * @subpackage filter
 * @author     Brus
 */
abstract class BaseTrabajotallerFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'idMovil'         => new sfWidgetFormPropelChoice(array('model' => 'Movil', 'add_empty' => true)),
      'idTaller'        => new sfWidgetFormPropelChoice(array('model' => 'Taller', 'add_empty' => true)),
      'fechaIngreso'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'motivoIngreso'   => new sfWidgetFormFilterInput(),
      'costoMateriales' => new sfWidgetFormFilterInput(),
      'costoManoObra'   => new sfWidgetFormFilterInput(),
      'detalleTrabajo'  => new sfWidgetFormFilterInput(),
      'responsable'     => new sfWidgetFormFilterInput(),
      'tipoPago'        => new sfWidgetFormFilterInput(),
      'totalTrabajo'    => new sfWidgetFormFilterInput(),
      'numeroFactura'   => new sfWidgetFormFilterInput(),
      'fechaAlta'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'fechaBaja'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'habilitado'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'usuario'         => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'idMovil'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Movil', 'column' => 'id')),
      'idTaller'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Taller', 'column' => 'id')),
      'fechaIngreso'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'motivoIngreso'   => new sfValidatorPass(array('required' => false)),
      'costoMateriales' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'costoManoObra'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'detalleTrabajo'  => new sfValidatorPass(array('required' => false)),
      'responsable'     => new sfValidatorPass(array('required' => false)),
      'tipoPago'        => new sfValidatorPass(array('required' => false)),
      'totalTrabajo'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'numeroFactura'   => new sfValidatorPass(array('required' => false)),
      'fechaAlta'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'fechaBaja'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'habilitado'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'usuario'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Usuario', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('trabajotaller_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Trabajotaller';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'idMovil'         => 'ForeignKey',
      'idTaller'        => 'ForeignKey',
      'fechaIngreso'    => 'Date',
      'motivoIngreso'   => 'Text',
      'costoMateriales' => 'Number',
      'costoManoObra'   => 'Number',
      'detalleTrabajo'  => 'Text',
      'responsable'     => 'Text',
      'tipoPago'        => 'Text',
      'totalTrabajo'    => 'Number',
      'numeroFactura'   => 'Text',
      'fechaAlta'       => 'Date',
      'fechaBaja'       => 'Date',
      'habilitado'      => 'Boolean',
      'usuario'         => 'ForeignKey',
    );
  }
}
