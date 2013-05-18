<?php

/**
 * propietario actions.
 *
 * @package    taxi
 * @subpackage propietario
 * @author     Brus
 */
class propietarioActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute('id');

        $this->pager = new sfPropelPager('Propietario', ConstantesFrontEnd::$CANTIDAD_PROPIETARIOS_PAGINADO);
        $this->pager->setCriteria(PropietarioPeer::getPropietariosParaUsuarioCriteria($idUsuario));
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeShow(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute('id');
        $idPropietario = $request->getParameter('id');
        $this->propietario = PropietarioPeer::getPropietarioByPK($idPropietario, $idUsuario);
        $this->csrfToken = $this->getCSRFToken();

        $this->forward404Unless($this->propietario);
    }

    public function executeNew(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->form = new PropietarioForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new PropietarioForm();
        return $this->altaPropietario($request, $this->form);
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->forward404Unless($propietario = PropietarioPeer::getPropietarioByPK($request->getParameter('id'), $this->getUser()->getAttribute('id')), sprintf('Object propietario does not exist (%s).', $request->getParameter('id')));
        $this->form = new PropietarioForm($propietario);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($propietario = PropietarioPeer::getPropietarioByPK($request->getParameter('id'), $this->getUser()->getAttribute('id')), sprintf('Object propietario does not exist (%s).', $request->getParameter('id')));
        $this->form = new PropietarioForm($propietario);

        return $this->modificarPropietario($request, $this->form);
    }

    public function executeErase(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute("id");
        $idPropietario = $request->getParameter('id');
        $this->propietario = PropietarioPeer::getPropietarioByPK($idPropietario, $idUsuario);
    }

    public function executeDelete(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $request->checkCSRFProtection();

        $idUsuario = $this->getUser()->getAttribute("id");
        $idPropietario = $request->getParameter('id');

        $this->forward404Unless($propietario = PropietarioPeer::getPropietarioByPK($idPropietario, $idUsuario), sprintf('Object Propietario does not exist (%s).', $idPropietario));

        $propietario->setFechabaja(new DateTime());
        $propietario->setHabilitado(FALSE);
        $propietario->save();

        $respuesta_ajax = array(
            "ok" => "true",
            "url" => $this->getController()->genUrl('propietario/index', TRUE)
        );

        return $this->renderText(json_encode($respuesta_ajax));
    }

    public function executeDetallePropietario(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->propietario = PropietarioPeer::getPropietarioByPK($request->getParameter('id'), $this->getUser()->getAttribute('id'));
        return $this->renderPartial('detallePropietario', array('propietario' => $this->propietario));
    }

    public function executeListaPropietarios(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->propietarios = PropietarioPeer::getPropietariosParaUsuario($this->getUser()->getAttribute('id'));

        if (!$this->propietarios) {
            return $this->renderText('No hay propietarios creados.');
        }

        return $this->renderPartial('listaPropietarios', array('propietarios' => $this->propietarios));
    }

    //***************************  LOGICA  ****************************//

    protected function altaPropietario(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $propietario = $this->form->getValues();

            if (PropietarioPeer::getPropietario($propietario['cedula']) == null) {
                $Propietario = new Propietario();
                $Propietario->setCedula($propietario['cedula']);
                $Propietario->setNombre($propietario['nombre']);
                $Propietario->setApellidos($propietario['apellidos']);
                $Propietario->setDireccion($propietario['direccion']);
                $Propietario->setTelefono($propietario['telefono']);
                $Propietario->setCelular($propietario['celular']);
                $Propietario->setEmail($propietario['email']);
                $Propietario->setFechaalta("now");
                $Propietario->setHabilitado(true);
                $Propietario->setUsuario($this->getUser()->getAttribute('id'));
                $Propietario->save();

                //si lo puedo guardar sin problemas ahora creo el evento para registrar esta alta de usuario
                Evento::crearEvento($Propietario->getId(), "Se creo un nuevo Propietario id " . $Propietario->getId());

                $respuesta_ajax = array(
                    "ok" => "true",
                    "url" => $this->getController()->genUrl('propietario/index', TRUE)
                );
            } else {
                // si ya existe cédula, lo envio a la página de alta con un mensaje de error
                $respuesta_ajax = array(
                    "ok" => "false",
                    "tip" => "La cédula ingresada ya existe en el sistema."
                );
            }
        } else {
            // sino es válido, envío al usuario nuevamente a la página de alta con un mensaje de error
            $respuesta_ajax = array(
                "ok" => "false",
                "tip" => "Error al guardar los datos, por favor verifíquelos y vuelva a intentar."
            );
        }

        return $this->renderText(json_encode($respuesta_ajax));
    }

    protected function modificarPropietario(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $Propietario = $form->save();

            //si lo puedo guardar sin problemas ahora creo el evento para registrar el alta
            Evento::crearEvento($Propietario->getUsuario(), "Se modificó el Propietario id " . $Propietario->getId());

            $respuesta_ajax = array(
                "ok" => "true"
            );

            // ver por errores
            //if ($this->form->hasErrors()) {
            //$respuesta_ajax['tip'] = 'Nombre: ' . $this->form['nombre']->renderError();
            //}
        } else {
            $respuesta_ajax = array(
                "ok" => "false",
                "tip" => "Error al procesar los datos, verifique e intente nuevamente."
            );
        }

        return $this->renderText(json_encode($respuesta_ajax));
    }

    public function executeImprimirPropietariosPDF() {
        $titulo = 'Listado de Propietarios';
        $subject = 'Listado completo de propietarios';
        $fileName = 'ListadoPropietarios.pdf';

        // ---------------------------------------------------------

        $idUsuario = $this->getUser()->getAttribute("id");
        $propietarios = PropietarioPeer::getPropietariosParaUsuario($idUsuario);

        $html = '<h1>' . $titulo . '</h1>';
        $html .= '<table border="0"><thead><tr>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$CEDULA . '</b></th>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$NOMBRE . '</b></th>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$APELLIDO . '</b></th>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$TELEFONO . '</b></th>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$CELULAR . '</b></th>';
        $html .= '</tr></thead><tbody>';

        foreach ($propietarios as $propietario) {
            $html .= '<tr>';
            $html .= '<td>' . UtilFrontEnd::formatoCedula($propietario->getCedula()) . '</td>';
            $html .= '<td>' . $propietario->getNombre() . '</td>';
            $html .= '<td>' . $propietario->getApellidos() . '</td>';
            $html .= '<td>' . UtilFrontEnd::formatoTelefono($propietario->getTelefono()) . '</td>';
            $html .= '<td>' . UtilFrontEnd::formatoCelular($propietario->getCelular()) . '</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody></table>';

        // ---------------------------------------------------------

        UtilFrontEnd::imprimirPDF($titulo, $subject, $fileName, $html);
    }

    private function getCSRFToken() {
        // Token CSRF
        $baseForm = new BaseForm();
        return $baseForm->getCSRFToken();
    }

}

