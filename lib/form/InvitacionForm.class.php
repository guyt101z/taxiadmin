<?php

/**
 *
 * @package    Taxi
 * @subpackage form
 * @author     Brus
 */
class InvitacionForm extends BaseForm {

    public function configure() {

        parent::configure();

        $this->setWidgets(array(
            'nombre' => new sfWidgetFormInputText(),
            'correo' => new sfWidgetFormInputText(),
        ));

        $this->setValidators(array(
            'nombre' => new sfValidatorString(array('max_length' => 100, 'required' => TRUE)),
            'correo' => new sfValidatorEmail(array('required' => TRUE)),
        ));

        // agrego las etiquetas
        $this->widgetSchema->setLabels(array(
            'nombre' => 'Nombre',
            'correo' => 'Correo',
        ));

        $this->widgetSchema->setNameFormat('invitacion[%s]');
    }

}
