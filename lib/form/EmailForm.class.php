<?php

/**
 *
 * @package    Taxi
 * @subpackage form
 * @author     Brus
 */
class EmailForm extends BaseForm {

    public function configure() {

        parent::configure();

        $this->setWidgets(array(
            'nombre' => new sfWidgetFormInputText(),
            'correo' => new sfWidgetFormInputText(),
            'asunto' => new sfWidgetFormInputText(),
            'mensaje' => new sfWidgetFormTextarea(
                    array(),
                    array(
                        'style' => 'resize:none',
                        'cols' => 35,
                        'rows' => 6)
            ),
        ));

        $this->setValidators(array(
            'nombre' => new sfValidatorString(array('max_length' => 100, 'required' => TRUE)),
            'correo' => new sfValidatorEmail(array('required' => TRUE)),
            'asunto' => new sfValidatorString(array('max_length' => 100, 'required' => TRUE)),
            'mensaje' => new sfValidatorString(array('max_length' => 300, 'required' => TRUE)),
        ));

        // agrego las etiquetas
        $this->widgetSchema->setLabels(array(
            'nombre' => 'Nombre',
            'correo' => 'Correo',
            'asunto' => 'Asunto',
            'mensaje' => 'Mensaje',
        ));

        $this->widgetSchema->setNameFormat('email[%s]');
    }

}
