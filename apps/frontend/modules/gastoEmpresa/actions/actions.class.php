<?php

/**
 * gastoEmpresa actions.
 *
 * @package    taxi
 * @subpackage gastoEmpresa
 * @author     Brus
 */
class gastoEmpresaActions extends sfActions {

    // public function executeIndex(sfWebRequest $request) {
    //     $this->GastoEmpresas = GastoempresaPeer::doSelect(new Criteria());
    // }

    public function executeShow(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute("id");
        $idGastoEmpresa = $request->getParameter('id');

        $this->GastoEmpresa = GastoempresaPeer::getGastoEmpresaByPK($idGastoEmpresa, $idUsuario);
        $this->forward404Unless($this->GastoEmpresa);
    }

    public function executeNew(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->form = new GastoEmpresaForm();
        $this->setEmpresa($request);
        $this->form->setDefault('fecha', date(ConstantesFrontEnd::$FORMAT_DATE));
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new GastoEmpresaForm();
        return $this->altaGastoEmpresa($request, $this->form);
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idGastoEmpresa = $request->getParameter('id');
        $this->forward404Unless($GastoEmpresa = GastoempresaPeer::getGastoEmpresaByPK($idGastoEmpresa, $idUsuario), sprintf('Object gasto does not exist (%s).', $idGastoEmpresa));
        $this->form = new GastoEmpresaForm($GastoEmpresa);
        $this->setEmpresa($request);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idGastoEmpresa = $request->getParameter('id');
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($GastoEmpresa = GastoempresaPeer::getGastoEmpresaByPK($idGastoEmpresa, $idUsuario), sprintf('Object gasto does not exist (%s).', $idGastoEmpresa));
        $this->form = new GastoEmpresaForm($GastoEmpresa);
        return $this->modificarGastoEmpresa($request, $this->form);
    }

    public function executeErase(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idGastoEmpresa = $request->getParameter('id');
        $this->GastoEmpresa = GastoempresaPeer::getGastoEmpresaByPK($idGastoEmpresa, $idUsuario);
    }

    public function executeDelete(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $request->checkCSRFProtection();

        $idUsuario = $this->getUser()->getAttribute("id");
        $idGastoEmpresa = $request->getParameter('id');

        $this->forward404Unless($GastoEmpresa = GastoempresaPeer::getGastoEmpresaByPK($idGastoEmpresa, $idUsuario), sprintf('Object gasto does not exist (%s).', $idGastoEmpresa));

        $GastoEmpresa->setFechabaja(new DateTime());
        $GastoEmpresa->setHabilitado(FALSE);
        $GastoEmpresa->save();

        $respuesta_ajax = array(
            "ok" => "true"
        );

        return $this->renderText(json_encode($respuesta_ajax));
    }

    //***************************  LOGICA  ****************************//

    protected function altaGastoEmpresa(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $values = $this->form->getValues();

            $GastoEmpresa = new GastoEmpresa();
            $GastoEmpresa->setEmpresa(EmpresaPeer::getEmpresaByPK($values['idEmpresa'], $this->getUser()->getAttribute('id')));
            $GastoEmpresa->setFecha($values['fecha']);
            $GastoEmpresa->setCosto($values['costo']);
            $GastoEmpresa->setDetalle($values['detalle']);
            $GastoEmpresa->setFechaalta(new DateTime());
            $GastoEmpresa->setHabilitado(TRUE);
            $GastoEmpresa->setUsuario($this->getUser()->getAttribute('id'));
            $GastoEmpresa->save();

            // si lo puedo guardar sin problemas ahora creo el evento para registrar el alta
            Evento::crearEvento($GastoEmpresa->getUsuario(), "Se creo un nuevo Gasto Móvil para el móvil id " . $GastoEmpresa->getEmpresa()->getId());

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

    protected function modificarGastoEmpresa(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $GastoEmpresa = $form->save();

            // si lo puedo guardar sin problemas ahora creo el evento para registrar el alta
            Evento::crearEvento($GastoEmpresa->getUsuario(), "Se modificó el gasto móvil id " . $GastoEmpresa->getId());

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

    protected function setEmpresa(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute("id");
        $idEmpresa = $request->getParameter('idEmpresa');
        $empresa = EmpresaPeer::getEmpresaByPK($idEmpresa, $idUsuario);
        $this->form->setDefault('idEmpresa', $empresa->getId());
        $this->form->setDefault('nombreEmpresa', $empresa->getNombre());
    }

}
