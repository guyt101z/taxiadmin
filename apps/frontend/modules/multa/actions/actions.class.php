<?php

/**
 * multa actions.
 *
 * @package    taxi
 * @subpackage multa
 * @author     Brus
 */
class multaActions extends sfActions {

    // public function executeIndex(sfWebRequest $request) {
    //     $this->multas = MultaPeer::doSelect(new Criteria());
    // }

    public function executeShow(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute("id");
        $idMulta = $request->getParameter('id');

        $this->multa = MultaPeer::getMultaByPK($idMulta, $idUsuario);
        $this->forward404Unless($this->multa);
    }

    public function executeNew(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->setChoferesYMoviles($request);

        $this->form = new MultaForm();

        // seteo la fecha de hoy en el objeto fecha
        $this->form->setDefault('fecha', date(ConstantesFrontEnd::$FORMAT_DATE));
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new MultaForm();
        return $this->altaMulta($request, $this->form);
    }

    public function executeEdit(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute("id");
        $idMulta = $request->getParameter('id');
        $this->forward404Unless($multa = MultaPeer::getMultaByPK($idMulta, $idUsuario), sprintf('Object multa does not exist (%s).', $idMulta));
        $this->setChoferesYMoviles($request);
        $this->form = new MultaForm($multa);
    }

    public function executeUpdate(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute("id");
        $idMulta = $request->getParameter('id');
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($multa = MultaPeer::getMultaByPK($idMulta, $idUsuario), sprintf('Object multa does not exist (%s).', $idMulta));
        $this->form = new multaForm($multa);
        return $this->modificarMulta($request, $this->form);
    }

    public function executeErase(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute("id");
        $idMulta = $request->getParameter('id');
        $this->multa = MultaPeer::getMultaByPK($idMulta, $idUsuario);
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $idUsuario = $this->getUser()->getAttribute("id");
        $idMulta = $request->getParameter('id');

        $this->forward404Unless($multa = MultaPeer::getMultaByPK($idMulta, $idUsuario), sprintf('Object multa does not exist (%s).', $idMulta));
        //$multa->delete();
        $multa->setFechabaja(new DateTime());
        $multa->setHabilitado(FALSE);
        $multa->save();

        $respuesta_ajax = array(
            "ok" => "true"
        );

        return $this->renderText(json_encode($respuesta_ajax));
    }

    public function executeMarcarPago(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idMulta = $request->getParameter('id');

        $this->multa = MultaPeer::getMultaByPK($idMulta, $idUsuario);
        $this->forward404Unless($this->multa);
    }

    public function executeGuardarPago(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idMulta = $request->getParameter('id');

        $multa = MultaPeer::getMultaByPK($idMulta, $idUsuario);
        $this->forward404Unless($multa);

        $values = $request->getParameter('multa');
        $fechaPago = new DateTime(str_replace("/", "-", $values['fechaPago']));
        
        $multa->setPago(TRUE);
        $multa->setFechapago($fechaPago);
        $multa->save();

        $respuesta_ajax = array(
            "ok" => "true"
        );

        return $this->renderText(json_encode($respuesta_ajax));
    }

    //***************************  LOGICA  ****************************//

    protected function altaMulta(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $values = $this->form->getValues();

            $Multa = new Multa();
            $Multa->setChofer(ChoferPeer::getChoferByPK($values['idChofer'], $this->getUser()->getAttribute('id')));
            $Multa->setMovil(MovilPeer::getMovilByPK($values['idMovil'], $this->getUser()->getAttribute('id')));
            $Multa->setFecha($values['fecha']);
            $Multa->setDescripcion($values['descripcion']);
            $Multa->setEsquina($values['esquina']);
            $Multa->setResponsable($values['responsable']);
            $Multa->setCosto($values['costo']);
            $Multa->setFechavencimiento($values['fechaVencimiento']);
            $Multa->setFechapago($values['fechaPago']);
            if ($values['fechaPago'] != Null) {
                $Multa->setPago(TRUE);
            } else {
                $Multa->setPago(FALSE);
            }
            $Multa->setFechaalta(new DateTime());
            $Multa->setHabilitado(TRUE);
            $Multa->setUsuario($this->getUser()->getAttribute('id'));
            $Multa->save();

            // si lo puedo guardar sin problemas ahora creo el evento para registrar el alta
            Evento::crearEvento($Multa->getUsuario(), "Se creo una nueva multa para el chofer id " . $Multa->getChofer()->getId() . ' y el movil id ' . $Multa->getMovil()->getId());

            // quito de la sesion de usuario las listas de moviles y choferes antes seteadas
            $this->getUser()->getAttributeHolder()->remove('choferes');
            $this->getUser()->getAttributeHolder()->remove('moviles');

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

    protected function modificarMulta(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $values = $this->form->getValues();

            $Multa = $form->save();

            if($Multa->getFechaPago() == Null){
                 $Multa->setPago(FALSE);
            } else {
                $Multa->setPago(TRUE);
            }

            $Multa->save();

            // si lo puedo guardar sin problemas ahora creo el evento para registrar el alta
            Evento::crearEvento($Multa->getUsuario(), "Se modificó la multa id " . $Multa->getId());

            // quito de la sesion de usuario las listas de moviles y choferes antes seteadas
            $this->getUser()->getAttributeHolder()->remove('choferes');
            $this->getUser()->getAttributeHolder()->remove('moviles');

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

    protected function setChoferesYMoviles(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute("id");

        // en un array cargo los choferes de ese usuario
        $choferes = array();
        if ($request->hasParameter('idChofer')) {
            $chofer = ChoferPeer::getChoferByPK($request->getParameter('idChofer'), $idUsuario);
            $choferes[$chofer->getId()] = $chofer->getNombreCompleto();
            $this->getUser()->setAttribute("choferes", $choferes);
        } else {
            $listaChoferes = ChoferPeer::getChoferesParaUsuario($idUsuario);
            foreach ($listaChoferes as $chofer) {
                $choferes[$chofer->getId()] = $chofer->getNombreCompleto();
            }
            $this->getUser()->setAttribute("choferes", $choferes);
        }

        $moviles = array();
        // si la solicitud es para agregar una multa a un movil dado busco unicamente ese movil
        if ($request->hasParameter('idMovil')) {
            // obtengo el movil
            $movil = MovilPeer::getMovilByPK($request->getParameter('idMovil'), $idUsuario);
            // lo agrego al array
            $moviles[$movil->getId()] = $movil->getMatricula();
            // lo seteo en la sesion de usuario
            $this->getUser()->setAttribute("moviles", $moviles);
        } else {
            // obtengo todos los moviles del usuario
            $listaMoviles = MovilPeer::getMovilesParaUsuario($idUsuario);
            // recorro la lista y los agrego al array
            foreach ($listaMoviles as $movil) {
                $moviles[$movil->getId()] = $movil->getMatricula();
            }
            // seteo la lista en la sesion de usuario
            $this->getUser()->setAttribute("moviles", $moviles);
        }
    }

}
