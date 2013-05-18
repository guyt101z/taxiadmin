<?php

/**
 *
 * @package    Taxi
 * @subpackage form
 * @author     Brus
 */
class LoginForm extends BaseForm {

    public function configure() {
        
        parent::configure();

        $this->setWidgets(array(
            'correo' => new sfWidgetFormInputText(),
            'password' => new sfWidgetFormInputPassword(),
        ));

        $this->setValidators(array(
            'correo' => new sfValidatorEmail(array(), array()),
            'password' => new sfValidatorString(array(), array()),
        ));

        $this->widgetSchema->setNameFormat('loginUsuario[%s]');
    }

}
