<?php

/**
 * Empresa form base class.
 *
 * @method Empresa getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BaseEmpresaForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                       => new sfWidgetFormInputHidden(),
      'nombre'                   => new sfWidgetFormInputText(),
      'razonSocial'              => new sfWidgetFormInputText(),
      'idBanco'                  => new sfWidgetFormPropelChoice(array('model' => 'Banco', 'add_empty' => true)),
      'numeroCuenta'             => new sfWidgetFormInputText(),
      'fechaAlta'                => new sfWidgetFormDateTime(),
      'fechaBaja'                => new sfWidgetFormDateTime(),
      'habilitado'               => new sfWidgetFormInputCheckbox(),
      'usuario'                  => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
      'empresa_propietario_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Propietario')),
      'movil_empresa_list'       => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Movil')),
      'chofer_empresa_list'      => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Chofer')),
      'pagoaseguradora_list'     => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Aseguradora')),
    ));

    $this->setValidators(array(
      'id'                       => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'nombre'                   => new sfValidatorString(array('max_length' => 100)),
      'razonSocial'              => new sfValidatorString(array('max_length' => 50)),
      'idBanco'                  => new sfValidatorPropelChoice(array('model' => 'Banco', 'column' => 'id', 'required' => false)),
      'numeroCuenta'             => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'fechaAlta'                => new sfValidatorDateTime(),
      'fechaBaja'                => new sfValidatorDateTime(array('required' => false)),
      'habilitado'               => new sfValidatorBoolean(array('required' => false)),
      'usuario'                  => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'id')),
      'empresa_propietario_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Propietario', 'required' => false)),
      'movil_empresa_list'       => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Movil', 'required' => false)),
      'chofer_empresa_list'      => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Chofer', 'required' => false)),
      'pagoaseguradora_list'     => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Aseguradora', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('empresa[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Empresa';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['empresa_propietario_list']))
    {
      $values = array();
      foreach ($this->object->getEmpresaPropietarios() as $obj)
      {
        $values[] = $obj->getIdpropietario();
      }

      $this->setDefault('empresa_propietario_list', $values);
    }

    if (isset($this->widgetSchema['movil_empresa_list']))
    {
      $values = array();
      foreach ($this->object->getMovilEmpresas() as $obj)
      {
        $values[] = $obj->getIdmovil();
      }

      $this->setDefault('movil_empresa_list', $values);
    }

    if (isset($this->widgetSchema['chofer_empresa_list']))
    {
      $values = array();
      foreach ($this->object->getChoferEmpresas() as $obj)
      {
        $values[] = $obj->getIdchofer();
      }

      $this->setDefault('chofer_empresa_list', $values);
    }

    if (isset($this->widgetSchema['pagoaseguradora_list']))
    {
      $values = array();
      foreach ($this->object->getPagoaseguradoras() as $obj)
      {
        $values[] = $obj->getIdaseguradora();
      }

      $this->setDefault('pagoaseguradora_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveEmpresaPropietarioList($con);
    $this->saveMovilEmpresaList($con);
    $this->saveChoferEmpresaList($con);
    $this->savePagoaseguradoraList($con);
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
    $c->add(EmpresaPropietarioPeer::IDEMPRESA, $this->object->getPrimaryKey());
    EmpresaPropietarioPeer::doDelete($c, $con);

    $values = $this->getValue('empresa_propietario_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new EmpresaPropietario();
        $obj->setIdempresa($this->object->getPrimaryKey());
        $obj->setIdpropietario($value);
        $obj->save();
      }
    }
  }

  public function saveMovilEmpresaList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['movil_empresa_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(MovilEmpresaPeer::IDEMPRESA, $this->object->getPrimaryKey());
    MovilEmpresaPeer::doDelete($c, $con);

    $values = $this->getValue('movil_empresa_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new MovilEmpresa();
        $obj->setIdempresa($this->object->getPrimaryKey());
        $obj->setIdmovil($value);
        $obj->save();
      }
    }
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
    $c->add(ChoferEmpresaPeer::IDEMPRESA, $this->object->getPrimaryKey());
    ChoferEmpresaPeer::doDelete($c, $con);

    $values = $this->getValue('chofer_empresa_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new ChoferEmpresa();
        $obj->setIdempresa($this->object->getPrimaryKey());
        $obj->setIdchofer($value);
        $obj->save();
      }
    }
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
    $c->add(PagoaseguradoraPeer::IDEMPRESA, $this->object->getPrimaryKey());
    PagoaseguradoraPeer::doDelete($c, $con);

    $values = $this->getValue('pagoaseguradora_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new Pagoaseguradora();
        $obj->setIdempresa($this->object->getPrimaryKey());
        $obj->setIdaseguradora($value);
        $obj->save();
      }
    }
  }

}
