<?php

/**
 * mail actions.
 *
 * @package    taxi
 * @subpackage mail
 * @author     Brus
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class emailActions extends sfActions {

    public function executeNew(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());

        // creo el formulario del email
        $this->form = new EmailForm();

        // si el usuario esta logueado ya le cargo algunos datos al formulario
        if ($this->getUser()->hasAttribute('email')) {
            $correo = $this->getUser()->getAttribute('email');
            $user = UsuarioPeer::getUsuario($correo);

            $this->form->setDefault('nombre', $user->getNombre() . " " . $user->getApellidos());
            $this->form->setDefault('correo', $user->getEmail());
        }
    }

    public function executeInvitacion(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());

        $this->form = new InvitacionForm();

    }
    public function executeEnviarInvitacion(sfRequest $request) {

        $this->forward404Unless($request->isXmlHttpRequest());
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new InvitacionForm();
        $this->form->bind($request->getParameter($this->form->getName()));

        if ($this->form->isValid()) {
            $info = $this->form->getValues();

            $body = 'Nombre: ' . $info['nombre'] . "\r\n" ;
            $body .= 'Correo: ' . $info['correo'] . "\r\n" ;



            try {

                mail('brunovierag@gmail.com', 'Solicitud de invitación', $body);
                $respuesta_ajax = array( "ok" => "true" );

                // con la api de symfony pero por ahora voy mandando por el mail de php nomá
                //     $this->getMailer()->composeAndSend(
                //         'infobygtest@gmail.com', 
                //         ConstantesFrontEnd::$CUENTA_CORREO_INFO_BYG, 
                //         'Solicitud de Invitacion ' . $info['nombre'], 
                //         $body
                //     );

            } catch (Exception $exc) {
              echo $exc->getTraceAsString();
              $respuesta_ajax = array(
                "ok" => "false",
                "tip" => "Error al enviar mensaje, verifique e intente nuevamente."
                );
          }
      } else {
            // si entre aca es por que tengo un error de validacion
        $respuesta_ajax = array(
            "ok" => "false",
            "tip" => "Error al procesar los datos, verifique e intente nuevamente."
            );
    }
    return $this->renderText(json_encode($respuesta_ajax));
}

public function executeEnviar(sfRequest $request) {

    $this->forward404Unless($request->isXmlHttpRequest());
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $this->form = new EmailForm();

    $this->form->bind($request->getParameter($this->form->getName()));

    if ($this->form->isValid()) {
        $info = $this->form->getValues();

            // si valido todo ok, armo el email con la información
        $body = 'Nombre: ' . $info['nombre'] ."\r\n" ;
        $body .= 'Correo: ' . $info['correo'] ."\r\n" ;
        $body .= 'Mensaje: ' . $info['mensaje'] ."\r\n" ;

        try {

            mail('brunovierag@gmail.com', 'Correo', $body);
                // con la api de symfony pero por ahora voy mandando por el mail de php nomá
                // $this->getMailer()->composeAndSend('infobygtest@gmail.com', ConstantesFrontEnd::$CUENTA_CORREO_INFO_BYG, $info['asunto'], $body);

            $respuesta_ajax = array( "ok" => "true" );
            
        } catch (Exception $exc) {
          echo $exc->getTraceAsString();
          $respuesta_ajax = array(
            "ok" => "false",
            "tip" => "Error al enviar mensaje, verifique e intente nuevamente."
            );
      }
  } else {
            // si entre aca es por que tengo un error de validacion
    $respuesta_ajax = array(
        "ok" => "false",
        "tip" => "Error al procesar los datos, verifique e intente nuevamente."
        );
}

return $this->renderText(json_encode($respuesta_ajax));
}

}
