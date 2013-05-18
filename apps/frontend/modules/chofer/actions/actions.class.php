<?php

/**
 * chofer actions.
 *
 * @package    taxi
 * @subpackage chofer
 * @author     Brus
 */
class choferActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute('id');

        $this->pager = new sfPropelPager('Chofer', ConstantesFrontEnd::$CANTIDAD_CHOFERES_PAGINADO);
        $this->pager->setCriteria(ChoferPeer::getChoferesParaUsuarioCriteria($idUsuario));
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();
    }

    public function executeShow(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute('id');
        $idChofer = $request->getParameter('id');

        $this->chofer = ChoferPeer::getChoferByPK($idChofer, $idUsuario);
        $this->csrfToken = $this->getCSRFToken();

        $this->forward404Unless($this->chofer);
    }

    public function executeNew(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->form = new ChoferForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new ChoferForm();
        return $this->altaChofer($request, $this->form);
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idChofer = $request->getParameter('id');

        $this->forward404Unless($chofer = ChoferPeer::getChoferByPK($idChofer, $idUsuario), sprintf('Object chofer does not exist (%s).', $idChofer));
        $this->form = new ChoferForm($chofer);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idChofer = $request->getParameter('id');
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($chofer = ChoferPeer::getChoferByPK($idChofer, $idUsuario), sprintf('Object chofer does not exist (%s).', $idChofer));
        $this->form = new ChoferForm($chofer);
        return $this->modificarChofer($request, $this->form);
    }

    public function executeErase(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idChofer = $request->getParameter('id');
        $this->chofer = ChoferPeer::getChoferByPK($idChofer, $idUsuario);
    }

    public function executeDelete(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $request->checkCSRFProtection();

        $idUsuario = $this->getUser()->getAttribute("id");
        $idChofer = $request->getParameter('id');

        $this->forward404Unless($chofer = ChoferPeer::getChoferByPK($idChofer, $idUsuario), sprintf('Object chofer does not exist (%s).', $idChofer));

        $chofer->setFechabaja(new DateTime());
        $chofer->setHabilitado(FALSE);
        $chofer->save();

        $respuesta_ajax = array(
            "ok" => "true",
            "url" => $this->getController()->genUrl('chofer/index', TRUE)
        );

        return $this->renderText(json_encode($respuesta_ajax));
    }

    public function executeDetalleChofer(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->chofer = ChoferPeer::getChoferByPK($request->getParameter('id'), $this->getUser()->getAttribute('id'));
        return $this->renderPartial('detalleChofer', array('chofer' => $this->chofer));
    }

    public function executeListaChoferes(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->choferes = ChoferPeer::getChoferesParaUsuario($this->getUser()->getAttribute('id'));

        if (!$this->choferes) {
            return $this->renderText('No hay choferes creados.');
        }

        return $this->renderPartial('listaChoferes', array('choferes' => $this->choferes));
    }

    public function executeListaMultas(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute('id');
        $idChofer = $request->getParameter('id');

        $this->chofer = ChoferPeer::getChoferByPK($idChofer, $idUsuario);
        $this->csrfToken = $this->getCSRFToken();

        return $this->renderPartial('listaMultas', array('chofer' => $this->chofer, 'csrfToken' => $this->csrfToken));
    }

    public function executeListaAccidentes(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute('id');
        $idChofer = $request->getParameter('id');

        $this->chofer = ChoferPeer::getChoferByPK($idChofer, $idUsuario);
        $this->csrfToken = $this->getCSRFToken();

        return $this->renderPartial('listaAccidentes', array('chofer' => $this->chofer, 'csrfToken' => $this->csrfToken));
    }

    public function executeListaAdelantos(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute('id');
        $idChofer = $request->getParameter('id');

        $this->chofer = ChoferPeer::getChoferByPK($idChofer, $idUsuario);
        $this->csrfToken = $this->getCSRFToken();

        return $this->renderPartial('listaAdelantos', array('chofer' => $this->chofer, 'csrfToken' => $this->csrfToken));
    }

    public function executeListaUltimasRecaudaciones(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute('id');
        $idChofer = $request->getParameter('id');
        $this->chofer = ChoferPeer::getChoferByPK($idChofer, $idUsuario);
        return $this->renderPartial('listaUltimasRecaudaciones', array('chofer' => $this->chofer));
    }

    public function executeMarcarPagoLibreta(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idChofer = $request->getParameter('id');

        $this->chofer = ChoferPeer::getChoferByPK($idChofer, $idUsuario);
        $this->forward404Unless($this->chofer);
    }

    public function executeGuardarPagoLibreta(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idChofer = $request->getParameter('id');

        $chofer = ChoferPeer::getChoferByPK($idChofer, $idUsuario);
        $this->forward404Unless($chofer);

        $values = $request->getParameter('chofer');
        $vencimientoLibretaConducir = new DateTime(str_replace("/", "-", $values['vencimientoLibretaConducir']));

        $chofer->setVencimientolibretaconducir($vencimientoLibretaConducir);
        $chofer->save();

        $respuesta_ajax = array(
            "ok" => "true"
        );

        return $this->renderText(json_encode($respuesta_ajax));
    }

    public function executeMarcarPagoCarneSalud(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idChofer = $request->getParameter('id');

        $this->chofer = ChoferPeer::getChoferByPK($idChofer, $idUsuario);
        $this->forward404Unless($this->chofer);
    }

    public function executeGuardarPagoCarneSalud(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idChofer = $request->getParameter('id');

        $chofer = ChoferPeer::getChoferByPK($idChofer, $idUsuario);
        $this->forward404Unless($chofer);

        $values = $request->getParameter('chofer');
        $vencimientoCarneSalud = new DateTime(str_replace("/", "-", $values['vencimientoCarneSalud']));

        $chofer->setVencimientocarnesalud($vencimientoCarneSalud);
        $chofer->save();

        $respuesta_ajax = array(
            "ok" => "true"
        );

        return $this->renderText(json_encode($respuesta_ajax));
    }

    //***************************  LOGICA  ****************************//

    protected function altaChofer(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $chofer = $this->form->getValues();

            if (ChoferPeer::getChofer($chofer['cedula']) == null) {
                $Chofer = new Chofer();
                $Chofer->setCedula($chofer['cedula']);
                $Chofer->setNombre($chofer['nombre']);
                $Chofer->setApellidos($chofer['apellidos']);
                $Chofer->setDireccion($chofer['direccion']);
                $Chofer->setTelefono($chofer['telefono']);
                $Chofer->setCelular($chofer['celular']);
                $Chofer->setEmail($chofer['email']);
                $Chofer->setVencimientocarnesalud($chofer['vencimientoCarneSalud']);
                $Chofer->setVencimientolibretaconducir($chofer['vencimientoLibretaConducir']);
                $Chofer->setFechaalta("now");
                $Chofer->setHabilitado(true);
                $Chofer->setUsuario($this->getUser()->getAttribute('id'));
                $Chofer->save();

                //si lo puedo guardar sin problemas ahora creo el evento para registrar esta alta de usuario
                Evento::crearEvento($Chofer->getId(), "Se creo un nuevo Chofer id " . $Chofer->getId());

                $respuesta_ajax = array(
                    "ok" => "true",
                    "url" => $this->getController()->genUrl('chofer/index', TRUE)
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

    protected function modificarChofer(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $Chofer = $form->save();

            //si lo puedo guardar sin problemas ahora creo el evento para registrar el alta
            Evento::crearEvento($Chofer->getUsuario(), "Se modificó el chofer id " . $Chofer->getId());

            $respuesta_ajax = array(
                "ok" => "true",
                "message" => "Chofer modificado OK."
            );
        } else {
            $respuesta_ajax = array(
                "ok" => "false",
                "tip" => "Error al procesar los datos, verifique e intente nuevamente."
            );
        }

        return $this->renderText(json_encode($respuesta_ajax));
    }

    public function executeImprimirChoferesPDF() {
        $titulo = 'Listado de Choferes';
        $subject = 'Listado completo de choferes';
        $fileName = 'ListadoChoferes.pdf';

        // ---------------------------------------------------------

        $idUsuario = $this->getUser()->getAttribute("id");
        $choferes = ChoferPeer::getChoferesParaUsuario($idUsuario);

        $html = '<h1>' . $titulo . '</h1>';
        $html .= '<table border="0"><thead><tr>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$CEDULA . '</b></th>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$NOMBRE . '</b></th>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$APELLIDO . '</b></th>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$TELEFONO . '</b></th>';
        $html .= '<th><b>' . EtiquetasFrontEnd::$CELULAR . '</b></th>';
        $html .= '</tr></thead><tbody>';

        foreach ($choferes as $chofer) {
            $html .= '<tr>';
            $html .= '<td>' . UtilFrontEnd::formatoCedula($chofer->getCedula()) . '</td>';
            $html .= '<td>' . $chofer->getNombre() . '</td>';
            $html .= '<td>' . $chofer->getApellidos() . '</td>';
            $html .= '<td>' . UtilFrontEnd::formatoTelefono($chofer->getTelefono()) . '</td>';
            $html .= '<td>' . UtilFrontEnd::formatoCelular($chofer->getCelular()) . '</td>';
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
