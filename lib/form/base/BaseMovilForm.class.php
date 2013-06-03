<?php

/**
 * Movil form base class.
 *
 * @method Movil getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BaseMovilForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'matricula'            => new sfWidgetFormInputText(),
      'marca'                => new sfWidgetFormInputText(),
      'modelo'               => new sfWidgetFormInputText(),
      'anio'                 => new sfWidgetFormInputText(),
      'numeroChasis'         => new sfWidgetFormInputText(),
      'combustible'          => new sfWidgetFormInputText(),
      'numeroMovil'          => new sfWidgetFormInputText(),
      'idDespacho'           => new sfWidgetFormPropelChoice(array('model' => 'Despacho', 'add_empty' => false)),
      'kmIniciales'          => new sfWidgetFormInputText(),
      'idAseguradora'        => new sfWidgetFormPropelChoice(array('model' => 'Aseguradora', 'add_empty' => true)),
      'fechaAlta'            => new sfWidgetFormDateTime(),
      'fechaBaja'            => new sfWidgetFormDateTime(),
      'habilitado'           => new sfWidgetFormInputCheckbox(),
      'usuario'              => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
      'movil_empresa_list'   => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Empresa')),
      'movil_despacho_list'  => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Despacho')),
      'pagoaseguradora_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Empresa')),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'matricula'            => new sfValidatorString(array('max_length' => 15)),
      'marca'                => new sfValidatorString(array('max_length' => 20)),
      'modelo'               => new sfValidatorString(array('max_length' => 20)),
      'anio'                 => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'numeroChasis'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'combustible'          => new sfValidatorString(array('max_length' => 50)),
      'numeroMovil'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'idDespacho'           => new sfValidatorPropelChoice(array('model' => 'Despacho', 'column' => 'id')),
      'kmIniciales'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'idAseguradora'        => new sfValidatorPropelChoice(array('model' => 'Aseguradora', 'column' => 'id', 'required' => false)),
      'fechaAlta'            => new sfValidatorDateTime(),
      'fechaBaja'            => new sfValidatorDateTime(array('required' => false)),
      'habilitado'           => new sfValidatorBoolean(array('required' => false)),
      'usuario'              => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'id')),
      'movil_empresa_list'   => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Empresa', 'required' => false)),
      'movil_despacho_list'  => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Despacho', 'required' => false)),
      'pagoaseguradora_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Empresa', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('movil[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Movil';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['movil_empresa_list']))
    {
      $values = array();
      foreach ($this->object->getMovilEmpresas() as $obj)
      {
        $values[] = $obj->getIdempresa();
      }

      $this->setDefault('movil_empresa_list', $values);
    }

    if (isset($this->widgetSchema['movil_despacho_list']))
    {
      $values = array();
      foreach ($this->object->getMovilDespachos() as $obj)
      {
        $values[] = $obj->getIddespacho();
      }

      $this->setDefault('movil_despacho_list', $values);
    }

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

    $this->saveMovilEmpresaList($con);
    $this->saveMovilDespachoList($con);
    $this->savePagoaseguradoraList($con);
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
    $c->add(MovilEmpresaPeer::IDMOVIL, $this->object->getPrimaryKey());
    MovilEmpresaPeer::doDelete($c, $con);

    $values = $this->getValue('movil_empresa_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new MovilEmpresa();
        $obj->setIdmovil($this->object->getPrimaryKey());
        $obj->setIdempresa($value);
        $obj->save();
      }
    }
  }

  public function saveMovilDespachoList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['movil_despacho_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(MovilDespachoPeer::IDMOVIL, $this->object->getPrimaryKey());
    MovilDespachoPeer::doDelete($c, $con);

    $values = $this->getValue('movil_despacho_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new MovilDespacho();
        $obj->setIdmovil($this->object->getPrimaryKey());
        $obj->setIddespacho($value);
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
    $c->add(PagoaseguradoraPeer::IDMOVIL, $this->object->getPrimaryKey());
    PagoaseguradoraPeer::doDelete($c, $con);

    $values = $this->getValue('pagoaseguradora_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new Pagoaseguradora();
        $obj->setIdmovil($this->object->getPrimaryKey());
        $obj->setIdempresa($value);
        $obj->save();
      }
    }
  }

}
