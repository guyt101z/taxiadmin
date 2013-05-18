<?php

/**
 * gastoMovil actions.
 *
 * @package    taxi
 * @subpackage gastoMovil
 * @author     Brus
 */
class gastoMovilActions extends sfActions {

    // public function executeIndex(sfWebRequest $request) {
    //     $this->GastoMovils = GastomovilPeer::doSelect(new Criteria());
    // }

    public function executeShow(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute("id");
        $idGastoMovil = $request->getParameter('id');

        $this->GastoMovil = GastomovilPeer::getGastoMovilByPK($idGastoMovil, $idUsuario);
        $this->forward404Unless($this->GastoMovil);
    }

    public function executeNew(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->form = new GastoMovilForm();
        $this->setMovil($request);
        $this->form->setDefault('fecha', date(ConstantesFrontEnd::$FORMAT_DATE));
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new GastoMovilForm();
        return $this->altaGastoMovil($request, $this->form);
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idGastoMovil = $request->getParameter('id');
        $this->forward404Unless($GastoMovil = GastomovilPeer::getGastoMovilByPK($idGastoMovil, $idUsuario), sprintf('Object gasto does not exist (%s).', $idGastoMovil));
        $this->form = new GastoMovilForm($GastoMovil);
        $this->setMovil($request);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idGastoMovil = $request->getParameter('id');
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($GastoMovil = GastomovilPeer::getGastoMovilByPK($idGastoMovil, $idUsuario), sprintf('Object gasto does not exist (%s).', $idGastoMovil));
        $this->form = new GastoMovilForm($GastoMovil);
        return $this->modificarGastoMovil($request, $this->form);
    }

    public function executeErase(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idGastoMovil = $request->getParameter('id');
        $this->GastoMovil = GastomovilPeer::getGastoMovilByPK($idGastoMovil, $idUsuario);
    }

    public function executeDelete(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $request->checkCSRFProtection();

        $idUsuario = $this->getUser()->getAttribute("id");
        $idGastoMovil = $request->getParameter('id');

        $this->forward404Unless($GastoMovil = GastomovilPeer::getGastoMovilByPK($idGastoMovil, $idUsuario), sprintf('Object gasto does not exist (%s).', $idGastoMovil));
        
        $GastoMovil->setFechabaja(new DateTime());
        $GastoMovil->setHabilitado(FALSE);
        $GastoMovil->save();

        $respuesta_ajax = array(
            "ok" => "true"
        );

        return $this->renderText(json_encode($respuesta_ajax));
    }

    //***************************  LOGICA  ****************************//

    protected function altaGastoMovil(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $values = $this->form->getValues();

            $GastoMovil = new GastoMovil();
            $GastoMovil->setMovil(MovilPeer::getMovilByPK($values['idMovil'], $this->getUser()->getAttribute('id')));
            $GastoMovil->setFecha($values['fecha']);
            $GastoMovil->setCosto($values['costo']);
            $GastoMovil->setDetalle($values['detalle']);
            $GastoMovil->setFechaalta(new DateTime());
            $GastoMovil->setHabilitado(TRUE);
            $GastoMovil->setUsuario($this->getUser()->getAttribute('id'));
            $GastoMovil->save();

            // si lo puedo guardar sin problemas ahora creo el evento para registrar el alta
            Evento::crearEvento($GastoMovil->getUsuario(), "Se creo un nuevo Gasto Móvil para el móvil id " . $GastoMovil->getMovil()->getId());

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

    protected function modificarGastoMovil(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $GastoMovil = $form->save();

            // si lo puedo guardar sin problemas ahora creo el evento para registrar el alta
            Evento::crearEvento($GastoMovil->getUsuario(), "Se modificó el gasto móvil id " . $GastoMovil->getId());

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
