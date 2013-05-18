<?php

/**
 * Propietario form base class.
 *
 * @method Propietario getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BasePropietarioForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'cedula'                   => new sfWidgetFormInputText(),
      'nombre'                   => new sfWidgetFormInputText(),
      'apellidos'                => new sfWidgetFormInputText(),
      'direccion'                => new sfWidgetFormInputText(),
      'telefono'                 => new sfWidgetFormInputText(),
      'celular'                  => new sfWidgetFormInputText(),
      'email'                    => new sfWidgetFormInputText(),
      'fechaAlta'                => new sfWidgetFormDateTime(),
      'fechaBaja'                => new sfWidgetFormDateTime(),
      'habilitado'               => new sfWidgetFormInputCheckbox(),
      'usuario'                  => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
      'empresa_propietario_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Empresa')),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'cedula'                   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'nombre'                   => new sfValidatorString(array('max_length' => 50)),
      'apellidos'                => new sfValidatorString(array('max_length' => 50)),
      'direccion'                => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'telefono'                 => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'celular'                  => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'email'                    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'fechaAlta'                => new sfValidatorDateTime(),
      'fechaBaja'                => new sfValidatorDateTime(array('required' => false)),
      'habilitado'               => new sfValidatorBoolean(array('required' => false)),
      'usuario'                  => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'id')),
      'empresa_propietario_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Empresa', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('propietario[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Propietario';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['empresa_propietario_list']))
    {
      $values = array();
      foreach ($this->object->getEmpresaPropietarios() as $obj)
      {
        $values[] = $obj->getIdempresa();
      }

      $this->setDefault('empresa_propietario_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveEmpresaPropietarioList($con);
  }

  public function saveEmpresaPropietarioList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['empresa_propietario_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(EmpresaPropietarioPeer::IDPROPIETARIO, $this->object->getPrimaryKey());
    EmpresaPropietarioPeer::doDelete($c, $con);

    $values = $this->getValue('empresa_propietario_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new EmpresaPropietario();
        $obj->setIdpropietario($this->object->getPrimaryKey());
        $obj->setIdempresa($value);
        $obj->save();
      }
    }
  }

}
