<?php

/**
 * Configuracion filter form base class.
 *
 * @package    taxi
 * @subpackage filter
 * @author     Brus
 */
abstract class BaseConfiguracionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'idUsuario'        => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => true)),
      'fichaNocturna'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fichaDiurna'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'banderaDiurna'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'banderaNocturna'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'avisoVencimiento' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'idUsuario'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Usuario', 'column' => 'id')),
      'fichaNocturna'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'fichaDiurna'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'banderaDiurna'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'banderaNocturna'  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'avisoVencimiento' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('configuracion_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Configuracion';
  }

  public function getFields()
  {
    return array(
      'idUsuario'        => 'ForeignKey',
      'fichaNocturna'    => 'Number',
      'fichaDiurna'      => 'Number',
      'banderaDiurna'    => 'Number',
      'banderaNocturna'  => 'Number',
      'avisoVencimiento' => 'Boolean',
      'id'               => 'Number',
    );
  }
}
