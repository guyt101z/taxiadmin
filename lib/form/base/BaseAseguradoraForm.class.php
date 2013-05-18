<?php

/**
 * Aseguradora form base class.
 *
 * @method Aseguradora getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BaseAseguradoraForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'nombre'               => new sfWidgetFormInputText(),
      'direccion'            => new sfWidgetFormInputText(),
      'telefono'             => new sfWidgetFormInputText(),
      'telefono2'            => new sfWidgetFormInputText(),
      'telefono3'            => new sfWidgetFormInputText(),
      'web'                  => new sfWidgetFormInputText(),
      'email'                => new sfWidgetFormInputText(),
      'fechaAlta'            => new sfWidgetFormDateTime(),
      'fechaBaja'            => new sfWidgetFormDateTime(),
      'habilitado'           => new sfWidgetFormInputCheckbox(),
      'usuario'              => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
      'pagoaseguradora_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Empresa')),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'nombre'               => new sfValidatorString(array('max_length' => 100)),
      'direccion'            => new sfValidatorString(array('max_length' => 100)),
      'telefono'             => new sfValidatorString(array('max_length' => 15)),
      'telefono2'            => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'telefono3'            => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'web'                  => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'email'                => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'fechaAlta'            => new sfValidatorDateTime(),
      'fechaBaja'            => new sfValidatorDateTime(array('required' => false)),
      'habilitado'           => new sfValidatorBoolean(array('required' => false)),
      'usuario'              => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'id')),
      'pagoaseguradora_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Empresa', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('aseguradora[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Aseguradora';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['pagoaseguradora_list']))
    {
      $values = array();
      foreach ($this->object->getPagoaseguradoras() as $obj)
      {
        $values[] = $obj->getIdempresa();
      }

      $this->setDefault('pagoaseguradora_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->savePagoaseguradoraList($con);
  }

  public function savePagoaseguradoraList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['pagoaseguradora_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(PagoaseguradoraPeer::IDASEGURADORA, $this->object->getPrimaryKey());
    PagoaseguradoraPeer::doDelete($c, $con);

    $values = $this->getValue('pagoaseguradora_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new Pagoaseguradora();
        $obj->setIdaseguradora($this->object->getPrimaryKey());
        $obj->setIdempresa($value);
        $obj->save();
      }
    }
  }

}
