<?php

/**
 * Chofer form.
 *
 * @package    taxi
 * @subpackage form
 * @author     Brus
 */
class ChoferForm extends BaseChoferForm {

    public function configure() {

        // retiro los atributos que no quiero que esten en el formulario
        unset($this['fechaAlta']);
        unset($this['fechaBaja']);
        unset($this['habilitado']);
        unset($this['usuario']);
        unset($this['multa_list']);
        unset($this['chofer_empresa_list']);
        unset($this['accidente_list']);
        unset($this['liquidacion_list']);

        $this->widgetSchema['cedula'] = new sfWidgetFormInputText();
        
        $this->widgetSchema['direccion']->setAttributes(array('size' => ConstantesFrontEnd::$SIZE_WIDGET_DIRECCION));
        
        $this->widgetSchema['vencimientoLibretaConducir'] = new sfWidgetFormInput(array(), array('class' => 'fecha', 'size' => ConstantesFrontEnd::$SIZE_WIDGET_FECHA));
        $this->setValidator('vencimientoLibretaConducir', new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')));
        
        $this->widgetSchema['vencimientoCarneSalud'] = new sfWidgetFormInput(array(), array('class' => 'fecha', 'size' => ConstantesFrontEnd::$SIZE_WIDGET_FECHA));
        $this->setValidator('vencimientoCarneSalud', new sfValidatorDate(array('required' => false, 'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~')));
        
        // le agrego a la cédula que sea requerida
        $this->validatorSchema['cedula'] = new sfValidatorAnd(array(
                    $this->validatorSchema['cedula'], new sfValidatorInteger(array('required' => true)),
                ));

        // le agrego un validador al email para que sea especial para emails 
        $this->setValidator('email', new sfValidatorEmail(array('required' => false), array('invalid' => "Debe ingresar un correo válido.")));

        // agrego las etiquetas
        $this->widgetSchema->setLabels(array(
            'cedula' => EtiquetasFrontEnd::$CEDULA,
            'nombre' => EtiquetasFrontEnd::$NOMBRE,
            'apellidos' => EtiquetasFrontEnd::$APELLIDO,
            'direccion' => EtiquetasFrontEnd::$DIRECCION,
            'telefono' => EtiquetasFrontEnd::$TELEFONO,
            'celular' => EtiquetasFrontEnd::$CELULAR,
            'email' => EtiquetasFrontEnd::$EMAIL,
            'vencimientoLibretaConducir' => EtiquetasFrontEnd::$VENCIMIENTO_LIBRETA_CONDUCIR,
            'vencimientoCarneSalud' => EtiquetasFrontEnd::$VENCIMIENTO_CARNE_SALUD,
        ));

        $this->widgetSchema->setHelp('cedula', 'Ingresar cédula sin puntos ni guiones.');
        
    }

}
