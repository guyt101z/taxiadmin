<?php

/**
 * adelanto actions.
 *
 * @package    taxi
 * @subpackage adelanto
 * @author     Brus
 */
class adelantoActions extends sfActions {

    // public function executeIndex(sfWebRequest $request) {
    //     $this->Adelantos = AdelantoPeer::doSelect(new Criteria());
    // }

    public function executeShow(sfWebRequest $request) {

        $idUsuario = $this->getUser()->getAttribute("id");
        $idAdelanto = $request->getParameter('idAdelanto');

        $this->idChofer = $request->getParameter('idChofer');
        $this->adelanto = AdelantoPeer::getAdelantoByPK($idAdelanto, $idUsuario);

        $this->csrfToken = $this->getCSRFToken();
       
        $this->forward404Unless($this->adelanto);
    }

    public function executeDetalles(sfWebRequest $request){
        $idUsuario = $this->getUser()->getAttribute("id");
        $idAdelanto = $request->getParameter('idAdelanto');

        $idChofer = $request->getParameter('idChofer');
        $adelanto = AdelantoPeer::getAdelantoByPK($idAdelanto, $idUsuario);

        $csrfToken = $this->getCSRFToken(); 

        return $this->renderPartial('detallesAdelanto', array('adelanto' => $adelanto, 'csrfToken' => $csrfToken));
    }

    public function executeNew(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->form = new AdelantoForm();
        $this->setChofer($request);
        $this->form->setDefault('fecha', date(ConstantesFrontEnd::$FORMAT_DATE));
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new AdelantoForm();
        return $this->altaAdelanto($request, $this->form);
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idAdelanto = $request->getParameter('id');
        $this->forward404Unless($Adelanto = AdelantoPeer::getAdelantoByPK($idAdelanto, $idUsuario), sprintf('Object adelanto does not exist (%s).', $idAdelanto));
        $this->form = new AdelantoForm($Adelanto);
        $this->setChofer($request);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idAdelanto = $request->getParameter('id');
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($Adelanto = AdelantoPeer::getAdelantoByPK($idAdelanto, $idUsuario), sprintf('Object adelanto does not exist (%s).', $idAdelanto));
        $this->form = new AdelantoForm($Adelanto);
        return $this->modificarAdelanto($request, $this->form);
    }

    public function executeErase(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idAdelanto = $request->getParameter('id');
        $this->adelanto = AdelantoPeer::getAdelantoByPK($idAdelanto, $idUsuario);
    }

    public function executeDelete(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $request->checkCSRFProtection();

        $idUsuario = $this->getUser()->getAttribute("id");
        $idAdelanto = $request->getParameter('id');

        $this->forward404Unless($Adelanto = AdelantoPeer::getAdelantoByPK($idAdelanto, $idUsuario), sprintf('Object adelanto does not exist (%s).', $idAdelanto));

        // doy de baja al adelanto
        $Adelanto->setFechabaja(new DateTime());
        $Adelanto->setHabilitado(FALSE);
        $Adelanto->save();

        // doy de baja a todos los pagos
        foreach ($Adelanto->getPagoadelantos() as $pago) {
            $pago->setFechabaja(new DateTime());
            $pago->setHabilitado(FALSE);
            $pago->save();
        }

        $respuesta_ajax = array(
            "ok" => "true"
        );

        return $this->renderText(json_encode($respuesta_ajax));
    }

    //***************************  LOGICA  ****************************//

    protected function altaAdelanto(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $values = $this->form->getValues();

            $Adelanto = new Adelanto();
            $Adelanto->setChofer(ChoferPeer::getChoferByPK($values['idChofer'], $this->getUser()->getAttribute('id')));
            $Adelanto->setFecha($values['fecha']);
            $Adelanto->setMonto($values['monto']);
            $Adelanto->setSaldo($values['monto']);
            $Adelanto->setDetalle($values['detalle']);
            $Adelanto->setFechaalta(new DateTime());
            $Adelanto->setHabilitado(true);
            $Adelanto->setUsuario($this->getUser()->getAttribute('id'));
            $Adelanto->save();

            // si lo puedo guardar sin problemas ahora creo el evento para registrar el alta
            Evento::crearEvento($Adelanto->getUsuario(), "Se creo un nuevo adelanto para el chofer id " . $Adelanto->getChofer()->getId());

            $respuesta_ajax = array(
                "ok" => "true"
                );
        } else {
            $respuesta_ajax = array(
                "ok" => "false",
                "tip" => "Error al guardar los datos, por favor verifíquelos y vuelva a intentar."
                );
        }

        return $this->renderText(json_encode($respuesta_ajax));
    }

    protected function modificarAdelanto(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $Adelanto = $form->save();

            // si lo puedo guardar sin problemas ahora creo el evento para registrar el alta
            Evento::crearEvento($Adelanto->getUsuario(), "Se modificó el adelanto id " . $Adelanto->getId());

            $respuesta_ajax = array(
                "ok" => "true"
                );
        } else {
            $respuesta_ajax = array(
                "ok" => "false",
                "tip" => "Error al procesar los datos, verifique e intente nuevamente."
                );
        }

        return $this->renderText(json_encode($respuesta_ajax));
    }

    protected function setChofer(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute("id");
        $idChofer = $request->getParameter('idChofer');
        $chofer = ChoferPeer::getChoferByPK($idChofer, $idUsuario);
        $this->form->setDefault('idChofer', $chofer->getId());
        $this->form->setDefault('nombreChofer', $chofer->getNombreCompleto());
    }

    private function getCSRFToken() {
        // Token CSRF
        $baseForm = new BaseForm();
        return $baseForm->getCSRFToken();
    }
}
