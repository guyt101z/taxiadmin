<?php

/**
 * Despacho form base class.
 *
 * @method Despacho getObject() Returns the current form's model object
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
abstract class BaseDespachoForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'nombre'              => new sfWidgetFormInputText(),
      'descripcion'         => new sfWidgetFormInputText(),
      'fechaAlta'           => new sfWidgetFormDateTime(),
      'fechaBaja'           => new sfWidgetFormDateTime(),
      'habilitado'          => new sfWidgetFormInputCheckbox(),
      'usuario'             => new sfWidgetFormPropelChoice(array('model' => 'Usuario', 'add_empty' => false)),
      'movil_despacho_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Movil')),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'nombre'              => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'descripcion'         => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'fechaAlta'           => new sfValidatorDateTime(),
      'fechaBaja'           => new sfValidatorDateTime(array('required' => false)),
      'habilitado'          => new sfValidatorBoolean(array('required' => false)),
      'usuario'             => new sfValidatorPropelChoice(array('model' => 'Usuario', 'column' => 'id')),
      'movil_despacho_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Movil', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('despacho[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Despacho';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['movil_despacho_list']))
    {
      $values = array();
      foreach ($this->object->getMovilDespachos() as $obj)
      {
        $values[] = $obj->getIdmovil();
      }

      $this->setDefault('movil_despacho_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveMovilDespachoList($con);
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
    $c->add(MovilDespachoPeer::IDDESPACHO, $this->object->getPrimaryKey());
    MovilDespachoPeer::doDelete($c, $con);

    $values = $this->getValue('movil_despacho_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new MovilDespacho();
        $obj->setIddespacho($this->object->getPrimaryKey());
        $obj->setIdmovil($value);
        $obj->save();
      }
    }
  }

}
