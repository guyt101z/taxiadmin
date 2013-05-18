<?php

/**
 * accidente actions.
 *
 * @package    taxi
 * @subpackage accidente
 * @author     Brus
 */
class accidenteActions extends sfActions {

    // public function executeIndex(sfWebRequest $request) {
    //     $this->Accidentes = AccidentePeer::doSelect(new Criteria());
    // }

    public function executeShow(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute("id");
        $idAccidente = $request->getParameter('id');

        $this->Accidente = AccidentePeer::getAccidenteByPK($idAccidente, $idUsuario);
        $this->forward404Unless($this->Accidente);
    }

    public function executeNew(sfWebRequest $request) {
        $this->setChoferesYMoviles($request);

        $this->form = new AccidenteForm();

        // seteo la fecha de hoy en el objeto fecha
        $this->form->setDefault('fecha', date(ConstantesFrontEnd::$FORMAT_DATE));
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new AccidenteForm();
        return $this->altaAccidente($request, $this->form);
    }

    public function executeEdit(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute("id");
        $idAccidente = $request->getParameter('id');
        $this->forward404Unless($accidente = AccidentePeer::getAccidenteByPK($idAccidente, $idUsuario), sprintf('Object accidente does not exist (%s).', $idAccidente));
        $this->setChoferesYMoviles($request);
        $this->form = new AccidenteForm($accidente);
    }

    public function executeUpdate(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute("id");
        $idAccidente = $request->getParameter('id');
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($accidente = AccidentePeer::getAccidenteByPK($idAccidente, $idUsuario), sprintf('Object accidente does not exist (%s).', $idAccidente));
        $this->form = new AccidenteForm($accidente);
        return $this->modificarAccidente($request, $this->form);
    }

    public function executeErase(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute("id");
        $idAccidente = $request->getParameter('id');
        $this->accidente = AccidentePeer::getAccidenteByPK($idAccidente, $idUsuario);
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $idUsuario = $this->getUser()->getAttribute("id");
        $idAccidente = $request->getParameter('id');

        $this->forward404Unless($accidente = AccidentePeer::getAccidenteByPK($idAccidente, $idUsuario), sprintf('Object accidente does not exist (%s).', $idAccidente));
        //$accidente->delete();
        $accidente->setFechabaja(new DateTime());
        $accidente->setHabilitado(FALSE);
        $accidente->save();

        $respuesta_ajax = array(
            "ok" => "true"
        );

        return $this->renderText(json_encode($respuesta_ajax));
    }

    //***************************  LOGICA  ****************************//

    protected function altaAccidente(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $values = $this->form->getValues();

            $Accidente = new Accidente();
            $Accidente->setChofer(ChoferPeer::getChoferByPK($values['idChofer'], $this->getUser()->getAttribute('id')));
            $Accidente->setMovil(MovilPeer::getMovilByPK($values['idMovil'], $this->getUser()->getAttribute('id')));
            $Accidente->setFecha($values['fecha']);
            $Accidente->setResponsable($values['responsable']);
            $Accidente->setEsquina($values['esquina']);
            $Accidente->setHeridos($values['heridos']);
            $Accidente->setDescripcion($values['descripcion']);
            $Accidente->setFechaalta(new DateTime());
            $Accidente->setHabilitado(true);
            $Accidente->setUsuario($this->getUser()->getAttribute('id'));
            $Accidente->save();

            // si lo puedo guardar sin problemas ahora creo el evento para registrar el alta
            Evento::crearEvento($Accidente->getUsuario(), "Se creo un nuevo accidente para el chofer id " . $Accidente->getChofer()->getId() . ' y el móvil id ' . $Accidente->getMovil()->getId());

            // quito de la sesion de usuario las listas de moviles y choferes antes seteadas
            $this->getUser()->getAttributeHolder()->remove('choferes');
            $this->getUser()->getAttributeHolder()->remove('moviles');

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
                "tip" => "Error al guardar los datos, por favor verifíquelos y vuelva a intentar."
            );
        }

        return $this->renderText(json_encode($respuesta_ajax));
    }

    protected function modificarAccidente(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $Accidente = $form->save();

            // si lo puedo guardar sin problemas ahora creo el evento para registrar el alta
            Evento::crearEvento($Accidente->getUsuario(), "Se modificó el accidente id " . $Accidente->getId());

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
