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

        $this->setChoferesMovilesSalario($request);
        
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
        $this->setChoferesMovilesSalario($request);
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
        // $idUsuario = $this->getUser()->getAttribute("id");
        // $idRecaudacion = $request->getParameter('id');
        // $this->recaudacion = RecaudacionPeer::getRecaudacionByPK($idRecaudacion, $idUsuario);
        $this->recaudacion = new Recaudacion();;
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $idUsuario = $this->getUser()->getAttribute("id");
        $idRecaudacion = $request->getParameter('id');

        $this->forward404Unless($recaudacion = RecaudacionPeer::getRecaudacionByPK($idRecaudacion, $idUsuario), sprintf('Object recaudación does not exist (%s).', $idRecaudacion));
        $recaudacion->setFechabaja(new DateTime());
        $recaudacion->setHabilitado(FALSE);
        $recaudacion->save();

        $respuesta_ajax = array(
            "ok" => "true",
            "url" => $this->getController()->genUrl('recaudacion/index', TRUE)
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
            $recaudacion->setFecha($values['fecha']);
            $recaudacion->setKm($values['km']);
            $recaudacion->setRecaudacion($values['recaudacion']);
            $recaudacion->setTotalgastos($values['totalGastos']);
            $recaudacion->setImportechofer($values['importeChofer']);
            $recaudacion->setAporteleyes($values['aporteLeyes']);
            $recaudacion->setImportemovil($values['importeMovil']);

            $recaudacion->setFechaalta(new DateTime());
            $recaudacion->setHabilitado(true);
            $recaudacion->setUsuario($idUsuario);

            for ($i=1; $i < 7; $i++) { 
                $index = 'gasto' .$i;
                if(!empty($values[$index])){
                    $gasto = new GastoRecaudacion();
                    $gasto->setCosto($values[$index]);
                    $gasto->setUsuario($idUsuario);
                    $gasto->setDetalle(ConstantesFrontEnd::getDetalleGasto($i));
                    $recaudacion->addGastorecaudacion($gasto);
                }
            }

            $recaudacion->save();

            // si lo puedo guardar sin problemas ahora creo el evento para registrar el alta
            Evento::crearEvento($recaudacion->getUsuario(), "Se creo una nueva recaudación para el chofer id " . $recaudacion->getChofer()->getId() . ' y el móvil id ' . $recaudacion->getMovil()->getId());
            $this->getUser()->setFlash("success", "La Recaudación se a ingresado correctamente.");

            // quito de la sesion de usuario las listas de moviles y choferes antes seteadas
            $this->getUser()->getAttributeHolder()->remove('choferes');
            $this->getUser()->getAttributeHolder()->remove('moviles');

        } else {
            $this->getUser()->setFlash("success", "Se generó un error al ingresar la recaudación, verifique los datos y vuelva a intentar");
        }

        $this->redirect('recaudacion/new');
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

    protected function setChoferesMovilesSalario(sfWebRequest $request) {
        $idUsuario = $this->getUser()->getAttribute("id");

        // en un array cargo los choferes de ese usuario
        $choferes = array('' => 'Seleccione un Chofer');
        $choferesAporteLeyes = array();
        $choferesPLiquidacion = array();
        if ($request->hasParameter('idChofer')) {
            $chofer = ChoferPeer::getChoferByPK($request->getParameter('idChofer'), $idUsuario);
            $choferes[$chofer->getId()] = $chofer->getNombreCompleto();
            $choferesAporteLeyes[$chofer->getId()] = $chofer->getAporteleyes();
            $choferesPLiquidacion[$chofer->getId()] = $chofer->getPorcentajeliquidacion();
            $this->getUser()->setAttribute("choferes", $choferes);
        } else {
            $listaChoferes = ChoferPeer::getChoferesParaUsuario($idUsuario);
            foreach ($listaChoferes as $chofer) {
                $choferes[$chofer->getId()] = $chofer->getNombreCompleto();
                $choferesAporteLeyes[$chofer->getId()] = $chofer->getAporteleyes();
                $choferesPLiquidacion[$chofer->getId()] = $chofer->getPorcentajeliquidacion();
            }
            $this->getUser()->setAttribute("choferes", $choferes);
            $this->getUser()->setAttribute("choferesAporteLeyes", $choferesAporteLeyes);
            $this->getUser()->setAttribute("choferesPLiquidacion", $choferesPLiquidacion);
        }

        $moviles = array('' => 'Seleccione un Móvil');
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
