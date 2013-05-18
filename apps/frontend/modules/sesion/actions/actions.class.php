<?php

/**
 * login actions.
 *
 * @package    Taxi
 * @subpackage sesion
 * @author     Brus
 */
class sesionActions extends sfActions {

    public function executeNew(sfWebRequest $request) {
        // Como esta acción es pública, si no viene por ajax se redirecciona al home.
        if (!$request->isXmlHttpRequest()) {
            $this->redirect('home/index');
        }

        $this->form = new LoginForm();
    }

    function executeLogin(sfRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        
        $this->form = new LoginForm();

        $this->form->bind($request->getParameter('loginUsuario'));

        if ($this->form->isValid()) {
            /* Obtengo el objeto usuario */
            $usuario = $this->form->getValues();

            /* Busco el usuario en la BD por el correo */
            $Usuario = UsuarioPeer::getUsuario($usuario['correo']);

            /* Si el usuario recuperado de la BD no está vacio y las claves coinciden entonces lo logueo */
            if ($Usuario != null && strcmp(md5($usuario['password']), $Usuario->getClave()) == 0) {

                    // creo un evento para registrar el login del usuario
                Evento::crearEvento($Usuario->getId(), "Inicia la sesión");

                /* Le digo que el usuario está logueado */
                $this->getUser()->setAuthenticated(true);

                /* Le agrego a la session el email como atributo y el id del usuario */
                $this->getUser()->setAttribute('email', $Usuario->getEmail());
                $this->getUser()->setAttribute('id', $Usuario->getId());
                    //agrego el nombre a la sesion así lo muestro en el layout al lado del cerrar cesion
                $this->getUser()->setAttribute('nombre', $Usuario->getNombre());

                    // agrego a la sesión la credencial del usuario                    
                $this->getUser()->addCredential($Usuario->getTipo());

                $respuesta_ajax = array(
                    "ok" => "true",
                    "url" => $this->getController()->genUrl('paginaInicial/index', true)
                    );
            } else {
                $respuesta_ajax = array(
                    "ok" => "false",
                    "tip" => "El usuario o la clave estan incorrectos."
                    );
            }
        } else {
            $respuesta_ajax = array(
                "ok" => "false",
                "tip" => "El usuario o la clave estan incorrectos."
                );
        }

        return $this->renderText(json_encode($respuesta_ajax));
    }

    function executeLogout(sfWebRequest $request) {
        //Creo un evento para registrar el logout
        Evento::crearEvento($this->getUser()->getAttribute("id"), "Finaliza la sesión");

        // limpio las credenciales 
        $this->getUser()->clearCredentials();

        // limpio los datos agregados a la session
        $this->getUser()->getAttributeHolder()->clear();
        
        // cierro la sesión del usuario
        $this->getUser()->setAuthenticated(false);

        $this->redirect('home/index');
    }

}
