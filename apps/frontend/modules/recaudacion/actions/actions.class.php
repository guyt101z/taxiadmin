<?php

/**
 * recaudacion actions.
 *
 * @package    taxi
 * @subpackage recaudacion
 * @author     Brus
 */
class recaudacionActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute('id');
        $this->idMovil = $request->getParameter('idMovil');
        $this->idChofer = $request->getParameter('idChofer');

        $this->pager = new sfPropelPager('Recaudacion', ConstantesFrontEnd::$CANTIDAD_RECAUDACIONES_PAGINADO);
        $this->pager->setCriteria(RecaudacionPeer::getRecaudacionesParaUsuarioCriteria($idUsuario, $this->idMovil, $this->idChofer));
        $this->pager->setPage($request->getParameter('page', 1));
        $this->pager->init();

        $this->csrfToken = $this->getCSRFToken();
        $this->movil = MovilPeer::getMovilByPK($this->idMovil, $idUsuario);
        $this->chofer = ChoferPeer::getChoferByPK($this->idChofer, $idUsuario);
    }

    public function executeShow(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $idUsuario = $this->getUser()->getAttribute("id");
        $idRecaudacion = $request->getParameter('id');

        $this->Recaudacion = RecaudacionPeer::getRecaudacionByPK($idRecaudacion, $idUsuario);
        $this->forward404Unless($this->Recaudacion);
    }

    public function executeNew(sfWebRequest $request) {
        $this->forward404Unless($request->isXmlHttpRequest());
        $this->setChoferesYMoviles($request);

        $this->form = new RecaudacionForm();

        // seteo la fecha de hoy en el objeto fecha
        $this->form->setDefault('fecha', date(ConstantesFrontEnd::$FORMAT_DATE));
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));
        $this->form = new RecaudacionForm();
        return $this->altaRecaudacion($request, $this->form);
    }

    public function executeEdit(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute("id");
        $idRecaudacion = $request->getParameter('id');
        $this->forward404Unless($recaudacion = RecaudacionPeer::getRecaudacionByPK($idRecaudacion, $idUsuario), sprintf('Object recaudación does not exist (%s).', $idRecaudacion));
        $this->setChoferesYMoviles($request);
        $this->form = new RecaudacionForm($recaudacion);
    }

    public function executeUpdate(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute("id");
        $idRecaudacion = $request->getParameter('id');
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($recaudacion = RecaudacionPeer::getRecaudacionByPK($idRecaudacion, $idUsuario), sprintf('Object recaudación does not exist (%s).', $idRecaudacion));
        $this->form = new RecaudacionForm($recaudacion);
        return $this->modificarRecaudacion($request, $this->form);
    }

    public function executeErase(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute("id");
        $idRecaudacion = $request->getParameter('id');
        $this->recaudacion = RecaudacionPeer::getRecaudacionByPK($idRecaudacion, $idUsuario);
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $idUsuario = $this->getUser()->getAttribute("id");
        $idRecaudacion = $request->getParameter('id');

        $this->forward404Unless($recaudacion = RecaudacionPeer::getRecaudacionByPK($idRecaudacion, $idUsuario), sprintf('Object recaudación does not exist (%s).', $idRecaudacion));
        //$recaudacion->delete();
        $recaudacion->setFechabaja(new DateTime());
        $recaudacion->setHabilitado(FALSE);
        $recaudacion->save();

        $respuesta_ajax = array(
            "ok" => "true"
        );

        return $this->renderText(json_encode($respuesta_ajax));
    }

    //***************************  LOGICA  ****************************//

    protected function altaRecaudacion(sfWebRequest $request, sfForm $form) {
        $idUsuario = $this->getUser()->getAttribute('id');
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $values = $this->form->getValues();

            $recaudacion = new Recaudacion();
            $recaudacion->setMovil(MovilPeer::getMovilByPK($values['idMovil'], $idUsuario));
            $recaudacion->setChofer(ChoferPeer::getChoferByPK($values['idChofer'], $idUsuario));
            $recaudacion->setTurno($values['turno']);
            $recaudacion->setFecha($values['fecha']);
            $recaudacion->setKminicialauto($values['kmInicialAuto']);
            $recaudacion->setKmfinalauto($values['kmFinalAuto']);
            $recaudacion->setKminicialreloj($values['kmInicialReloj']);
            $recaudacion->setKmfinalreloj($values['kmFinalReloj']);
            $recaudacion->setFichasiniciales($values['fichasIniciales']);
            $recaudacion->setFichasfinales($values['fichasFinales']);
            $recaudacion->setFichasdiurnas($values['fichasDiurnas']);
            $recaudacion->setFichasnocturnas($values['fichasNocturnas']);
            $recaudacion->setBanderasdiurnas($values['banderasDiurnas']);
            $recaudacion->setBanderasnocturnas($values['banderasNocturnas']);
            $recaudacion->setPorcentajerecaudacion($values['porcentajeRecaudacion']);
            $recaudacion->setImportechofer($values['importeChofer']);
            $recaudacion->setImportemovil($values['importeMovil']);
            $recaudacion->setRecaudacion($values['recaudacion']);
            $recaudacion->setAportepatronal($values['aportePatronal']);
            $recaudacion->setDescuentofichas($values['descuentoFichas']);
            $recaudacion->setDescuentobanderas($values['descuentoBanderas']);

            $recaudacion->setFechaalta(new DateTime());
            $recaudacion->setHabilitado(true);
            $recaudacion->setUsuario($idUsuario);
            $recaudacion->save();

            // si lo puedo guardar sin problemas ahora creo el evento para registrar el alta
            Evento::crearEvento($recaudacion->getUsuario(), "Se creo una nueva recaudación para el chofer id " . $recaudacion->getChofer()->getId() . ' y el móvil id ' . $recaudacion->getMovil()->getId());
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

    protected function modificarRecaudacion(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

        if ($form->isValid()) {
            $recaudacion = $form->save();

            // si lo puedo guardar sin problemas ahora creo el evento para registrar el alta
            Evento::crearEvento($recaudacion->getUsuario(), "Se modificó la recaudación id " . $recaudacion->getId());

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

    private function getCSRFToken() {
        // Token CSRF
        $baseForm = new BaseForm();
        return $baseForm->getCSRFToken();
    }

}
