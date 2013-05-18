<?php

/**
 * usuario actions.
 *
 * @package    taxi
 * @subpackage usuario
 * @author     Brus
 */
class usuarioActions extends sfActions {

    //public function executeIndex(sfWebRequest $request) {
      //  $this->usuarios = UsuarioPeer::doSelect(new Criteria());
    //}

//    public function executeShow(sfWebRequest $request) {
//        $this->usuario = UsuarioPeer::retrieveByPk($request->getParameter('id'));
//        $this->forward404Unless($this->usuario);
//    }

    public function executeNew(sfWebRequest $request) {
        // Como esta acción es pública, si no viene por ajax se redirecciona al home.
        if (!$request->isXmlHttpRequest()) {
            $this->redirect('home/index');
        }

        $this->form = new usuarioForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new UsuarioForm();

        return $this->processForm($request, $this->form);
    }

//    public function executeEdit(sfWebRequest $request) {
//        $this->forward404Unless($usuario = UsuarioPeer::retrieveByPk($request->getParameter('id')), sprintf('Object usuario does not exist (%s).', $request->getParameter('id')));
//        $this->form = new usuarioForm($usuario);
 //   }

//    public function executeUpdate(sfWebRequest $request) {
 //       $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
  //      $this->forward404Unless($usuario = UsuarioPeer::retrieveByPk($request->getParameter('id')), sprintf('Object usuario does not exist (%s).', $request->getParameter('id')));
   //     $this->form = new usuarioForm($usuario);
//
 //       $this->processForm($request, $this->form);
//
 //       $this->setTemplate('edit');
  //  }

    //public function executeDelete(sfWebRequest $request) {
//        $request->checkCSRFProtection();
//
//        $this->forward404Unless($usuario = UsuarioPeer::retrieveByPk($request->getParameter('id')), sprintf('Object usuario does not exist (%s).', $request->getParameter('id')));
//        $usuario->delete();
//
//        $this->redirect('usuario/index');
//    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $usuario = $this->form->getValues();

            if (UsuarioPeer::getUsuario($usuario['email']) == null) {
                $Usuario = new Usuario();
                // por ahora solo doy de alta usuarios
                $Usuario->setTipo(ConstantesFrontEnd::$TIPO_USER_USUARIO);
                $Usuario->setNombre($usuario['nombre']);
                $Usuario->setApellidos($usuario['apellidos']);
                $Usuario->setCelular($usuario['celular']);
                $Usuario->setTelefono($usuario['telefono']);
                $Usuario->setDireccion($usuario['direccion']);
                $Usuario->setEmail($usuario['email']);
                $Usuario->setClave(md5($usuario['clave']));
                $Usuario->setFechaalta(new DateTime());
                $Usuario->setHabilitado(true);
                $Usuario->save();

                //si lo puedo guardar sin problemas ahora creo el evento para registrar esta alta de usuario
                Evento::crearEvento($Usuario->getId(), "Se creo un nuevo usuario");

                $respuesta_ajax = array(
                    "ok" => "true",
                    "url" => $this->getController()->genUrl('home/index', true)
                );
            } else {
                $respuesta_ajax = array(
                    "ok" => "false",
                    "tip" => "El correo que ingresó ya existen en el sistema, por favor ingrese otro."
                );
            }
        } else {
            $respuesta_ajax = array(
                "ok" => "false",
                "tip" => "Error al ingresar los datos, por favor verifíquelos."
            );
        }

        return $this->renderText(json_encode($respuesta_ajax));
    }

}
