<?php

/**
 * trabajoTaller actions.
 *
 * @package    taxi
 * @subpackage trabajoTaller
 * @author     Brus
 */
class trabajoTallerActions extends sfActions {

    // public function executeIndex(sfWebRequest $request) {
    //     $this->TrabajoTallers = TrabajoTallerPeer::doSelect(new Criteria());
    // }

    public function executeShow(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute("id");
        $idTrabajoTaller = $request->getParameter('id');

        $this->TrabajoTaller = TrabajotallerPeer::getTrabajoTallerByPK($idTrabajoTaller, $idUsuario);
        $this->forward404Unless($this->TrabajoTaller);
    }

    public function executeNew(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->form = new TrabajoTallerForm();
        $this->setMovil($request);
        $this->form->setDefault('fechaIngreso', date(ConstantesFrontEnd::$FORMAT_DATE));
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new TrabajoTallerForm();
        return $this->altaTrabajoTaller($request, $this->form);
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idTrabajoTaller = $request->getParameter('id');
        $this->forward404Unless($TrabajoTaller = TrabajoTallerPeer::getTrabajoTallerByPK($idTrabajoTaller, $idUsuario), sprintf('Object trabajo taller does not exist (%s).', $idTrabajoTaller));
        $this->form = new TrabajoTallerForm($TrabajoTaller);
        $this->forward404Unless($request->isXmlHttpRequest());
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idTrabajoTaller = $request->getParameter('id');
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($TrabajoTaller = TrabajoTallerPeer::getTrabajoTallerByPK($idTrabajoTaller, $idUsuario), sprintf('Object trabajo taller does not exist (%s).', $idTrabajoTaller));
        $this->form = new TrabajoTallerForm($TrabajoTaller);
        return $this->modificarTrabajoTaller($request, $this->form);
    }

    public function executeErase(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idTrabajoTaller = $request->getParameter('id');
        $this->trabajoTaller = TrabajoTallerPeer::getTrabajoTallerByPK($idTrabajoTaller, $idUsuario);
    }

    public function executeDelete(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $request->checkCSRFProtection();

        $idUsuario = $this->getUser()->getAttribute("id");
        $idTrabajoTaller = $request->getParameter('id');

        $this->forward404Unless($trabajoTaller = TrabajoTallerPeer::getTrabajoTallerByPK($idTrabajoTaller, $idUsuario), sprintf('Object trabajoTaller does not exist (%s).', $idTrabajoTaller));
        
        $trabajoTaller->setFechabaja(new DateTime());
        $trabajoTaller->setHabilitado(FALSE);
        $trabajoTaller->save();

        $respuesta_ajax = array(
            "ok" => "true"
        );

        return $this->renderText(json_encode($respuesta_ajax));
    }

    //***************************  LOGICA  ****************************//

    protected function altaTrabajoTaller(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $values = $this->form->getValues();

            $TrabajoTaller = new TrabajoTaller();
            $TrabajoTaller->setMovil(MovilPeer::getMovilByPK($values['idMovil'], $this->getUser()->getAttribute('id')));
            $TrabajoTaller->setIdtaller($values['idTaller']);
            $TrabajoTaller->setFechaIngreso($values['fechaIngreso']);
            $TrabajoTaller->setMotivoingreso($values['motivoIngreso']);
            $TrabajoTaller->setCostomateriales($values['costoMateriales']);
            $TrabajoTaller->setCostomanoobra($values['costoManoObra']);
            $TrabajoTaller->setDetalletrabajo($values['detalleTrabajo']);
            $TrabajoTaller->setResponsable($values['responsable']);
            $TrabajoTaller->setTipopago($values['tipoPago']);
            $TrabajoTaller->setTotaltrabajo($values['totalTrabajo']);
            $TrabajoTaller->setNumerofactura($values['numeroFactura']);
            $TrabajoTaller->setFechaalta(new DateTime());
            $TrabajoTaller->setHabilitado(true);
            $TrabajoTaller->setUsuario($this->getUser()->getAttribute('id'));
            $TrabajoTaller->save();

            // si lo puedo guardar sin problemas ahora creo el evento para registrar el alta
            Evento::crearEvento($TrabajoTaller->getUsuario(), "Se creo un nuevo Trabajo de Taller para el móvil id " . $TrabajoTaller->getMovil()->getId());

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

    protected function modificarTrabajoTaller(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $TrabajoTaller = $form->save();

            // si lo puedo guardar sin problemas ahora creo el evento para registrar el alta
            Evento::crearEvento($TrabajoTaller->getUsuario(), "Se modificó el trabajo de taller id " . $TrabajoTaller->getId());

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

    protected function setMovil(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute("id");
        $idMovil = $request->getParameter('idMovil');
        $movil = MovilPeer::getMovilByPK($idMovil, $idUsuario);
        $this->form->setDefault('idMovil', $movil->getId());
        $this->form->setDefault('matriculaMovil', $movil->getMatricula());
    }

}
