<?php

/**
 * Chofer form base class.
 *
 * @method Chofer getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BaseChoferForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                         => new sfWidgetFormInputHidden(),
      'cedula'                     => new sfWidgetFormInputText(),
      'nombre'                     => new sfWidgetFormInputText(),
      'apellidos'                  => new sfWidgetFormInputText(),
      'direccion'                  => new sfWidgetFormInputText(),
      'telefono'                   => new sfWidgetFormInputText(),
      'celular'                    => new sfWidgetFormInputText(),
      'email'                      => new sfWidgetFormInputText(),
      'vencimientoLibretaConducir' => new sfWidgetFormDate(),
      'vencimientoCarneSalud'      => new sfWidgetFormDate(),
      'fechaAlta'                  => new sfWidgetFormDateTime(),
      'fechaBaja'                  => new sfWidgetFormDateTime(),
      'habilitado'                 => new sfWidgetFormInputCheckbox(),
      'usuario'                    => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
      'chofer_empresa_list'        => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Empresa')),
    ));

    $this->setValidators(array(
      'id'                         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'cedula'                     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'nombre'                     => new sfValidatorString(array('max_length' => 50)),
      'apellidos'                  => new sfValidatorString(array('max_length' => 50)),
      'direccion'                  => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'telefono'                   => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'celular'                    => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'email'                      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'vencimientoLibretaConducir' => new sfValidatorDate(array('required' => false)),
      'vencimientoCarneSalud'      => new sfValidatorDate(array('required' => false)),
      'fechaAlta'                  => new sfValidatorDateTime(),
      'fechaBaja'                  => new sfValidatorDateTime(array('required' => false)),
      'habilitado'                 => new sfValidatorBoolean(array('required' => false)),
      'usuario'                    => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'id')),
      'chofer_empresa_list'        => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Empresa', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('chofer[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Chofer';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['chofer_empresa_list']))
    {
      $values = array();
      foreach ($this->object->getChoferEmpresas() as $obj)
      {
        $values[] = $obj->getIdempresa();
      }

      $this->setDefault('chofer_empresa_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveChoferEmpresaList($con);
  }

  public function saveChoferEmpresaList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['chofer_empresa_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(ChoferEmpresaPeer::IDCHOFER, $this->object->getPrimaryKey());
    ChoferEmpresaPeer::doDelete($c, $con);

    $values = $this->getValue('chofer_empresa_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new ChoferEmpresa();
        $obj->setIdchofer($this->object->getPrimaryKey());
        $obj->setIdempresa($value);
        $obj->save();
      }
    }
  }

}
